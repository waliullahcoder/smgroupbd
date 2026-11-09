<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $model = DB::table('crm_meeting_schedules as ms')
                ->leftJoin('crm_leads as l','l.id','=','ms.lead_id')
                ->select(
                    'ms.*',
                    'l.company_name'
                )
                ->orderByDesc('ms.id');

            return DataTables::query($model)

                ->addColumn('meeting_status', function ($row){

                    if($row->meeting_status==1){
                        return '<span class="badge bg-warning">Scheduled</span>';
                    }

                    if($row->meeting_status==2){
                        return '<span class="badge bg-success">Completed</span>';
                    }

                    return '<span class="badge bg-danger">Cancelled</span>';

                })

                ->addColumn('actions', function ($row) {

                    $data = [
                        'id'=>$row->id,
                        'edit'=>true,
                    ];

                    $actionBtn = NULL;

                    if(Auth::user()->can('admin.meeting-schedule.index')){
                        $actionBtn .= '<a href="'.Route('admin.meeting-schedule.show',$row->id).'" class="btn btn-sm btn-primary tt" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>';
                    }

                    return ActionButtons::actions($data,$actionBtn);

                })

                ->rawColumns([
                    'meeting_status',
                    'actions'
                ])

                ->make(true);

        }

        return view('crm.meeting_schedule.index');
    }

    /**
     * Show create form
     */
    public function create()
    {
        $title="Add Meeting Schedule";
        $leads = DB::table('crm_leads')->get();

        return view('crm.meeting_schedule.create',compact('title','leads'));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'meeting_title'   => 'required|max:255',
            'lead_id'         => 'required|exists:crm_leads,id',
            'meeting_type'    => 'required|max:100',
            'related_module'  => 'required|max:100',
            'meeting_details' => 'nullable',
            'meeting_date'    => 'required|date',
            'start_time'      => 'required',
            'end_time'        => 'required|after:start_time',
            'meeting_status'  => 'required|in:1,2,3',
        ]);

        DB::table('crm_meeting_schedules')->insert([
            'meeting_title'   => $request->meeting_title,
            'lead_id'         => $request->lead_id,
            'meeting_type'    => $request->meeting_type,
            'related_module'  => $request->related_module,
            'meeting_details' => $request->meeting_details,
            'meeting_date'    => $request->meeting_date,
            'start_time'      => $request->start_time,
            'end_time'        => $request->end_time,
            'meeting_status'  => $request->meeting_status,
            'created_by'      => Auth::id(),
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()
            ->route('admin.meeting-schedule.index')
            ->withSuccessMessage('Meeting Schedule Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = DB::table('crm_meeting_schedules')->where('id', $id)->first();

        if (!$data) {
            abort(404);
        }

        $leads = DB::table('crm_leads')
            ->select('id', 'company_name')
            ->where('status', 1)
            ->orderBy('company_name')
            ->get();

        return view('crm.meeting_schedule.edit', compact('data', 'leads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'meeting_title'   => 'required|max:255',
            'lead_id'         => 'required|exists:crm_leads,id',
            'meeting_type'    => 'required|max:100',
            'related_module'  => 'required|max:100',
            'meeting_details' => 'nullable',
            'meeting_date'    => 'required|date',
            'start_time'      => 'required',
            'end_time'        => 'required|after:start_time',
            'meeting_status'  => 'required|in:1,2,3',
        ]);

        DB::table('crm_meeting_schedules')
            ->where('id', $id)
            ->update([
                'meeting_title'   => $request->meeting_title,
                'lead_id'         => $request->lead_id,
                'meeting_type'    => $request->meeting_type,
                'related_module'  => $request->related_module,
                'meeting_details' => $request->meeting_details,
                'meeting_date'    => $request->meeting_date,
                'start_time'      => $request->start_time,
                'end_time'        => $request->end_time,
                'meeting_status'  => $request->meeting_status,
                'updated_by'      => Auth::id(),
                'updated_at'      => now(),
            ]);

        return redirect()
            ->route('admin.meeting-schedule.index')
            ->withSuccessMessage('Meeting Schedule Updated Successfully!');
    }
    public function show(string $id)
    {
        //
    }

}