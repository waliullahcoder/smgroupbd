<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use App\Models\CoaSetup;
use Illuminate\Http\Request;
use App\Models\LiftingProduct;
use Illuminate\Support\Facades\DB;
use App\Models\Scopes\CompanyScope;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Vendor::with(['company', 'coa'])->orderBy('id', 'desc');
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
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.vendor.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $lifting = LiftingProduct::where('vendor_id', $row->id)->first();
                    $check_delete = !is_null($lifting) ? 'no' : 'yes';
                    return ActionButtons::actions($data, NULL, $check_delete);
                })
                ->rawColumns(['checkbox', 'status', 'actions'])
                ->make(true);
        }

        $title = "Vendor Setup";
        return view('admin.vendor.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add New Vendor';
        return view('admin.vendor.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $parent_head = CoaSetup::where('head_code', 201)->first();
            $head_code = $parent_head->head_code . '01';
            $headQuery = CoaSetup::withoutGlobalScope(CompanyScope::class)->where('parent_id',  $parent_head->id)->max('head_code');
            if ($headQuery) {
                $str = substr($headQuery, strlen($parent_head->head_code)) + 1;
                if ($str < 10) {
                    $str = '0' . $str;
                }
                $head_code = $parent_head->head_code . '' . $str;
            }
            $account = CoaSetup::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'parent_id' => $parent_head->id,
                'head_code' => $head_code,
                'head_name' => $request->name,
                'transaction' => 1,
                'general' => 0,
                'head_type' => $parent_head->head_type,
                'status' => 1,
                'created_by' => Auth::user()->id
            ]);

            Vendor::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'coa_setup_id' => $account->id,
                'code' => $request->code,
                'name' => $request->name,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'created_by' => Auth::user()->id,
            ]);
        });

        return redirect()->route('admin.vendor.index')->withSuccessMessage('Created Successfully!');
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
        if (request()->ajax() && request('status')) {
            $data = Vendor::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        $title = 'Update Vendor';
        $data = Vendor::findOrFail($id);
        $link = Route('admin.vendor.update', $id);
        return view('admin.vendor.edit', compact('title', 'data', 'link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $data = Vendor::findOrFail($id);

            $account = CoaSetup::findOrFail($data->coa_setup_id);
            $account->update([
                'head_name' => $request->name,
                'updated_by' => Auth::user()->id
            ]);

            $data->update([
                'company_id' => Auth::user()->company_id ?? 1,
                'code' => $request->code,
                'name' => $request->name,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'updated_by' => Auth::user()->id,
            ]);
        });

        return redirect()->route('admin.vendor.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Vendor::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Vendor::onlyTrashed()->findOrFail($id);
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Vendor::onlyTrashed()->findOrFail($id);
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Vendor::findOrFail($id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Vendor::findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
