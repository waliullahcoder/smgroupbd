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

class BonusManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {

        if (request()->ajax()) {
            $model = DB::table('hrm_employee_bonuses as eb')
                ->leftJoin('staff as e', 'e.id', '=', 'eb.employee_id')
                ->select(
                    'eb.id',
                    'e.code as employee_code',
                    'e.name',
                    'eb.bonus_type',
                    'eb.payroll_month',
                    'eb.payroll_year',
                    'eb.amount',
                    'eb.payment_date',
                    'eb.status'
                );

            return DataTables::of($model)
    
                ->editColumn('payroll_month', function ($row) {
                
                    return date('F', mktime(0, 0, 0, $row->payroll_month, 1));
                })

                ->editColumn('payment_date', function ($row) {
                    return date('d M, Y', strtotime($row->payment_date));
                })

                ->editColumn('amount', function ($row) {
                    return number_format($row->amount, 2);
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

                    if(auth()->user()->can('admin.employee-bonus.show')){
                        $btn .= '<a href="'.route('admin.employee-bonus.show',$row->id).'"
                            class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.employee-bonus.edit')){
                        $btn .= '<a href="'.route('admin.employee-bonus.edit',$row->id).'"
                            class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if(auth()->user()->can('admin.employee-bonus.destroy')){
                        $btn .= '<button
                            class="btn btn-sm btn-danger link-delete"
                            data-url="'.route('admin.employee-bonus.destroy',$row->id).'">
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

        return view('hrm.employee_bonus.index');
    }

  public function create()
    {
        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.employee_bonus.create', compact('employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'employee_id'    => 'required|exists:staff,id',
            'bonus_type'     => 'required',
            'payroll_month'  => 'required|integer|between:1,12',
            'payroll_year'   => 'required|digits:4',
            'amount'         => 'required|numeric|min:0',
            'payment_date'   => 'required|date',
            'status'         => 'required|in:Pending,Approved,Paid',
            'remarks'        => 'nullable|string',
        ]);

        DB::table('hrm_employee_bonuses')->insert([
            'employee_id'   => $request->employee_id,
            'bonus_type'    => $request->bonus_type,
            'payroll_month' => $request->payroll_month,
            'payroll_year'  => $request->payroll_year,
            'amount'        => $request->amount,
            'payment_date'  => $request->payment_date,
            'remarks'       => $request->remarks,
            'status'        => $request->status,
            'created_by'    => auth()->id(),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()
            ->route('admin.employee-bonus.index')
            ->withSuccessMessage('Employee bonus added successfully.');
    }

    public function edit($id)
    {
        $bonus = DB::table('hrm_employee_bonuses')->find($id);

        $employees = DB::table('staff')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('hrm.employee_bonus.edit', compact('bonus', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id'   => 'required|exists:staff,id',
            'bonus_type'    => 'required|in:Festival,Performance,Yearly,Eid,Puja,Other',
            'payroll_month' => 'required|integer|between:1,12',
            'payroll_year'  => 'required|digits:4',
            'amount'        => 'required|numeric|min:0',
            'payment_date'  => 'required|date',
            'status'        => 'required|in:Pending,Approved,Paid',
            'remarks'       => 'nullable|string|max:1000',
        ]);

        DB::table('hrm_employee_bonuses')
            ->where('id', $id)
            ->update([
                'employee_id'   => $request->employee_id,
                'bonus_type'    => $request->bonus_type,
                'payroll_month' => $request->payroll_month,
                'payroll_year'  => $request->payroll_year,
                'amount'        => $request->amount,
                'payment_date'  => $request->payment_date,
                'remarks'       => $request->remarks,
                'status'        => $request->status,
                'updated_by'    => auth()->id(),
                'updated_at'    => now(),
            ]);

        return redirect()
            ->route('admin.employee-bonus.index')
            ->withSuccessMessage('Employee bonus updated successfully.');
    }

    
}