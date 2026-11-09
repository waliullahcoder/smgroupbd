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

class ResignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {

        if (request()->ajax()) {
            $model = DB::table('hrm_employee_resignation as rsg')
                ->leftJoin('staff as e', 'e.id', '=', 'rsg.employee_id')
                ->select(
                    'rsg.id',
                    'e.code as employee_code',
                    'e.name',
                    'rsg.notice_period',
                    'rsg.resignation_date',
                    'rsg.last_working_date',
                    'rsg.reason',
                    'rsg.status'
                )->orderBy('id','desc');

            return DataTables::of($model)
    

                ->editColumn('resignation_date', function ($row) {
                    return date('d M, Y', strtotime($row->resignation_date));
                })

                ->editColumn('status', function ($row) {
                    if ($row->status == 'Pending') {
                        return '<span class="badge bg-warning">Pending</span>';
                    }

                    return '<span class="badge bg-success">Approved</span>';
                })

                    
                ->addColumn('actions', function ($row) {
                    $btn = '';

                    if(auth()->user()->can('admin.resignation.show')){
                        $btn .= '<a href="'.route('admin.resignation.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.resignation.edit')){
                        $btn .= '<a href="'.route('admin.resignation.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.resignation.destroy')){
                        $btn .= '<button
                            class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.resignation.destroy',$row->id).'">
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

        return view('hrm.resignation.index');
    }

  public function create()
    {
        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.resignation.create', compact('employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id'    => 'required|exists:staff,id',
            'notice_period'  => 'required',
            'resignation_date'    => 'required|date',
            'last_working_date'    => 'required|date',
            'status'         => 'required|in:Pending,Approved',
            'reason'        => 'nullable|string',
        ]);
       
        DB::table('hrm_employee_resignation')->insert([
            'employee_id'   => $request->employee_id,
            'notice_period' => $request->notice_period,
            'resignation_date'  => $request->resignation_date,
            'last_working_date'  => $request->last_working_date,
            'reason'       => $request->reason,
            'status'        => $request->status,
            'created_by'    => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()
            ->route('admin.resignation.index')
            ->withSuccessMessage('Employee resignation added successfully.');
    }

    public function edit($id)
    {
        $resignation = DB::table('hrm_employee_resignation')->find($id);

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.resignation.edit', compact('resignation', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'   => 'required|exists:staff,id',
            'last_working_date' => 'required',
            'notice_period' => 'required',
            'resignation_date'  => 'required|date',
            'status'        => 'required|in:Pending,Approved',
            'reason'       => 'nullable|string|max:1000',
        ]);
       
        DB::table('hrm_employee_resignation')
            ->where('id', $id)
            ->update([
                'employee_id'   => $request->employee_id,
                'notice_period' => $request->notice_period,
                'resignation_date'  => $request->resignation_date,
                'last_working_date'  => $request->last_working_date,
                'reason'       => $request->reason,
                'status'        => $request->status,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);

        return redirect()
            ->route('admin.resignation.index')
            ->withSuccessMessage('Employee Resignation updated successfully.');
    }

    
}