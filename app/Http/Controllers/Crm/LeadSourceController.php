<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LeadSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = DB::table('crm_lead_sources')->orderBy('id', 'desc');
            return DataTables::query($model)
            
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.lead-source.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $data = [
                        'id' => $row->id,
                        'edit' => true,
                    ];
                    $actionBtn = NULL;
                    if (Auth::user()->can('admin.lead-source.index')) {
                        $actionBtn = '<a href="' . Route('admin.lead-source.index', $row->id) . '" class="btn btn-sm btn-primary mw-fit border-0 px-10px fs-15 tt" data-bs-toggle="tooltip" data-bs-placement="top" title="View Actions"><i class="fas fa-eye"></i></a>';
                    }
                    return ActionButtons::actions($data, $actionBtn);
                })
                ->rawColumns(['checkbox', 'status', 'actions'])
                ->make(true);
        }
        return view('crm.lead_source.index');
    }

    /**
     * Show create form
     */
    public function create()
    {
        $title="Add Lead Source";

        return view('crm.lead_source.create',compact('title'));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([

            'code'=>'nullable|max:50',

            'name'=>'required|max:150|unique:crm_lead_sources,name',

            'name_bn'=>'nullable|max:150',

            'description'=>'nullable',

        ]);

        DB::table('crm_lead_sources')->insert([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.lead-source.index')
            ->withSuccessMessage('Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Status Change
        if (request()->ajax() && request('status')) {

            $data = DB::table('crm_lead_sources')->where('id',$id)->first();

            $data->update([
                'status' => !$data->status
            ]);

            return response()->json([
                'status' => 'success'
            ]);
        }

        $title = 'Update Lead Source';

        $data = DB::table('crm_lead_sources')->where('id',$id)->first();

        $link = route('admin.lead-source.update', $id);

        return view('crm.lead_source.edit', compact(
            'title',
            'data',
            'link'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'code' => 'nullable|max:50',

            'name' => 'required',

            'name_bn' => 'nullable|max:150',

            'description' => 'nullable',

        ]);

        DB::table('crm_lead_sources')
            ->where('id', $id)
            ->update([
                'code' => $request->code,
                'name' => $request->name,
                'status' => $request->status,
                'description' => $request->description,
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.lead-source.index')
            ->withSuccessMessage('Updated Successfully!');
    }
    public function show(string $id)
    {
        //
    }

}