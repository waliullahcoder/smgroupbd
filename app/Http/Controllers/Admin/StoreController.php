<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Store;
use App\Models\StoreArea;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            // Sob store: global scope ignore + soft-deleted shoho
            $model = Store::withoutGlobalScopes()
                ->withTrashed()
                ->with(['company', 'branch']);

            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model = Store::withoutGlobalScopes()
                    ->onlyTrashed()
                    ->with(['company', 'branch']);
            }

            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $class = ($row->trashed() || request('type') == 'trash')
                        ? 'trash_multi_checkbox'
                        : 'multi_checkbox';

                    return '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ' . $class . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '">
                        <label for="' . $row->id . '" class="custom-control-label"></label>
                    </div>';
                })
                ->editColumn('name', function ($row) {
                    $badge = $row->trashed()
                        ? ' <span class="badge bg-danger">Deleted</span>'
                        : '';
                    return e($row->name) . $badge;
                })
                ->addColumn('status', function ($row) {
                    return '<div class="form-check form-switch">
                        <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.store.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                })
                ->addColumn('actions', function ($row) {
                    $data = [
                        'id'   => $row->id,
                        'edit' => !$row->trashed(),
                    ];
                    return ActionButtons::actions($data);
                })
                ->rawColumns(['checkbox', 'name', 'status', 'actions'])
                ->make(true);
        }

        $title = "Store Management";
        return view('admin.store.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add New Store';
        $companies = Company::orderBy('name', 'asc')->get();
        return view('admin.store.create', compact('title', 'companies'));
    }

    public function getProjectsByCompany($companyId)
    {
        $projects = Branch::where('company_id', $companyId)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $data = Store::create([
                'company_id'    => $request->company_id,
                'branch_id'     => $request->project_id,
                'name'          => $request->name,
                'address'       => $request->address,
                'remarks'       => $request->remarks,
                'store_name'    => $request->store_name,
                'item_name'     => $request->item_name,
                'assign_name'   => $request->assign_name,
                'delivery_qnty' => $request->delivery_qnty,
                'delivery_date' => $request->delivery_date,
                'received_qnty' => $request->received_qnty,
                'received_date' => $request->received_date,
                'created_by'    => Auth::user()->id,
            ]);

          
        });

        return redirect()->route('admin.store.index')->withSuccessMessage('Created Successfully!');
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
            $data = Store::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        $title = 'Update Store';
        $data = Store::findOrFail($id);
        $link = Route('admin.store.update', $id);

        $companies = Company::orderBy('name', 'asc')->get();
        $projects = Branch::where('company_id', $data->company_id)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        return view('admin.store.edit', compact('title', 'data', 'link', 'companies', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'store_name' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $data = Store::findOrFail($id);
          $data->update([
                'company_id'    => $request->company_id,
                'branch_id'     => $request->project_id,
                'name'          => $request->name,
                'address'       => $request->address,
                'remarks'       => $request->remarks,
                'store_name'    => $request->store_name,
                'item_name'     => $request->item_name,
                'assign_name'   => $request->assign_name,
                'delivery_qnty' => $request->delivery_qnty,
                'delivery_date' => $request->delivery_date,
                'received_qnty' => $request->received_qnty,
                'received_date' => $request->received_date,
                'updated_by'    => Auth::user()->id, // column thakle
            ]);

           
        });

        return redirect()->route('admin.store.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Store::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Store::onlyTrashed()->findOrFail($id);
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Store::onlyTrashed()->findOrFail($id);
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Store::findOrFail($id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Store::findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
