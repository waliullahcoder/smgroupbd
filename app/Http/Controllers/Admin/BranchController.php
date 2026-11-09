<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Store;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Branch::with(['company']);
            if (!is_null(Auth::user()->branch_id)) {
                $model->whereIn('id', json_decode(Auth::user()->branch_id));
            }

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
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.branch.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
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

        $title = "Branch Setup";
        return view('admin.branch.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add New Branch';
        $companies = Company::orderBy('name')->get();
        return view('admin.branch.create', compact('title', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'prefix' => 'required',
            'name' => 'required',
            'contact_person' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'trade_license' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $branch = Branch::create([
                'company_id' => $request->company_id ?? Auth::user()->company_id,
                'prefix' => $request->prefix,
                'name' => $request->name,
                'trade_license' => $request->trade_license,
                'vat' => $request->vat,
                'tin' => $request->tin,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'website' => $request->website,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'address' => $request->address,
                'created_by' => Auth::user()->id,
            ]);

            Store::create([
                'company_id' => $request->company_id ?? Auth::user()->company_id,
                'branch_id' => $branch->id,
                'code' => $request->prefix,
                'type' => 'Branch Store',
                'name' => $request->name . ' Store',
                'address' => $request->address,
                'created_by' => Auth::user()->id,
            ]);
        });

        return redirect()->route('admin.branch.index')->withSuccessMessage('Created Successfully!');
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
            $data = Branch::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        $title = 'Update Branch';
        $data = Branch::findOrFail($id);
        $link = Route('admin.branch.update', $id);
        $companies = Company::orderBy('name')->get();
        return view('admin.branch.edit', compact('title', 'data', 'link', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'prefix' => 'required',
            'name' => 'required',
            'contact_person' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'trade_license' => 'required',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update([
            'company_id' => $request->company_id ?? Auth::user()->company_id,
            'prefix' => $request->prefix,
            'name' => $request->name,
            'trade_license' => $request->trade_license,
            'vat' => $request->vat,
            'tin' => $request->tin,
            'contact_person' => $request->contact_person,
            'email' => $request->email,
            'website' => $request->website,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.branch.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Branch::onlyTrashed()->findOrFail($id);
            foreach ($data->stores as $store) {
                $store->restore();
            }
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Branch::onlyTrashed()->findOrFail($id);
                foreach ($data->stores as $store) {
                    $store->forceDelete();
                }
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Branch::onlyTrashed()->findOrFail($id);
            foreach ($data->stores as $store) {
                $store->forceDelete();
            }
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Branch::findOrFail($id);
                foreach ($data->stores as $store) {
                    $store->update(['deleted_by' => Auth::user()->id]);
                    $store->delete();
                }
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Branch::findOrFail($id);
        foreach ($data->stores as $store) {
            $store->update(['deleted_by' => Auth::user()->id]);
            $store->delete();
        }
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
