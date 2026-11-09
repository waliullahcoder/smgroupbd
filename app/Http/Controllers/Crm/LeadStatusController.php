<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LeadStatusController extends Controller
{
     /**
     * Display a listing of the resource.
     */
   public function index()
    {
        if (request()->ajax()) {

            $model = DB::table('crm_lead_statuses')
                        ->orderBy('id', 'desc');

            return DataTables::query($model)

                ->addColumn('color', function ($row) {
                    return '<span class="badge" style="background:' . $row->color . ';color:#fff;">'
                            . $row->color .
                            '</span>';
                })

                ->addColumn('status', function ($row) {

                    return '<div class="form-check form-switch">
                        <input class="form-check-input change-status c-pointer"
                            data-url="' . route('admin.lead-status.edit', $row->id) . '"
                            type="checkbox"
                            ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';

                })

                ->addColumn('actions', function ($row) {

                    $data = [
                        'id' => $row->id,
                        'edit' => true,
                    ];

                    $actionBtn = null;

                    if (Auth::user()->can('admin.lead-status.index')) {

                        $actionBtn = '<a href="' . route('admin.lead-status.show', $row->id) . '"
                            class="btn btn-sm btn-primary mw-fit border-0 px-10px fs-15 tt"
                            data-bs-toggle="tooltip"
                            title="View">
                            <i class="fas fa-eye"></i>
                        </a>';

                    }

                    return ActionButtons::actions($data, $actionBtn);

                })

                ->rawColumns([
                    'color',
                    'status',
                    'actions'
                ])

                ->make(true);

        }

        return view('crm.lead_status.index');
    }

    /**
     * Show create form
     */
    public function create()
    {
        $title="Add Lead Status";

        return view('crm.lead_status.create',compact('title'));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([

            'code'=>'nullable|max:50',

            'name'=>'required|max:150|unique:crm_lead_statuses,name',

            'description'=>'nullable',

        ]);

        DB::table('crm_lead_statuses')->insert([
            'code' => $request->code,
            'name' => $request->name,
            'sort_order' => $request->sort_order,
            'description' => $request->description,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.lead-status.index')
            ->withSuccessMessage('Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Status Change
        if (request()->ajax() && request('status')) {

            $data = DB::table('crm_lead_statuses')->where('id',$id)->first();

            $data->update([
                'status' => !$data->status
            ]);

            return response()->json([
                'status' => 'success'
            ]);
        }

        $title = 'Update Lead Status';

        $data = DB::table('crm_lead_statuses')->where('id',$id)->first();

        $link = route('admin.lead-status.update', $id);

        return view('crm.lead_status.edit', compact(
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

            'description' => 'nullable',

        ]);

        DB::table('crm_lead_statuses')
            ->where('id', $id)
            ->update([
                'code' => $request->code,
                'name' => $request->name,
                'sort_order' => $request->sort_order,
                'status' => $request->status,
                'description' => $request->description,
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.lead-status.index')
            ->withSuccessMessage('Updated Successfully!');
    }
    public function show(string $id)
    {
        //
    }
}