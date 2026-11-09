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

class LeadController extends Controller
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
                    'ls.name as lead_source',
                    'st.id as lead_status_id',
                    'st.name as lead_status',
                    'st.color as lead_status_color',
                    'l.priority',
                    'l.expected_value',
                    'u.name as assigned_to',
                    'l.next_follow_up'
                )
                ->orderByDesc('l.id');

            return DataTables::of($model)

                ->editColumn('next_follow_up', function ($row) {
                    return $row->next_follow_up
                        ? date('d M, Y', strtotime($row->next_follow_up))
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

               ->addColumn('actions', function ($row) {

                    $btn = '';

                    if(auth()->user()->can('admin.lead.show')){
                        $btn .= '<a href="'.route('admin.lead.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.lead.edit') && $row->lead_status!='Converted'){
                        $btn .= '<a href="'.route('admin.lead.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }
                    if(auth()->user()->can('admin.lead.edit') && $row->lead_status!='Converted'){
                        $btn .= '<button type="button"
                            class="btn btn-sm btn-secondary btn-status"
                            data-id="'.$row->id.'"
                            data-statusid="'.$row->lead_status_id.'"
                            data-status="'.$row->lead_status.'"
                            data-remarks="'.e($row->remarks).'"
                            title="Update Status">
                            <i class="fas fa-sync-alt"></i>
                        </button>';
                    }

                    if(auth()->user()->can('admin.lead.destroy')){
                        $btn .= '<button class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.lead.destroy',$row->id).'">
                            <i class="fas fa-trash"></i>
                        </button>';
                    }

                    return '<div class="btn-group">'.$btn.'</div>';
                })

                ->rawColumns([
                    'lead_status',
                    'status',
                    'actions'
                ])

                ->make(true);
        }
          $lead_statuses = DB::table('crm_lead_statuses')
            ->where('status',1)
            ->orderBy('sort_order')
            ->get();

        return view('crm.leads.index',compact('lead_statuses'));
    }

    public function enlistedNew()
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
                    'ls.name as lead_source',
                    'st.id as lead_status_id',
                    'st.name as lead_status',
                    'st.color as lead_status_color',
                    'l.priority',
                    'l.expected_value',
                    'u.name as assigned_to',
                    'l.follow_up_date',
                    'l.next_follow_up'
                )
                ->where('l.lead_status_id', 1)
                ->orderByDesc('l.id');
            return DataTables::of($model)
               
                 ->editColumn('follow_up_date', function ($row) {
                    return $row->follow_up_date
                        ? date('d M, Y', strtotime($row->follow_up_date))
                        : '-';
                })
                ->editColumn('next_follow_up', function ($row) {
                    return $row->next_follow_up
                        ? date('d M, Y', strtotime($row->next_follow_up))
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

               ->addColumn('actions', function ($row) {

                    $btn = '';

                    if(auth()->user()->can('admin.lead.show')){
                        $btn .= '<a href="'.route('admin.lead.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.lead.edit') && $row->lead_status!='Converted'){
                        $btn .= '<a href="'.route('admin.lead.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }
                    if(auth()->user()->can('admin.lead.edit') && $row->lead_status!='Converted'){
                        $btn .= '<button type="button"
                            class="btn btn-sm btn-secondary btn-status"
                            data-id="'.$row->id.'"
                            data-statusid="'.$row->lead_status_id.'"
                            data-status="'.$row->lead_status.'"
                            data-remarks="'.e($row->remarks).'"
                            title="Update Status">
                            <i class="fas fa-sync-alt"></i>
                        </button>';
                    }

                    if(auth()->user()->can('admin.lead.destroy')){
                        $btn .= '<button class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.lead.destroy',$row->id).'">
                            <i class="fas fa-trash"></i>
                        </button>';
                    }

                    return '<div class="btn-group">'.$btn.'</div>';
                })

                ->rawColumns([
                    'lead_status',
                    'status',
                    'actions'
                ])

                ->make(true);
               
        }
          $lead_statuses = DB::table('crm_lead_statuses')
            ->where('status',1)
            ->orderBy('sort_order')
            ->get();
        
        return view('crm.leads.new',compact('lead_statuses'));
    }
    
    public function dashboard()
    {
           $total_lead= DB::table('crm_leads')->count();
           $total_proposal_value= DB::table('crm_leads')->sum('proposal_value');
           $total_expected_value= DB::table('crm_leads')->sum('expected_value');
           $total_confirmed_value= DB::table('crm_leads')->where('lead_status_id',10)->sum('expected_value');
           $total_confirmed= DB::table('crm_leads')->where('lead_status_id',10)->count();
           $total_proposal_sent= DB::table('crm_leads')->where('lead_status_id',5)->count();
           $total_quotations= DB::table('crm_quotations')->count();

           return view('crm.dashboard.dashboard',compact('total_lead','total_proposal_value','total_expected_value','total_confirmed_value','total_confirmed','total_proposal_sent','total_quotations'));
    }
    /**
     * Show create form
     */
    public function create()
    {
        $lead_sources = DB::table('crm_lead_sources')
            ->where('status',1)
            ->get();

        $lead_statuses = DB::table('crm_lead_statuses')
            ->where('status',1)
            ->orderBy('sort_order')
            ->get();

        $users = DB::table('users')
            ->where('status',1)
            ->get();

        $lastLead = DB::table('crm_leads')->latest('id')->first();

        if ($lastLead) {
            $number = (int) substr($lastLead->lead_no, 4) + 1;
        } else {
            $number = 1;
        }

        $leadno = 'LEAD' . str_pad($number, 6, '0', STR_PAD_LEFT);

        return view('crm.leads.create', compact(
            'lead_sources',
            'lead_statuses',
            'users',
            'leadno'
        ));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name'=>'required|max:150|unique:crm_leads,company_name',
            'mobile'=>'required',

        ]);

       DB::table('crm_leads')->insert([
        'lead_no'          => $request->lead_no,
        'company_name'     => $request->company_name,
        'contact_person'   => $request->contact_person,
        'mobile'           => $request->mobile,
        'email'            => $request->email,
        'website'          => $request->website,
        'address'          => $request->address,
        'lead_source_id'   => $request->lead_source_id,
        'lead_status_id'   => $request->lead_status_id,
        'priority'         => $request->priority,
        'assigned_to'      => $request->assigned_to,
        'priority'         => $request->priority,
        'status'           => $request->status,
        'next_follow_up'   => $request->next_follow_up,
        'follow_up_date'   => $request->follow_up_date,
        'proposal_value'   => $request->proposal_value,
        'expected_value'   => $request->expected_value,
        'assigned_to'      => $request->assigned_to,
        'remarks'          => $request->remarks,
        'created_by'       => Auth::id(),
        'created_at'       => now(),
        'updated_at'       => now(),
    ]);

        return redirect()
            ->route('admin.lead.index')
            ->withSuccessMessage('Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Status Change
        if (request()->ajax() && request('status')) {

            $data = DB::table('crm_leads')->where('id',$id)->first();

            $data->update([
                'status' => !$data->status
            ]);

            return response()->json([
                'status' => 'success'
            ]);
        }

        $title = 'Update Lead Status';

        $data = DB::table('crm_leads')->where('id',$id)->first();

        $link = route('admin.lead.update', $id);

        $data = DB::table('crm_leads')->where('id',$id)->first();
        $lead_sources = DB::table('crm_lead_sources')->where('status',1)->get();
        $lead_statuses = DB::table('crm_lead_statuses')->where('status',1)->get();
        $users = DB::table('users')->where('status',1)->get();

        return view('crm.leads.edit', compact(
            'data',
            'lead_sources',
            'lead_statuses',
            'users',
            'title',
            'link'
        ));

    }

    public function updateStatus(Request $request,$id)
    {
        $request->validate([
            'lead_status_id'=>'required',
            'remarks'=>'nullable|string'
        ]);

        DB::table('crm_leads')
            ->where('id',$id)
            ->update([

                'lead_status_id'=>$request->lead_status_id,
                'remarks'=>$request->remarks,
                'updated_at'=>now()

            ]);


         if($request->lead_status_id==10){
            DB::transaction(function () use ($request,$id) {
                 $lead = DB::table('crm_leads')->where('id',$id)->first();
                        $user = User::create([
                            'company_id' => 1,
                            'role' => 2,
                            'name' => $lead->company_name,
                            'user_name' => $request->mobile,
                            'email' => $request->email,
                            'phone' => $request->mobile,
                            'status' => 1,
                            'password' => Hash::make($request->mobile),
                            'created_by' => Auth::user()->id,
                        ]);

                        Client::create([
                            'company_id' => 1,
                            'user_id' => $user->id,
                            'reference_by' => Auth::user()->id,
                            'area_id' => 1,
                            'territory_id' => 1,
                            'code' => 3,
                            'name' => $lead->company_name,
                            'contact_person' => $lead->contact_person,
                            'email' => $lead->email,
                            'phone' => $lead->mobile,
                            'address' => $lead->address,
                            'credit_limit' =>0,
                            'discount' =>  0,
                            'bin_no' => 0,
                            'is_vat' =>0,
                            'is_chain' => 0,
                            'created_by' => Auth::user()->id,
                        ]);

                    });
           return redirect()
                ->back()
                ->with('success','Converted Successfully as New Client!');
            }
          



        return redirect()
                ->back()
                ->with('success','Lead Status Updated Successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'company_name' => 'required',
            'mobile' => 'required',

        ]);

        DB::table('crm_leads')
            ->where('id', $id)
            ->update([
                'lead_no'          => $request->lead_no,
                'company_name'     => $request->company_name,
                'contact_person'   => $request->contact_person,
                'mobile'           => $request->mobile,
                'email'            => $request->email,
                'website'          => $request->website,
                'address'          => $request->address,
                'lead_source_id'   => $request->lead_source_id,
                'lead_status_id'   => $request->lead_status_id,
                'priority'         => $request->priority,
                'assigned_to'      => $request->assigned_to,
                'priority'         => $request->priority,
                'status'           => $request->status,
                'next_follow_up'   => $request->next_follow_up,
                'follow_up_date'   => $request->follow_up_date,
                'proposal_value'   => $request->proposal_value,
                'expected_value'   => $request->expected_value,
                'assigned_to'      => $request->assigned_to,
                'remarks'          => $request->remarks,
                'updated_by'       => Auth::id(),
                'updated_at'       => now(),
            ]);

        return redirect()
            ->route('admin.lead.index')
            ->withSuccessMessage('Updated Successfully!');
    }
    public function show($id)
    {
        $data = DB::table('crm_leads as l')
            ->leftJoin('crm_lead_sources as ls', 'ls.id', '=', 'l.lead_source_id')
            ->leftJoin('crm_lead_statuses as st', 'st.id', '=', 'l.lead_status_id')
            ->leftJoin('users as u', 'u.id', '=', 'l.assigned_to')
            ->leftJoin('users as cb', 'cb.id', '=', 'l.created_by')
            ->select(
                'l.*',
                'ls.name as lead_source',
                'st.name as lead_status',
                'st.color as lead_status_color',
                'u.name as assigned_to_name',
                'cb.name as created_by_name'
            )
            ->where('l.id', $id)
            ->first();

        if (!$data) {
            abort(404);
        }

        return view('crm.leads.show', compact('data'));
    }
}