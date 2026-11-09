<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeSection;
use App\Models\HomeSectionSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = HomeSection::with(['category'])->orderBy('order', 'asc');
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input multi_checkbox" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('banner', function ($row) {
                    if (file_exists($row->banner)) {
                        return '<img src="' . asset($row->banner) . '" height="50" style="max-width: 150px; object-fit: contain;" alt="">';
                    }
                })
                ->addColumn('status', function ($row) {
                    $status =
                        '<div class="form-check form-switch">
                        <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.sections.edit', $row->id) . '" type="checkbox" name="status"' . ($row->status == 1 ? ' checked ' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <a href="' . Route('admin.sections.edit', $row->id) . '" class="btn btn-sm btn-warning border-0 px-10px fs-15"><i class="far fa-pencil-alt"></i></a>
                        <button type="button" class="btn btn-sm btn-danger border-0 px-10px fs-15 link-delete" data-url="' . Route('admin.sections.destroy', $row->id) . '"><i class="far fa-trash-alt"></i></button></div>';
                    return $actionBtn;
                })
                ->rawColumns(['checkbox', 'banner', 'status', 'actions'])
                ->make(true);
        }
        $title = 'Homepage Sections';
        return view('admin.sections.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::where('parent_id', $request->category_id)->where('status', 1)->get();
            return response()->json(['status' => 'success', 'categories' => $categories]);
        }
        $title = 'Add New Home Section';
        $categories = Category::root()->where('status', 1)->orderBy('name')->get();
        return view('admin.sections.create', compact('categories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'status' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $order = $request->order;
            if (is_null($order)) {
                $max_sl = HomeSection::max('order');
                $order = $max_sl ? $max_sl + 1 : 1;
            }
            $data = HomeSection::create([
                'category_id' => $request->category_id,
                'banner' => isset($request->banner) ? HelperClass::saveImage($request->banner, 1300, 'media/home-section/') : NULL,
                'banner_link' => $request->banner_link,
                'order' => $order,
                'status' => $request->status,
            ]);
            if($request->sub_categories){
                foreach ($request->sub_categories as $sub_cat) {
                    HomeSectionSubCategory::create([
                        'home_section_id' => $data->id,
                        'category_id' => $sub_cat,
                    ]);
                }
            }
        });

        return redirect()->route('admin.sections.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && request('status')) {
            $data = HomeSection::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        if ($request->ajax()) {
            $categories = Category::where('parent_id', $request->category_id)->where('status', 1)->get();
            return response()->json(['status' => 'success', 'categories' => $categories]);
        }

        $title = 'Update Home Section';
        $data = HomeSection::findOrFail($id);
        $categories = Category::root()->where('status', 1)->orderBy('name')->get();
        $link = Route('admin.sections.update', $id);
        return view('admin.sections.edit', compact('data', 'categories', 'title', 'link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required',
            'status' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $order = $request->order;
            if (is_null($order)) {
                $max_sl = HomeSection::max('order');
                $order = $max_sl ? $max_sl + 1 : 1;
            }
            $data = HomeSection::findOrFail($id);
            $data->update([
                'category_id' => $request->category_id,
                'banner' => isset($request->banner) ? HelperClass::saveImage($request->banner, 1300, 'media/home-section/') : $data->banner,
                'banner_link' => $request->banner_link,
                'order' => $order,
                'status' => $request->status,
            ]);
            HomeSectionSubCategory::where('home_section_id', $id)->delete();
            if($request->sub_categories){
                foreach ($request->sub_categories as $sub_cat) {
                    HomeSectionSubCategory::create([
                        'home_section_id' => $data->id,
                        'category_id' => $sub_cat,
                    ]);
                }
            }
        });

        return redirect()->route('admin.sections.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = HomeSection::findOrFail($id);
                if (file_exists($data->banner)) {
                    unlink($data->banner);
                }
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = HomeSection::findOrFail($id);
        if (file_exists($data->banner)) {
            unlink($data->banner);
        }
        $data->delete();
        return response()->json(['status' => 'success']);
    }
}
