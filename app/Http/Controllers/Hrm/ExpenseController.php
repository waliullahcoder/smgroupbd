<?php

namespace App\Http\Controllers\Hrm;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\CoaSetup;
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

                    if(auth()->user()->can('admin.expense.edit')){
                        $btn .= '<a href="'.route('admin.expense.edit',$row->id).'"
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
            ->where('parent_id', 4)
            ->orderBy('head_name')
            ->get();

        return view('hrm.expense.create', compact('coas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'expense_head_id'    => 'required|exists:coa_setups,id',
            'expense_month'  => 'required|integer|between:1,12',
            'expense_year'   => 'required|digits:4',
            'expense_amount'    => 'required|numeric|min:0',
            'expense_date'      => 'required|date',
            'status'         => 'required|in:Pending,Approved,Paid',
            'remarks'        => 'nullable|string',
        ]);
        DB::table('hrm_expense')->insert([
            'expense_head_id'   => $request->expense_head_id,
            'expense_month' => $request->expense_month,
            'expense_year'  => $request->expense_year,
            'expense_amount'        => $request->expense_amount,
            'expense_date'  => $request->expense_date,
            'remarks'       => $request->remarks,
            'status'        => $request->status,
            'created_by'    => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()
            ->route('admin.expense.index')
            ->withSuccessMessage('Expense added successfully.');
    }

    public function edit($id)
    {
        $expense = DB::table('hrm_expense')->find($id);

        $coas = DB::table('coa_setups')
            ->where('parent_id', 4)
            ->orderBy('head_name')
            ->get();

        return view('hrm.expense.edit', compact('expense', 'coas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'expense_head_id'   => 'required|exists:coa_setups,id',
            'expense_month' => 'required|integer|between:1,12',
            'expense_year'  => 'required|digits:4',
            'expense_amount'        => 'required|numeric|min:0',
            'expense_date'  => 'required|date',
            'status'        => 'required|in:Pending,Approved,Paid',
            'remarks'       => 'nullable|string|max:1000',
        ]);
      
        DB::table('hrm_expense')
            ->where('id', $id)
            ->update([
                'expense_head_id'   => $request->expense_head_id,
                'expense_month' => $request->expense_month,
                'expense_year'  => $request->expense_year,
                'expense_amount'   => $request->expense_amount,
                'expense_date'  => $request->expense_date,
                'remarks'       => $request->remarks,
                'status'        => $request->status,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);

        return redirect()
            ->route('admin.expense.index')
            ->withSuccessMessage('Expense updated successfully.');
    }

    
}