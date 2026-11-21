<?php

namespace App\Http\Controllers\Hrm;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\CoaSetup;
use App\Models\Branch;
use App\Models\Company;
use App\Models\AccountTransactionAuto;
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

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {

        if (request()->ajax()) {
            $model = DB::table('hrm_employee_loan as el')
                ->leftJoin('staff as e', 'e.id', '=', 'el.employee_id')
                ->select(
                    'el.id',
                    'el.loan_no as loan_no',
                    'e.code as employee_code',
                    'e.name',
                    'el.loan_type',
                    'el.payroll_month',
                    'el.payroll_year',
                    'el.loan_amount',
                    'el.installment_amount',
                    'el.total_installments',
                    'el.loan_date',
                    'el.status'
                )->orderBy('id','desc');

            return DataTables::of($model)
    
                ->editColumn('payroll_month', function ($row) {
                
                    return date('F', mktime(0, 0, 0, $row->payroll_month, 1));
                })

                ->editColumn('loan_date', function ($row) {
                    return date('d M, Y', strtotime($row->loan_date));
                })

                ->editColumn('loan_amount', function ($row) {
                    return number_format($row->loan_amount, 2);
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

                    if(auth()->user()->can('admin.employee-loan.show')){
                        $btn .= '<a href="'.route('admin.employee-loan.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.employee-loan.edit')){
                        $btn .= '<a href="'.route('admin.employee-loan.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.employee-loan.destroy')){
                        $btn .= '<button
                            class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.employee-loan.destroy',$row->id).'">
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

        return view('hrm.employee_loan.index');
    }

  public function create()
    {
        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $companies = Company::orderBy('name', 'asc')->get();

        return view('hrm.employee_loan.create', compact('employees','companies'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id'    => 'required|exists:staff,id',
            'loan_type'      => 'required',
            'payroll_month'  => 'required|integer|between:1,12',
            'payroll_year'   => 'required|digits:4',
            'loan_amount'    => 'required|numeric|min:0',
            'installment_amount'        => 'nullable|numeric',
            'total_installments'        => 'nullable|numeric',
            'loan_date'      => 'required|date',
            'status'         => 'required|in:Pending,Approved,Paid',
            'remarks'        => 'nullable|string',
        ]);
       


            try {

            DB::transaction(function () use ($request) {

                // Generate Payment No
                $loan_no = $this->paymentGenerateNo();

                if($request->employee_id){
            $prev_total_instll=DB::table('hrm_employee_loan')->where('employee_id',$request->employee_id)->sum('total_installments');
            $total_instll_amount= ($prev_total_instll+$request->installment_amount);
        }
        DB::table('hrm_employee_loan')->insert([
            'company_id'   => $request->company_id,
            'branch_id'    => $request->project_id,
            'loan_no'      => $loan_no,
            'employee_id'   => $request->employee_id,
            'loan_type'    => $request->loan_type,
            'payroll_month' => $request->payroll_month,
            'payroll_year'  => $request->payroll_year,
            'loan_amount'        => $request->loan_amount,
            'installment_amount'        => 0,
            'total_installments'        => 0,
            'loan_date'  => $request->loan_date,
            'remarks'       => $request->remarks,
            'status'        => $request->status,
            'created_by'    => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $coa = CoaSetup::find(4);

         $postData = [];
                $postData[] = [
                    'company_id'     => $request->company_id,
                    'branch_id'      => $request->project_id,
                    'voucher_no'     => $loan_no,
                    'voucher_type'   => 'Loan',
                    'voucher_date'   => date('Y-m-d', strtotime($request->loan_date)),
                    'coa_setup_id'   => $coa->id,
                    'coa_head_code'  => $coa->head_name,
                    'narration'      => 'Loan Against PAYMENT NO - ' . $loan_no,
                    'debit_amount'   => $request->loan_amount,
                    'credit_amount'  => 0,
                    'created_by'     => auth()->id(),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];

                AccountTransactionAuto::insert($postData);

            });
            

        return redirect()
            ->route('admin.employee-loan.index')
            ->withSuccessMessage('Employee loan added successfully.');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Expense could not be saved: ' . $e->getMessage());
        }
    }

    public function paymentGenerateNo()
    {
        $prefix = "LOAN" . date('ym');

        $data = DB::table('hrm_employee_loan')
            ->where('loan_no', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($data) {
            $trim = str_replace($prefix, '', $data->loan_no);
            $dataPrefix = (int) $trim + 1;

            $loan = $prefix . str_pad($dataPrefix, 6, '0', STR_PAD_LEFT);
        } else {
            $loan = $prefix . '000001';
        }

        return $loan;
    }


    public function edit($id)
    {
        $loan = DB::table('hrm_employee_loan')->find($id);

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();
        $companies = Company::orderBy('name', 'asc')->get();
        $projects = Branch::where('company_id', $loan->company_id)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        return view('hrm.employee_loan.edit', compact('loan', 'employees','companies','projects'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'   => 'required|exists:staff,id',
            'loan_type'=> 'required',
            'payroll_month' => 'required|integer|between:1,12',
            'payroll_year'  => 'required|digits:4',
            'installment_amount'        => 'nullable|numeric',
            'total_installments'        => 'nullable|numeric',
            'loan_date'  => 'required|date',
            'status'        => 'required|in:Pending,Approved,Paid',
            'remarks'       => 'nullable|string|max:1000',
        ]);

        
       
         
        DB::table('hrm_employee_loan')
            ->where('id', $id)
            ->update([
                'company_id'   => $request->company_id,
                'branch_id'   => $request->project_id,
                'employee_id'   => $request->employee_id,
                'loan_type'    => $request->loan_type,
                'payroll_month' => $request->payroll_month,
                'payroll_year'  => $request->payroll_year,
                'loan_date'  => $request->loan_date,
                'remarks'       => $request->remarks,
                'status'        => $request->status,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);

            if($request->installment_amount >0 ){

            if($request->employee_id){
            $prev_total_instll=DB::table('hrm_employee_loan')->where('employee_id',$request->employee_id)->sum('total_installments');
            $total_instll_amount= ($prev_total_instll+$request->installment_amount);
             }

            $coa = CoaSetup::find(3);
             $loan_no = $this->paymentGenerateNo();
            $postData = [];
            $postData[] = [
                    'company_id'     => $request->company_id,
                    'branch_id'      => $request->project_id,
                    'voucher_no'     => $loan_no,
                    'voucher_type'   => 'Installment',
                    'voucher_date'   => date('Y-m-d', strtotime($request->loan_date)),
                    'coa_setup_id'   => $coa->id,
                    'coa_head_code'  => $coa->head_name,
                    'narration'      => 'Installment Against PAYMENT NO - ' . $loan_no,
                    'debit_amount'   => 0,
                    'credit_amount'  => $request->installment_amount,
                    'created_by'     => auth()->id(),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];

                AccountTransactionAuto::insert($postData);

            DB::table('hrm_employee_loan')->insert([
            'company_id'   => $request->company_id,
            'branch_id'    => $request->project_id,
            'loan_no'      => $loan_no,
            'employee_id'   => $request->employee_id,
            'loan_type'    => $request->loan_type,
            'payroll_month' => $request->payroll_month,
            'payroll_year'  => $request->payroll_year,
            'loan_amount'        => 0,
            'installment_amount'        => $request->installment_amount,
            'total_installments'        => 0,
            'loan_date'  => $request->loan_date,
            'remarks'       => $request->remarks,
            'status'        => $request->status,
            'created_by'    => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
            
            

        }

        if($request->installment_amount >0 ){

        return redirect()
            ->route('admin.employee-loan.index')
            ->withSuccessMessage('Installment paid successfully.');

        }else{

        return redirect()
            ->route('admin.employee-loan.index')
            ->withSuccessMessage('Employee loan updated successfully.');
        }   
       
    }

    
}