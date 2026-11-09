<?php

namespace App\Http\Controllers\Crm;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\CoaSetup;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CrmReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        if (request()->ajax()) {

          $model = DB::table('crm_leads as l')
            ->leftJoin('crm_lead_sources as ls', 'ls.id', '=', 'l.lead_source_id')
            ->leftJoin('crm_lead_statuses as st', 'st.id', '=', 'l.lead_status_id')
            ->leftJoin('users as u', 'u.id', '=', 'l.assigned_to')
            ->select(
                'l.id',
                'l.lead_no',
                'l.remarks',
                'l.company_name',
                'l.contact_person',
                'l.mobile',
                'l.updated_at',
                'ls.name as lead_source',
                'st.id as lead_status_id',
                'st.name as lead_status',
                'st.color as lead_status_color',
                'l.proposal_value',
                'l.expected_value',
                'u.name as assigned_to',
                'l.follow_up_date'
            );

        if(request()->filled('lead_source_id')){
            $model->where('l.lead_source_id',request('lead_source_id'));
        }

        if(request()->filled('lead_status_id')){
            $model->where('l.lead_status_id',request('lead_status_id'));
        }

        if(request()->filled('from_date')){
            $model->whereDate('l.follow_up_date','>=',request('from_date'));
        }

        if(request()->filled('to_date')){
            $model->whereDate('l.follow_up_date','<=',request('to_date'));
        }

        $model->orderByDesc('l.id');

            return DataTables::of($model)

                ->editColumn('follow_up_date', function ($row) {
                    return $row->follow_up_date
                        ? date('d M, Y', strtotime($row->follow_up_date))
                        : '-';
                })
                 ->editColumn('updated_at', function ($row) {
                        return $row->updated_at
                            ? date('F j, Y g:i A', strtotime($row->updated_at))
                            : '-';
                    })
                ->editColumn('lead_status', function ($row) {

                    return '<span class="badge"
                                style="background-color:'.$row->lead_status_color.';
                                    color:#fff;
                                    padding:6px 12px;
                                    border-radius:20px;">
                                '.$row->lead_status.'
                            </span>';
                })

               

                ->rawColumns([
                    'lead_status',
                    'status'
                ])

                ->make(true);
        }
        $lead_sources = DB::table('crm_lead_sources')
            ->where('status',1)
            ->orderBy('name')
            ->get();

        $lead_statuses = DB::table('crm_lead_statuses')
            ->where('status',1)
            ->orderBy('sort_order')
            ->get();

return view('crm.report.index',compact('lead_statuses','lead_sources'));
    }
    
}