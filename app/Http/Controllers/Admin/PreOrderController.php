<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\PreOrderSection;
use App\Models\PreOrderSetup;
use App\Models\Product;
use App\Services\ActionButtons\ActionButtons;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PreOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = PreOrderSetup::with(['product']);
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return '<img src="' . asset($row->image) . '" height="50" alt="">';
                })
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.pre-order.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $additionalBtn = '<a href="' . Route('admin.pre-order.show', $row->id) . '" class="btn btn-sm btn-primary mw-fit border-0 px-10px fs-15 tt" data-bs-toggle="tooltip" data-bs-placement="top" title="View Section" data-bs-original-title="View Section" aria-label="View Section"><i class="fas fa-eye"></i></a>';
                    return ActionButtons::actions($data, $additionalBtn);
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }

        $title = "Pre Order Setup";
        return view('admin.pre_order.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Pre Order Setup';
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.pre_order.create', compact('title', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'image' => 'image|required',
        ]);

        $product = Product::findOrFail($request->product_id);

        $slug = Str::slug($product->name);
        $same_slug_count = PreOrderSetup::withTrashed()->where('slug', 'LIKE', $slug . '%')->count();
        $slug_suffix = $same_slug_count ? '-' . $same_slug_count + 1 : '';
        $slug .= $slug_suffix;

        PreOrderSetup::create([
            'slug' => $slug,
            'product_id' => $request->product_id,
            'image' => isset($request->image) ? HelperClass::saveImage($request->image, 800, 'media/pre-order/') : NULL,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.pre-order.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Sections';
        $data = PreOrderSetup::findOrFail($id);
        return view('admin.pre_order.sections', compact('title', 'data'));
    }

    public function storeUpdate(Request $request, string $id)
    {
        $list = array();
        if (!is_null($request->list[0])) {
            foreach (json_decode($request->list[0]) as $item) {
                array_push($list, $item->value);
            }
        }

        if ($request->isMethod('PUT')) {
            $data = PreOrderSection::findOrFail($request->id);
            if ($request->type != 'image_list' && file_exists($data->image)) {
                unlink($data->image);
            }
            $data->update([
                'type' => $request->type,
                'title' => $request->title,
                'list' => implode('|', $list),
                'description' => $request->description,
                'image' => isset($request->image) ? HelperClass::saveImage($request->image, 800, 'media/pre-order', $data->image) : $data->image,
                'video_link' => $request->video_link,
            ]);
            return redirect()->back()->withSuccessMessage('Successfully Updated!');
        } else {
            PreOrderSection::create([
                'pre_order_setup_id' => $id,
                'type' => $request->type,
                'title' => $request->title,
                'list' => implode('|', $list),
                'description' => $request->description,
                'image' => isset($request->image) ? HelperClass::saveImage($request->image, 800, 'media/pre-order') : NULL,
                'video_link' => $request->video_link
            ]);
            return redirect()->back()->withSuccessMessage('Successfully Created!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSection(Request $request, string $id)
    {
        if ($request->ajax()) {
            $data = PreOrderSection::findOrFail($id);
            $list = explode('|', $data->list);
            $list = implode('`', $list);
            return response()->json(['status' => 'success', 'data' => $data, 'list' => $list]);
        }
    }

    public function destroySection(string $id)
    {
        $data = PreOrderSection::findOrFail($id);
        $data->delete();
        return response()->json(['status' => 'success']);
    }

    public function edit(string $id)
    {
        if (request()->ajax() && request('status')) {
            $data = PreOrderSetup::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        $title = 'Update Pre Order';
        $data = PreOrderSetup::findOrFail($id);
        $link = Route('admin.pre-order.update', $id);
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.pre_order.edit', compact('title', 'data', 'link', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required',
            'image' => 'image',
        ]);

        $data = PreOrderSetup::findOrFail($id);

        $product = Product::findOrFail($request->product_id);
        $slug = Str::slug($product->name);
        $same_slug_count = PreOrderSetup::withTrashed()->whereNot('id', $id)->where('slug', 'LIKE', $slug . '%')->count();
        $slug_suffix = $same_slug_count ? '-' . $same_slug_count + 1 : '';
        $slug .= $slug_suffix;
        $data->update([
            'slug' => $slug,
            'product_id' => $request->product_id,
            'image' => isset($request->image) ? HelperClass::saveImage($request->image, 800, 'media/pre-order/', $data->image) : $data->image,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.pre-order.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete Single Item
        $data = PreOrderSetup::findOrFail($id);
        if(file_exists($data->image)){
            unlink($data->image);
        }
        $data->forceDelete();

        return response()->json(['status' => 'success']);
    }
}
