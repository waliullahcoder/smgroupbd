<?php

namespace App\Http\Controllers\Hrm;
use App\Models\Client;
use App\Models\Company;
use App\Models\Branch;
use App\Models\ClientCategory;
use App\Models\CoaSetup;
use App\Models\AccountTransactionAuto;
use App\Models\coa_setups;
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

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {

        if (request()->ajax()) {
            $model = DB::table('hrm_expense as exp')
                ->leftJoin('coa_setups as c', 'c.id', '=', 'exp.expense_head_id')
                ->select(
                    'exp.id',
                    'c.head_name',
                    'exp.expense_no',
                    'exp.expense_month',
                    'exp.expense_year',
                    'exp.expense_amount',
                    'exp.expense_date',
                    'exp.status',
                    'exp.remarks'
                )->orderBy('id','desc');

            return DataTables::of($model)
    
                ->editColumn('expense_month', function ($row) {
                
                    return date('F', mktime(0, 0, 0, $row->expense_month, 1));
                })

                ->editColumn('expense_date', function ($row) {
                    return date('d M, Y', strtotime($row->expense_date));
                })

                ->editColumn('expense_amount', function ($row) {
                    return number_format($row->expense_amount, 2);
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

                    if(auth()->user()->can('admin.expense.show')){
                        $btn .= '<a href="'.route('admin.expense.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                   if (
                        auth()->user()->can('admin.expense.edit') &&
                        !str_starts_with($row->expense_no, 'STP')
                    ) {
                        $btn .= '<a href="' . route('admin.expense.edit', $row->id) . '"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.expense.destroy')){
                        $btn .= '<button
                            class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.expense.destroy',$row->id).'">
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

        return view('hrm.expense.index');
    }

  public function create()
    {
        $coas = DB::table('coa_setups')
            ->where('head_type', 'E')
            ->orderBy('head_name')
            ->get();
        $companies = Company::orderBy('name', 'asc')->get();
        return view('hrm.expense.create', compact('coas','companies'));
    }


   
    public function store(Request $request)
    {
        $request->validate([
            'expense_head_id' => 'required|exists:coa_setups,id',
            'expense_month'   => 'required|integer|between:1,12',
            'expense_year'    => 'required|digits:4',
            'expense_amount'  => 'required|numeric|min:0',
            'expense_date'    => 'required|date',
            'status'          => 'required|in:Pending,Approved,Paid',
            'remarks'         => 'nullable|string',
        ]);

        try {

            DB::transaction(function () use ($request) {

                // Generate Payment No
                $payment_no = $this->paymentGenerateNo();

                // Expense Head
                $coa = CoaSetup::findOrFail($request->expense_head_id);
                // Expense Insert
                DB::table('hrm_expense')->insert([
                    'company_id'      => $request->company_id,
                    'branch_id'       => $request->project_id,
                    'expense_no'      => $payment_no,
                    'expense_head_id' => $request->expense_head_id,
                    'expense_month'   => $request->expense_month,
                    'expense_year'    => $request->expense_year,
                    'expense_amount'  => $request->expense_amount,
                    'expense_date'    => $request->expense_date,
                    'remarks'         => $request->remarks,
                    'status'          => $request->status,
                    'created_by'      => auth()->id(),
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);

                // Account Transaction Insert
                $postData = [];

                $postData[] = [
                    'company_id'     => $request->company_id,
                    'branch_id'      => $request->project_id,
                    'voucher_no'     => $payment_no,
                    'voucher_type'   => 'Expense',
                    'voucher_date'   => date('Y-m-d', strtotime($request->expense_date)),
                    'coa_setup_id'   => $request->expense_head_id,
                    'coa_head_code'  => $coa->head_name,
                    'narration'      => 'Expense Against PAYMENT NO - ' . $payment_no,
                    'debit_amount'   => 0,
                    'credit_amount'  => $request->expense_amount,
                    'created_by'     => auth()->id(),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];

                AccountTransactionAuto::insert($postData);

            });

            return redirect()
                ->route('admin.expense.index')
                ->withSuccessMessage('Expense added successfully.');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors('Expense could not be saved: ' . $e->getMessage());
        }
    }


    
    public function paymentGenerateNo()
    {
        $prefix = "EXP" . date('ym');

        $data = DB::table('hrm_expense')
            ->where('expense_no', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($data) {
            $trim = str_replace($prefix, '', $data->expense_no);
            $dataPrefix = (int) $trim + 1;

            $invoice = $prefix . str_pad($dataPrefix, 6, '0', STR_PAD_LEFT);
        } else {
            $invoice = $prefix . '000001';
        }

        return $invoice;
    }


    public function edit($id)
    {
        $expense = DB::table('hrm_expense')->find($id);

        $coas = DB::table('coa_setups')
            ->where('parent_id', 4)
            ->orderBy('head_name')
            ->get();
        $companies = Company::orderBy('name', 'asc')->get();
        $projects = Branch::where('company_id', $expense->company_id)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);

        return view('hrm.expense.edit', compact('expense', 'coas','companies','projects'));
    }

    
public function update(Request $request, $id)
{
    $request->validate([
        'expense_head_id' => 'required|exists:coa_setups,id',
        'expense_month'   => 'required|integer|between:1,12',
        'expense_year'    => 'required|digits:4',
        'expense_amount'  => 'required|numeric|min:0',
        'expense_date'    => 'required|date',
        'status'          => 'required|in:Pending,Approved,Paid',
        'remarks'         => 'nullable|string|max:1000',
    ]);

    try {

        DB::transaction(function () use ($request, $id) {

            // Find Expense
            $expense = DB::table('hrm_expense')
                ->where('id', $id)
                ->lockForUpdate()
                ->first();

            if (!$expense) {
                throw new \Exception('Expense not found.');
            }

            // Expense Head
            $coa = CoaSetup::findOrFail($request->expense_head_id);

            // Update Expense
            DB::table('hrm_expense')
                ->where('id', $id)
                ->update([
                    'company_id'      => $request->company_id,
                    'branch_id'       => $request->project_id,
                    'expense_head_id' => $request->expense_head_id,
                    'expense_month'   => $request->expense_month,
                    'expense_year'    => $request->expense_year,
                    'expense_amount'  => $request->expense_amount,
                    'expense_date'    => $request->expense_date,
                    'remarks'         => $request->remarks,
                    'status'          => $request->status,
                    'updated_by'      => auth()->id(),
                    'updated_at'      => now(),
                ]);

            // Update Account Transaction
            $transaction = AccountTransactionAuto::withTrashed()
                ->where('voucher_no', $expense->expense_no)
                ->where('voucher_type', 'Expense')
                ->first();

            if ($transaction) {

                // Update Existing Transaction
                $transaction->update([
                    'company_id'     => $request->company_id,
                    'branch_id'      => $request->project_id,
                    'voucher_date'   => date('Y-m-d', strtotime($request->expense_date)),
                    'coa_setup_id'   => $request->expense_head_id,
                    'coa_head_code'  => $coa->head_name,
                    'narration'      => 'Expense Against PAYMENT NO - ' . $expense->expense_no,
                    'debit_amount'   => 0,
                    'credit_amount'  => $request->expense_amount,
                    'updated_by'     => auth()->id(),
                    'updated_at'     => now(),
                ]);

            } else {

                // Insert Transaction If Not Exists
                AccountTransactionAuto::create([
                    'company_id'     => $request->company_id,
                    'branch_id'      => $request->project_id,
                    'voucher_no'     => $expense->expense_no,
                    'voucher_type'   => 'Expense',
                    'voucher_date'   => date('Y-m-d', strtotime($request->expense_date)),
                    'coa_setup_id'   => $request->expense_head_id,
                    'coa_head_code'  => $coa->head_name,
                    'narration'      => 'Expense Against PAYMENT NO - ' . $expense->expense_no,
                    'debit_amount'   => 0,
                    'credit_amount'  => $request->expense_amount,
                    'created_by'     => auth()->id(),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }

        });

        return redirect()
            ->route('admin.expense.index')
            ->withSuccessMessage('Expense updated successfully.');

    } catch (\Exception $e) {

        return redirect()
            ->back()
            ->withInput()
            ->withErrors('Expense could not be updated: ' . $e->getMessage());
    }
}


    
}