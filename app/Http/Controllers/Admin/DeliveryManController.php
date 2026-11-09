<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use App\Models\DeliveryMan;
use Illuminate\Http\Request;
use App\Models\Scopes\CompanyScope;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Support\Facades\Auth;

class DeliveryManController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = DeliveryMan::with(['store']);
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.staff.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    return ActionButtons::actions($data);
                })
                ->rawColumns(['checkbox', 'status', 'actions'])
                ->make(true);
        }

        $title = "Delivery Man Setup";
        return view('admin.delivery_man.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $code = DeliveryMan::withoutGlobalScope(CompanyScope::class)->withTrashed()->max('code');
        if ($code) {
            $code = (int)$code + 1;
        } else {
            $code = 1;
        }
        $title = 'Add Delivery Man';
        $stores = Store::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.delivery_man.create', compact('title', 'stores', 'code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ]);

        DeliveryMan::create([
            'company_id' => Auth::user()->company_id ?? 1,
            'store_id' => $request->store_id,
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'national_id' => $request->national_id,
            'created_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.delivery-man.index')->withSuccessMessage('Created Successfully!');
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
    public function edit(string $id)
    {
        $title = 'Update Delivery Man';
        $data = DeliveryMan::findOrFail($id);
        $link = Route('admin.delivery-man.update', $id);
        $stores = Store::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.delivery_man.edit', compact('title', 'data', 'link', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'store_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ]);

        $data = DeliveryMan::findOrFail($id);
        $data->update([
            'store_id' => $request->store_id,
            'code' => $request->code,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'national_id' => $request->national_id,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.delivery-man.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = DeliveryMan::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = DeliveryMan::onlyTrashed()->findOrFail($id);
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = DeliveryMan::onlyTrashed()->findOrFail($id);
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = DeliveryMan::findOrFail($id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = DeliveryMan::findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
