<?php

namespace App\Http\Controllers\Hrm;
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
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $model = DB::table('hrm_employee_payrolls as p')
                ->leftJoin('staff as s', 's.id', '=', 'p.employee_id')
                ->select(
                    'p.id',
                    's.code as employee_code',
                    's.name as employee_name',
                    'p.payroll_month',
                    'p.payroll_year',
                    'p.gross_salary',
                    'p.total_deduction',
                    'p.net_salary',
                    'p.payment_date',
                    'p.payment_status',
                    'p.remarks'
                )
                ->orderByDesc('p.id');

            return DataTables::of($model)

                ->editColumn('payroll_month', function ($row) {

                    return date('F', mktime(0,0,0,$row->payroll_month,1));

                })

                ->editColumn('payment_date', function ($row) {

                    return $row->payment_date
                        ? date('d M, Y', strtotime($row->payment_date))
                        : '-';

                })

                ->editColumn('payment_status', function ($row) {

                    switch ($row->payment_status) {

                        case 'Paid':
                            $color = 'success';
                            break;

                        case 'Pending':
                            $color = 'warning';
                            break;

                        case 'Cancelled':
                            $color = 'danger';
                            break;

                        default:
                            $color = 'secondary';

                    }

                    return '<span class="badge bg-'.$color.'">'.$row->payment_status.'</span>';

                })

                ->addColumn('actions', function ($row) {

                    $btn = '';

                    if(auth()->user()->can('admin.payroll.show')){
                        $btn .= '<a href="'.route('admin.payroll.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }
                 if(auth()->user()->can('admin.payroll.update-status')){
                        if($row->payment_status !='Paid'){
                        $btn .= '<button type="button"
                                class="btn btn-sm btn-primary btn-payroll"
                                data-id="'.$row->id.'"
                                data-status="'.$row->payment_status.'"
                                data-note="'.$row->remarks.'"
                                data-gross-salary="'.$row->gross_salary.'"
                                data-deduction="'.$row->total_deduction.'"
                                data-net-salary="'.$row->net_salary.'"
                                title="Update Payroll">
                                <i class="fas fa-dollar-sign"> Pay</i>
                            </button>';
                        }
                    }
                    if(auth()->user()->can('admin.payroll.edit')){
                        $btn .= '<a href="'.route('admin.payroll.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.payroll.destroy')){
                        $btn .= '<button class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.payroll.destroy',$row->id).'">
                            <i class="fas fa-trash"></i>
                        </button>';
                    }

                    return '<div class="btn-group">'.$btn.'</div>';

                })

                ->rawColumns([
                    'payment_status',
                    'actions'
                ])

                ->make(true);

        }

        return view('hrm.payroll.index');
    }


   public function create(Request $request)
    {
        $employees = DB::table('staff')
            ->where('status',1)
            ->orderBy('name')
            ->get();
        $employee = DB::table('staff')->where('id',$request->employee_id)->first()??[];

        return view('hrm.payroll.create',compact('employees','employee'));
    }

    public function salaryStructure(Request $request){

        if (request()->ajax()) {

                $model = DB::table('staff')->orderByDesc('id');

                return DataTables::of($model)

                    ->addColumn('actions', function ($row) {

                        $btn = '';

                        if(auth()->user()->can('admin.salary.structure.certificate')){
                            $btn .= '<a href="'.route('admin.salary.structure.certificate',$row->id).'"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-print"></i> Certificate
                            </a>';
                        }

                        

                        return '<div class="btn-group">'.$btn.'</div>';
                    })

                    ->rawColumns([
                        'actions'
                    ])

                    ->make(true);
            }

            return view('hrm.salary_structure.index');

    }
    public function salaryCertificate($id){
           $employee= DB::table('staff')->find($id);
            return view('hrm.salary_structure.certificate',compact('id','employee'));
    }

    
    public function salaryGenerate(Request $request){

           $payrollscount= DB::table('hrm_employee_payrolls')->where('payroll_month',$request->payroll_month)->where('payroll_year',$request->payroll_year)->count();
           if($payrollscount){
            return redirect()->back()->withErrors('Already Paid Salary to this Month!');
           }
           $current = Carbon::createFromDate(
                $request->payroll_year,
                $request->payroll_month,
                1
            );

            $previous = $current->copy()->subMonth();

            $previousMonth = $previous->month;
            $previousYear  = $previous->year;
            $payrolls = DB::table('hrm_employee_payrolls as p')
            ->join('staff as s','s.id','=','p.employee_id')
            ->where('p.payroll_month',$previousMonth)
            ->where('p.payroll_year',$previousYear)
            ->select(
                'p.*',
                's.code as employee_code',
                's.name'
            )
            ->get();
            
        return view('hrm.salary_generate.index',compact('payrolls','previousMonth','previousYear'));
    }

    
    public function paySlip(Request $request)
    {
        $employees = DB::table('staff')
            ->where('status',1)
            ->orderBy('name')
            ->get();

        return view('hrm.payslip.index',compact('employees'));
    }
    public function paySlipPrint(Request $request)
    {
       
        $request->validate([
            'payroll_month' => 'required',
            'payroll_year'  => 'required',
        ],[
            'payroll_month.required' => 'Unpaid Month selected is mandatory.',
            'payroll_year.required'  => 'Unpaid Year selected is mandatory.',
        ]);
        $payroll = null;

        if($request->filled('employee_id') && $request->filled('payroll_month') && $request->filled('payroll_year'))
        {
           
            $payroll = DB::table('hrm_employee_payrolls as p')
                ->join('staff as s','s.id','=','p.employee_id')
                ->where('p.employee_id',$request->employee_id)
                ->where('p.payroll_month',$request->payroll_month)
                ->where('p.payroll_year',$request->payroll_year)
                ->select(
                    'p.*',
                    's.name',
                    's.code as employee_code',
                    's.designation',
                    's.type as department'
                )
                ->first();
        }
           if($payroll==null){
            return redirect()->back()->withErrors('Not found any data selected to this Month!');
           }
        $payroll_month = date('F',mktime(0,0,0,$request->payroll_month,1))??'-';
        $payroll_year = $request->payroll_year??'-';

        return view('hrm.payslip.print',compact(
            'payroll',
            'payroll_month',
            'payroll_year'
        ));
    }
    
    public function salaryGenerateStore(Request $request)
    {
        $request->validate([
            'payroll_month' => 'required',
            'payroll_year'  => 'required',
        ],[
            'payroll_month.required' => 'Unpaid Month selected is mandatory.',
            'payroll_year.required'  => 'Unpaid Year selected is mandatory.',
        ]);

        $exists = DB::table('hrm_employee_payrolls')
            ->where('payroll_month', $request->payroll_month)
            ->where('payroll_year', $request->payroll_year)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors('Already Paid Salary to this Month!');
           
        }

        // Previous Month বের করা
        $current = Carbon::create(
            $request->payroll_year,
            $request->payroll_month,
            1
        );

        $previous = $current->copy()->subMonth();

        // Previous Month Payroll
        $previousPayrolls = DB::table('hrm_employee_payrolls')
            ->where('payroll_month', $previous->month)
            ->where('payroll_year', $previous->year)
            ->get();

        if ($previousPayrolls->isEmpty()) {
            return back()->with('error', 'Previous month payroll not found.');
        }

        $insertData = [];

        foreach ($previousPayrolls as $row) {

            $data = (array) $row;

            // Auto Increment ID remove
            unset($data['id']);

            // Previous Month replace
            $data['payroll_month'] = $request->payroll_month;
            $data['payroll_year']  = $request->payroll_year;

            // Reset Payment Info
            $data['payment_status'] = 'Paid';
            $data['payment_date']   = date('Y-m-d');
            $data['remarks']        = $request->remarks;

            // Timestamp
            $data['created_at'] = now();
            $data['updated_at'] = now();

            $insertData[] = $data;
        }

        DB::table('hrm_employee_payrolls')->insert($insertData);
        $monthName = date('F', mktime(0, 0, 0, $request->payroll_month, 1));
        return redirect()
            ->route('admin.payroll.index')
            ->withSuccessMessage('Salary generated successfully '.'for '.$monthName.'-'.$request->payroll_year );
    }

    public function salarySheet(Request $request)
    {
        $current = \Carbon\Carbon::create(
            $request->payroll_year,
            $request->payroll_month,
            1
        );

        $previous = $current->copy()->subMonth();

        $payrolls = DB::table('hrm_employee_payrolls as p')
            ->join('staff as s','s.id','=','p.employee_id')
            ->where('p.payroll_month',$previous->month)
            ->where('p.payroll_year',$previous->year)
            ->select(
                'p.*',
                's.code as employee_code',
                's.name'
            )
            ->get();

        return view(
            'hrm.salary_sheet.index',
            compact(
                'payrolls',
                'request',
                'previous'
            )
        );
    }

    public function updateStatus(Request $request, $id)
    {
        DB::table('hrm_employee_payrolls')
            ->where('id', $id)
            ->update([
                'payment_status' => $request->payment_status,
                'remarks'           => $request->note,
                'payment_date'   => $request->payment_status == 'Paid'
                                    ? now()->toDateString()
                                    : null,
                'updated_at'     => now(),
            ]);

        return response()->json([
            'status'  => true,
            'message' => 'Payroll updated successfully.'
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id'      => 'required',
            'payroll_month'    => 'required',
            'payroll_year'     => 'required',
            'payment_type'     => 'required',
            'payment_status'   => 'required',
        ]);


        $payrollexist = DB::table('hrm_employee_payrolls')->where('employee_id',$request->employee_id)->where('payroll_month',$request->payroll_month)->where('payroll_year',$request->payroll_year)->count();

        if($payrollexist){
             return redirect()->back()->withErrors('Already Paid Salary to this Employee!');
        }

        // Gross Salary
        $gross_salary =
            $request->basic_salary +
            $request->house_rent +
            $request->medical_allowance +
            $request->conveyance_allowance +
            $request->food_allowance +
            $request->mobile_allowance +
            $request->other_allowance +
            $request->overtime_amount;

        // Total Deduction
        $total_deduction =
            $request->late_deduction +
            $request->tax +
            $request->provident_fund +
            $request->loan_deduction +
            $request->advance_deduction +
            $request->attendance_deduction +
            $request->other_deduction;

        // Total Addition
        $total_addition =
            $request->festival_bonus +
            $request->performance_bonus +
            $request->commission +
            $request->other_addition;

        // Net Salary
        $net_salary = $gross_salary + $total_addition - $total_deduction;

        DB::table('hrm_employee_payrolls')->insert([
            'employee_id'            => $request->employee_id,

            'payroll_month'          => $request->payroll_month,
            'payroll_year'           => $request->payroll_year,

            'payment_type'           => $request->payment_type,

            'basic_salary'           => $request->basic_salary ?? 0,
            'house_rent'             => $request->house_rent ?? 0,
            'medical_allowance'      => $request->medical_allowance ?? 0,
            'conveyance_allowance'   => $request->conveyance_allowance ?? 0,
            'food_allowance'         => $request->food_allowance ?? 0,
            'mobile_allowance'       => $request->mobile_allowance ?? 0,
            'other_allowance'        => $request->other_allowance ?? 0,

            'gross_salary'           => $gross_salary,

            'working_days'           => $request->working_days ?? 0,
            'present_days'           => $request->present_days ?? 0,
            'absent_days'            => $request->absent_days ?? 0,
            'leave_days'             => $request->leave_days ?? 0,

            'late_count'             => $request->late_count ?? 0,
            'late_deduction'         => $request->late_deduction ?? 0,

            'overtime_hours'         => $request->overtime_hours ?? 0,
            'overtime_amount'        => $request->overtime_amount ?? 0,

            'tax'                    => $request->tax ?? 0,
            'provident_fund'         => $request->provident_fund ?? 0,
            'loan_deduction'         => $request->loan_deduction ?? 0,
            'advance_deduction'      => $request->advance_deduction ?? 0,
            'attendance_deduction'   => $request->attendance_deduction ?? 0,
            'other_deduction'        => $request->other_deduction ?? 0,

            'total_deduction'        => $total_deduction,

            'festival_bonus'         => $request->festival_bonus ?? 0,
            'performance_bonus'      => $request->performance_bonus ?? 0,
            'commission'             => $request->commission ?? 0,
            'other_addition'         => $request->other_addition ?? 0,

            'total_addition'         => $total_addition,

            'net_salary'             => $net_salary,

            'payment_date'           => $request->payment_date,
            'payment_method'         => $request->payment_method,
            'bank_name'              => $request->bank_name,
            'account_no'             => $request->account_no,
            'transaction_no'         => $request->transaction_no,

            'payment_status'         => $request->payment_status,

            'remarks'                => $request->remarks,

            'created_by'             => auth()->id(),
            'created_at'             => now(),

        ]);

        return redirect()
            ->route('admin.payroll.index')
            ->withSuccessMessage('Payroll generated successfully.');
    }


    public function edit($id)
    {
        $data = DB::table('hrm_employee_payrolls as ep')
            ->leftJoin('staff as stf', 'stf.id','=','ep.employee_id')
            ->where('ep.id', $id)
            ->first();

        if (!$data) {
            abort(404);
        }

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.payroll.edit', compact(
            'data',
            'employees',
            'id'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'      => 'required',
            'payroll_month'    => 'required',
            'payroll_year'     => 'required',
            'payment_type'     => 'required',
            'payment_status'   => 'required',
        ]);

        

        DB::table('hrm_employee_payrolls')
            ->where('id', $id)
            ->update([

                'employee_id'            => $request->employee_id,

                'payroll_month'          => $request->payroll_month,
                'payroll_year'           => $request->payroll_year,

                'payment_type'           => $request->payment_type,

                'basic_salary'           => $request->basic_salary ?? 0,
                'house_rent'             => $request->house_rent ?? 0,
                'medical_allowance'      => $request->medical_allowance ?? 0,
                'conveyance_allowance'   => $request->conveyance_allowance ?? 0,
                'food_allowance'         => $request->food_allowance ?? 0,
                'mobile_allowance'       => $request->mobile_allowance ?? 0,
                'other_allowance'        => $request->other_allowance ?? 0,

                'gross_salary'           => $request->gross_salary,

                'working_days'           => $request->working_days ?? 0,
                'present_days'           => $request->present_days ?? 0,
                'absent_days'            => $request->absent_days ?? 0,
                'leave_days'             => $request->leave_days ?? 0,

                'late_count'             => $request->late_count ?? 0,
                'late_deduction'         => $request->late_deduction ?? 0,

                'overtime_hours'         => $request->overtime_hours ?? 0,
                'overtime_amount'        => $request->overtime_amount ?? 0,

                'tax'                    => $request->tax ?? 0,
                'provident_fund'         => $request->provident_fund ?? 0,
                'loan_deduction'         => $request->loan_deduction ?? 0,
                'advance_deduction'      => $request->advance_deduction ?? 0,
                'attendance_deduction'   => $request->attendance_deduction ?? 0,
                'other_deduction'        => $request->other_deduction ?? 0,

                'total_deduction'        => $request->total_deduction,

                'festival_bonus'         => $request->festival_bonus ?? 0,
                'performance_bonus'      => $request->performance_bonus ?? 0,
                'commission'             => $request->commission ?? 0,
                'other_addition'         => $request->other_addition ?? 0,

                'total_addition'         => $request->total_addition,

                'net_salary'             => $request->net_salary,

                'payment_date'           => $request->payment_date,
                'payment_method'         => $request->payment_method,
                'bank_name'              => $request->bank_name,
                'account_no'             => $request->account_no,
                'transaction_no'         => $request->transaction_no,
                'payment_status'         => $request->payment_status,

                'remarks'                => $request->remarks,

                'updated_by'             => auth()->id(),
                'updated_at'             => now(),
            ]);

        return redirect()
            ->route('admin.payroll.index')
            ->withSuccessMessage('Payroll updated successfully.');
    }
   


    
}