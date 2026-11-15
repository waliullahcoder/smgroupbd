<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\AccountTransactionAuto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VoucherApproveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        if (request()->ajax()) {

            $model = AccountTransactionAuto::with(['company'])
                ->selectRaw('
                    MIN(id) as id,
                    company_id,
                    voucher_no,
                    voucher_type,
                    MAX(voucher_date) as voucher_date,
                    SUM(debit_amount) as amount
                ')
                ->whereIn('voucher_type', ['Purchase', 'Collection', 'Expense', 'JV'])
                ->where('approve', 0)
                ->groupBy('company_id', 'voucher_type', 'voucher_no')
                ->orderByRaw('MAX(id) DESC');

            return DataTables::eloquent($model)

                ->addIndexColumn()

                ->addColumn('checkbox', function ($row) {

                    return '<div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            class="custom-control-input multi_checkbox"
                            id="' . $row->id . '"
                            name="multi_checkbox[]"
                            value="' . $row->id . '">

                        <label for="' . $row->id . '" class="custom-control-label"></label>
                    </div>';
                })

                ->editColumn('voucher_date', function ($row) {

                    return $row->voucher_date
                        ? date('d-m-Y', strtotime($row->voucher_date))
                        : '';
                })

                ->addColumn('debit_head', function ($row) {

                    return AccountTransactionAuto::with('coa')
                        ->where('company_id', $row->company_id)
                        ->where('voucher_no', $row->voucher_no)
                        ->where('voucher_type', $row->voucher_type)
                        ->where('debit_amount', '>', 0)
                        ->get()
                        ->pluck('coa.head_name')
                        ->filter()
                        ->implode(', ');
                })

                ->addColumn('credit_head', function ($row) {

                    return AccountTransactionAuto::with('coa')
                        ->where('company_id', $row->company_id)
                        ->where('voucher_no', $row->voucher_no)
                        ->where('voucher_type', $row->voucher_type)
                        ->where('credit_amount', '>', 0)
                        ->get()
                        ->pluck('coa.head_name')
                        ->filter()
                        ->implode(', ');
                })

                ->addColumn('actions', function ($row) {

                    return '<div class="justify-content-end d-flex gap-1">

                        <a class="btn btn-outline-info btn-xs text-nowrap px-2 tt"
                            href="' . route('admin.voucher-approve.show', $row->id) . '"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="View">

                            <i class="fas fa-eye"></i> View
                        </a>

                        <button type="button"
                            class="btn btn-outline-danger btn-xs text-nowrap approve-btn px-2 tt"
                            data-url="' . route('admin.voucher-approve.edit', $row->id) . '"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Approve">

                            <i class="fa fa-thumbs-up"></i> Approve
                        </button>

                    </div>';
                })

                ->rawColumns(['checkbox', 'actions'])

                ->make(true);
        }

        $title = 'Approve Vouchers';
        $disable_filter = true;

        return view('admin.approve_voucher.index', compact(
            'title',
            'disable_filter'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "View Voucher";
        $transaction = AccountTransactionAuto::findOrFail($id);
        $transactions = AccountTransactionAuto::where('voucher_no', $transaction->voucher_no)
            ->where('voucher_type', $transaction->voucher_type)->get();
        return view('admin.approve_voucher.view')->with(compact('title', 'transaction', 'transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax()) {
            DB::transaction(function () use ($id, $request) {
                $ids = $request->id ?? [$id]; // single or multiple IDs
                foreach ($ids as $id) {
                    $data = AccountTransactionAuto::findOrFail($id);
                    if (!$data->approve) {
                        AccountTransactionAuto::where('voucher_no', $data->voucher_no)
                            ->where('voucher_type', $data->voucher_type)
                            ->update([
                                'posted' => 1,
                                'approve' => 1,
                                'approve_by' => Auth::user()->id,
                            ]);
                        $transactions = AccountTransactionAuto::where('voucher_no', $data->voucher_no)
                            ->where('voucher_type', $data->voucher_type)->get();
                        foreach ($transactions as $item) {
                            AccountTransaction::create([
                                'company_id' => $item->company_id,
                                'branch_id' => $item->branch_id,
                                'account_transaction_auto_id' => $item->id,
                                'voucher_no' => $item->voucher_no,
                                'voucher_type' => $item->voucher_type,
                                'voucher_date' => $item->voucher_date,
                                'coa_setup_id' => $item->coa_setup_id,
                                'coa_head_code' => $item->coa_head_code,
                                'narration' => $item->narration,
                                'debit_amount' => $item->debit_amount,
                                'credit_amount' => $item->credit_amount,
                                'posted' => $item->posted,
                                'approve' => $item->approve,
                                'approve_by' => $item->approve_by,
                                'created_by' => $item->created_by,
                                'updated_by' => $item->updated_by
                            ]);
                        }
                    }
                }
            });

            return response()->json(['status' => 'success']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
