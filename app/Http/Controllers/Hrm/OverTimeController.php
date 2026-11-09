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

class OverTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {

        if (request()->ajax()) {
            $model = DB::table('hrm_employee_overtime as eot')
                ->leftJoin('staff as e', 'e.id', '=', 'eot.employee_id')
                ->select(
                    'eot.id',
                    'e.code as employee_code',
                    'e.name',
                    'eot.overtime_type',
                    'eot.payroll_month',
                    'eot.payroll_year',
                    'eot.overtime_amount',
                    'eot.overtime_hour',
                    'eot.overtime_rate',
                    'eot.overtime_date',
                    'eot.status'
                )->orderBy('id','desc');

            return DataTables::of($model)
    
                ->editColumn('payroll_month', function ($row) {
                
                    return date('F', mktime(0, 0, 0, $row->payroll_month, 1));
                })

                ->editColumn('overtime_date', function ($row) {
                    return date('d M, Y', strtotime($row->overtime_date));
                })

                ->editColumn('overtime_amount', function ($row) {
                    return number_format($row->overtime_amount, 2);
                })

                ->editColumn('status', function ($row) {
                    if ($row->status == 'Pending') {
                        return '<span class="badge bg-warning">Pending</span>';
                    }

                    if ($row->status == 'Approved') {
                        return '<span class="badge bg-info">Approved</span>';
                    }

                    return '<span class="badge bg-success">Paid</span>';
                })

                ->addColumn('actions', function ($row) {
                    $btn = '';

                    if(auth()->user()->can('admin.employee-overtime.show')){
                        $btn .= '<a href="'.route('admin.employee-overtime.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.employee-overtime.edit')){
                        $btn .= '<a href="'.route('admin.employee-overtime.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.employee-overtime.destroy')){
                        $btn .= '<button
                            class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.employee-overtime.destroy',$row->id).'">
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

        return view('hrm.employee_overtime.index');
    }

  public function create()
    {
        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.employee_overtime.create', compact('employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id'    => 'required|exists:staff,id',
            'overtime_type'      => 'required',
            'payroll_month'  => 'required|integer|between:1,12',
            'payroll_year'   => 'required|digits:4',
            'overtime_amount'    => 'required|numeric|min:0',
            'overtime_hour'        => 'nullable',
            'overtime_rate'        => 'nullable',
            'overtime_date'      => 'required|date',
            'status'         => 'required|in:Pending,Approved,Paid',
            'remarks'        => 'nullable|string',
        ]);
        DB::table('hrm_employee_overtime')->insert([
            'employee_id'   => $request->employee_id,
            'overtime_type'    => $request->overtime_type,
            'payroll_month' => $request->payroll_month,
            'payroll_year'  => $request->payroll_year,
            'overtime_hour'        => $request->overtime_hour,
            'overtime_rate'        => $request->overtime_rate,
            'overtime_amount'        => $request->overtime_amount,
            'overtime_date'  => $request->overtime_date,
            'remarks'       => $request->remarks,
            'status'        => $request->status,
            'created_by'    => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()
            ->route('admin.employee-overtime.index')
            ->withSuccessMessage('Employee Overtime added successfully.');
    }

    public function edit($id)
    {
        $overtime = DB::table('hrm_employee_overtime')->find($id);

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.employee_overtime.edit', compact('overtime', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'   => 'required|exists:staff,id',
            'overtime_type'=> 'required',
            'payroll_month' => 'required|integer|between:1,12',
            'payroll_year'  => 'required|digits:4',
            'overtime_hour'        => 'nullable',
            'overtime_rate'        => 'nullable',
            'overtime_amount'        => 'required|numeric|min:0',
            'overtime_date'  => 'required|date',
            'status'        => 'required|in:Pending,Approved,Paid',
            'remarks'       => 'nullable|string|max:1000',
        ]);
      
        DB::table('hrm_employee_overtime')
            ->where('id', $id)
            ->update([
                'employee_id'   => $request->employee_id,
                'overtime_type'    => $request->overtime_type,
                'payroll_month' => $request->payroll_month,
                'payroll_year'  => $request->payroll_year,
                'overtime_hour' => $request->overtime_hour,
                'overtime_rate' => $request->overtime_rate,
                'overtime_amount'   => $request->overtime_amount,
                'overtime_date'  => $request->overtime_date,
                'remarks'       => $request->remarks,
                'status'        => $request->status,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);

        return redirect()
            ->route('admin.employee-overtime.index')
            ->withSuccessMessage('Employee overtime updated successfully.');
    }

    
}