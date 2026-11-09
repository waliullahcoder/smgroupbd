<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CustomerRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $model = DB::table('crm_customer_requirements as ms')
                ->leftJoin('crm_leads as l','l.id','=','ms.lead_id')
                ->select(
                    'ms.*',
                    'l.company_name'
                )
                ->orderByDesc('ms.id');

            return DataTables::query($model)

                ->addColumn('requirement_status', function ($row){
             
                    if($row->requirement_status==1){
                        return '<span class="badge bg-warning">Scheduled</span>';
                    }

                    if($row->requirement_status==2){
                        return '<span class="badge bg-success">Confirmed</span>';
                    }

                    return '<span class="badge bg-danger">Cancelled</span>';

                })

                ->addColumn('actions', function ($row) {

                    $data = [
                        'id'=>$row->id,
                        'edit'=>true,
                    ];

                    $actionBtn = NULL;
                    if(auth()->user()->can('admin.customer-requirement.show')){
                        $actionBtn .= '<a href="'.route('admin.customer-requirement.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    return ActionButtons::actions($data,$actionBtn);

                })

                ->rawColumns([
                    'requirement_status',
                    'actions'
                ])

                ->make(true);

        }

        return view('crm.customer_requirement.index');
    }

    /**
     * Show create form
     */
    public function create()
    {
        $title="Add Customer Requirement";
        $leads = DB::table('crm_leads')->get();

        return view('crm.customer_requirement.create',compact('title','leads'));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'lead_id'         => 'required|exists:crm_leads,id',
            'meeting_type'    => 'required|max:100',
            'related_module'  => 'required|max:100',
            'requirement_details' => 'nullable',
            'req_date'    => 'required|date',
            'record_time'      => 'required',
            'requirement_status'  => 'required|in:1,2,3',
        ]);

        DB::table('crm_customer_requirements')->insert([
            'lead_id'         => $request->lead_id,
            'meeting_type'    => $request->meeting_type,
            'related_module'  => $request->related_module,
            'requirement_details' => $request->requirement_details,
            'req_date'    => $request->req_date,
            'record_time'      => $request->record_time,
            'requirement_status'  => $request->requirement_status,
            'created_by'      => Auth::id(),
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()
            ->route('admin.customer-requirement.index')
            ->withSuccessMessage('Customer Requirement Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = DB::table('crm_customer_requirements')->where('id', $id)->first();

        if (!$data) {
            abort(404);
        }

        $leads = DB::table('crm_leads')
            ->select('id', 'company_name')
            ->where('status', 1)
            ->orderBy('company_name')
            ->get();

        return view('crm.customer_requirement.edit', compact('data', 'leads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lead_id'         => 'required|exists:crm_leads,id',
            'meeting_type'    => 'required|max:100',
            'related_module'  => 'required|max:100',
            'requirement_details' => 'nullable',
            'req_date'    => 'required|date',
            'record_time'      => 'required',
            'requirement_status'  => 'required|in:1,2,3',
        ]);

        DB::table('crm_customer_requirements')
            ->where('id', $id)
            ->update([
                'lead_id'         => $request->lead_id,
                'meeting_type'    => $request->meeting_type,
                'related_module'  => $request->related_module,
                'requirement_details' => $request->requirement_details,
                'req_date'    => $request->req_date,
                'record_time'      => $request->record_time,
                'requirement_status'  => $request->requirement_status,
                'updated_by'      => Auth::id(),
                'updated_at'      => now(),
            ]);

        return redirect()
            ->route('admin.customer-requirement.index')
            ->withSuccessMessage('Customer Requirement Updated Successfully!');
    }
   public function show($id)
    {
        $data = DB::table('crm_customer_requirements as cr')
            ->leftJoin('crm_leads as l', 'l.id', '=', 'cr.lead_id')
            ->leftJoin('users as u', 'u.id', '=', 'cr.created_by')
            ->select(
                'cr.*',
                'l.company_name',
                'l.contact_person',
                'l.mobile',
                'l.email',
                'u.name as created_by_name'
            )
            ->where('cr.id', $id)
            ->first();

        if (!$data) {
            abort(404);
        }

        return view('crm.customer_requirement.show', compact('data'));
    }

}