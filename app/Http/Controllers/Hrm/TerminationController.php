<?php

namespace App\Http\Controllers\Hrm;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\CoaSetup;
use App\Models\Staff;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\ActionButtons\ActionButtons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TerminationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {

        if (request()->ajax()) {
            $model = DB::table('hrm_employee_termination as dsg')
                ->leftJoin('staff as e', 'e.id', '=', 'dsg.employee_id')
                ->select(
                    'dsg.id',
                    'e.code as employee_code',
                    'e.name',
                    'dsg.notice_period',
                    'dsg.termination_date',
                    'dsg.last_working_date',
                    'dsg.reason',
                    'dsg.status'
                )->orderBy('id','desc');

            return DataTables::of($model)
    

                ->editColumn('termination_date', function ($row) {
                    return date('d M, Y', strtotime($row->termination_date));
                })

                ->editColumn('status', function ($row) {
                    if ($row->status == 'Pending') {
                        return '<span class="badge bg-warning">Pending</span>';
                    }

                    return '<span class="badge bg-success">Approved</span>';
                })

                    
                ->addColumn('actions', function ($row) {
                    $btn = '';

                    if(auth()->user()->can('admin.termination.show')){
                        $btn .= '<a href="'.route('admin.termination.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.termination.edit')){
                        $btn .= '<a href="'.route('admin.termination.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.termination.destroy')){
                        $btn .= '<button
                            class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.termination.destroy',$row->id).'">
                            <i class="fas fa-trash"></i>
                        </button>';
                    }

                    return '<div class="btn-group">'.$btn.'</div>';
                })

                ->rawColumns([
                    'status',
                    'actions'
                ])

                ->make(true);
        }

        return view('hrm.termination.index');
    }

  public function create()
    {
        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.termination.create', compact('employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id'    => 'required|exists:staff,id',
            'notice_period'  => 'required',
            'termination_date'    => 'required|date',
            'last_working_date'    => 'required|date',
            'status'         => 'required|in:Pending,Approved',
            'reason'        => 'nullable|string',
        ]);
       
        DB::table('hrm_employee_termination')->insert([
            'employee_id'   => $request->employee_id,
            'notice_period' => $request->notice_period,
            'termination_date'  => $request->termination_date,
            'last_working_date'  => $request->last_working_date,
            'reason'       => $request->reason,
            'status'        => $request->status,
            'created_by'    => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()
            ->route('admin.termination.index')
            ->withSuccessMessage('Employee Termination added successfully.');
    }

    public function edit($id)
    {
        $termination = DB::table('hrm_employee_termination')->find($id);

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.termination.edit', compact('termination', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'   => 'required|exists:staff,id',
            'last_working_date' => 'required',
            'notice_period' => 'required',
            'termination_date'  => 'required|date',
            'status'        => 'required|in:Pending,Approved',
            'reason'       => 'nullable|string|max:1000',
        ]);
       
        DB::table('hrm_employee_termination')
            ->where('id', $id)
            ->update([
                'employee_id'   => $request->employee_id,
                'notice_period' => $request->notice_period,
                'termination_date'  => $request->termination_date,
                'last_working_date'  => $request->last_working_date,
                'reason'       => $request->reason,
                'status'        => $request->status,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);

        return redirect()
            ->route('admin.termination.index')
            ->withSuccessMessage('Employee Termination updated successfully.');
    }

    
}