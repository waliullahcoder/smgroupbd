<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\AccountTransactionAuto;
use App\Models\CoaSetup;
use App\Models\Invest;
use App\Models\Investor;
use App\Models\InvestorPayment;
use App\Models\InvestorProfitList;
use App\Models\Scopes\CompanyScope;
use App\Models\Wallet;
use App\Services\ActionButtons\ActionButtons;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = InvestorPayment::with(['investor'])->orderBy('id', 'desc');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            $sumValue = number_format($model->sum('amount'), 2);
            return DataTables::eloquent($model)
                ->with('sumValue', $sumValue)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('deposit_to', function ($row) {
                    if ($row->deposit_type == 'Cash Payment') {
                        return 'Cash Payment';
                    } elseif ($row->deposit_type == 'Bkash') {
                        return  $row->bkash;
                    } elseif ($row->deposit_type == 'Rocket') {
                        return  $row->rocket;
                    } elseif ($row->deposit_type == 'Nagad') {
                        return $row->nagad;
                    } elseif ($row->deposit_type == 'Bank Deposit') {
                        return $row->bank_account;
                    }
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $transaction = AccountTransaction::where('voucher_no', $row->payment_no)
                        ->where('voucher_type', 'Profit Payment')
                        ->first();
                    $additionalBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.payment.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="" target="_blank" data-bs-original-title="Print Payment Receipt" aria-label="Print Payment Receipt"><i class="fal fa-print"></i></a>';
                    if (is_null($transaction)) {
                        return ActionButtons::actions($data, $additionalBtn);
                    } else {
                        return $additionalBtn;
                    }
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $title = "Investor Payment";
        return view('admin.payment.index', compact('title'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $pay_data = InvestorPayment::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($pay_data) {
            $trim = str_replace("P", '', $pay_data->payment_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "P" . $dataPrefix;
        } else {
            $invoice = "P" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $amount_in = Wallet::where('investor_id', $request->investor_id)->where('type', 'Profit')->sum('amount_in');
            $amount_out = Wallet::where('investor_id', $request->investor_id)->where('type', 'Payment')->sum('amount_out');
            $balance = $amount_in - $amount_out;
            $total_investment = Invest::where('investor_id', $request->investor_id)->where('sattled', 0)->sum('amount');
            return response()->json(['status' => 'success', 'balance' => number_format($balance, 2), 'max' => $balance, 'total_investment' => number_format($total_investment, 2)]);
        }

        $title = "Investor Payment";
        $payment_no = $this->invoice();
        $investors = Investor::where('status', 1)->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        return view('admin.payment.create', compact('title', 'payment_no', 'investors', 'cash_heads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'amount' => 'required',
            'investor_id' => 'required',
            'deposit_type' => 'required',
        ]);

        $amount_in = Wallet::where('investor_id', $request->investor_id)->where('type', 'Profit')->sum('amount_in');
        $amount_out = Wallet::where('investor_id', $request->investor_id)->where('type', 'Payment')->sum('amount_out');
        $balance = $amount_in - $amount_out;

        if ($request->amount > $balance) {
            return redirect()->back()->withInput()->withErrors('You can not request more than balance amount!');
        }
        $investor = Investor::findOrFail($request->investor_id);
        if ($request->deposit_type == 'Bank Deposit') {
            if (is_null($investor->account_no) || is_null($investor->account_name) || is_null($investor->bank) || is_null($investor->branch)) {
                return redirect()->back()->withInput()->withErrors('Your Bank Credential is not valid!');
            }
        } elseif ($request->deposit_type == 'Bkash' && is_null($investor->bkash)) {
            return redirect()->back()->withInput()->withErrors('Your Bkash Credential is not valid!');
        } elseif ($request->deposit_type == 'Nagad' && is_null($investor->nagad)) {
            return redirect()->back()->withInput()->withErrors('Your Nagad Credential is not valid!');
        } elseif ($request->deposit_type == 'Rocket' && is_null($investor->rocket)) {
            return redirect()->back()->withInput()->withErrors('Your Rocket Credential is not valid!');
        }

        DB::transaction(function () use ($request, $investor) {
            $profit_list = InvestorProfitList::where('investor_id', $request->investor_id)->whereColumn('amount', '>', 'deposited_amount')->get();
            $amount = $request->amount;
            $deposit_data = [];
            foreach ($profit_list as $item) {
                $dipositable_amount = $item->amount - $item->deposited_amount;
                if ($amount > $dipositable_amount) {
                    $item->update([
                        'deposited' => 1,
                        'deposited_amount' => $item->deposited_amount + $dipositable_amount,
                    ]);
                    $single = [
                        'investor_profit_list_id' => $item->id,
                        'deposited_amount' => $dipositable_amount,
                    ];
                    array_push($deposit_data, $single);
                    $amount -= $dipositable_amount;
                } elseif ($amount > 0 && $amount <= $dipositable_amount) {
                    $item->update([
                        'deposited' => $amount == $dipositable_amount ? 1 : 0,
                        'deposited_amount' => $item->deposited_amount + $amount,
                    ]);
                    $single = [
                        'investor_profit_list_id' => $item->id,
                        'deposited_amount' => $amount,
                    ];
                    array_push($deposit_data, $single);
                    break;
                }
            }

            $data = InvestorPayment::create([
                'investor_id' => $request->investor_id,
                'payment_no' => $this->invoice(),
                'date' => date('Y-m-d', strtotime($request->date)),
                'deposit_type' => $request->deposit_type,
                'amount' => $request->amount,
                'bkash' => $request->deposit_type == 'Bkash' ? $investor->bkash : NULL,
                'rocket' => $request->deposit_type == 'Rocket' ? $investor->rocket : NULL,
                'nagad' => $request->deposit_type == 'Nagad' ? $investor->nagad : NULL,
                'bank_account' => $request->deposit_type == 'Bank Deposit' ? $investor->account_no : NULL,
                'remarks' => $request->remarks,
                'status' => 'Approved',
                'approved' => 1,
                'data' => json_encode($deposit_data),
                'created_by' => Auth::user()->id,
            ]);

            Wallet::create([
                'investor_id' => $investor->id,
                'investor_payment_id' => $data->id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount_out' => $request->amount,
                'type' => 'Payment',
                'approved' => 1,
                'created_by' => Auth::user()->id,
            ]);

            $investor = Investor::findOrFail($data->investor_id);
            if ($investor->coa) {
                $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                $headCode = collect([
                    '0' => $investor->coa->head_code,
                    '1' => $cash_head->head_code,
                ]);

                $debit_amount = collect([
                    '0' => $data->amount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $data->amount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $data->payment_no,
                        'voucher_type' => "Profit Payment",
                        'voucher_date' => date('Y-m-d', strtotime($data->date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Investor Payment Against PAYMENT NO - ' . $data->payment_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }
        });

        return redirect()->route('admin.payment.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = InvestorPayment::findOrFail($id);
        $report_title = 'Investor Payment';
        // return view("admin.payment.print", compact('report_title', 'data'));
        $pdf = Pdf::loadView("admin.payment.print", compact('report_title', 'data'));
        return $pdf->stream('investor_payment_voucher_' . date('d_m_Y_h_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax()) {
            $amount_in = Wallet::where('investor_id', $request->investor_id)->where('type', 'Profit')->sum('amount_in');
            $amount_out = Wallet::where('investor_id', $request->investor_id)->whereNot('investor_payment_id', $id)->where('type', 'Payment')->sum('amount_out');
            $balance = $amount_in - $amount_out;
            $total_investment = Invest::where('investor_id', $request->investor_id)->where('sattled', 0)->sum('amount');
            return response()->json(['status' => 'success', 'balance' => number_format($balance, 2), 'max' => $balance, 'total_investment' => number_format($total_investment, 2)]);
        }

        $title = "Investor Payment";
        $data = InvestorPayment::findOrFail($id);
        $investors = Investor::where('status', 1)->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        return view('admin.payment.edit', compact('title', 'data', 'investors', 'cash_heads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required',
            'amount' => 'required',
            'investor_id' => 'required',
            'deposit_type' => 'required',
        ]);

        $amount_in = Wallet::where('investor_id', $request->investor_id)->where('type', 'Profit')->sum('amount_in');
        $amount_out = Wallet::where('investor_id', $request->investor_id)->whereNot('investor_payment_id', $id)->where('type', 'Payment')->sum('amount_out');
        $balance = $amount_in - $amount_out;

        if ($request->amount > $balance) {
            return redirect()->back()->withInput()->withErrors('You can not request more than balance amount!');
        }
        $investor = Investor::findOrFail($request->investor_id);
        if ($request->deposit_type == 'Bank Deposit') {
            if (is_null($investor->account_no) || is_null($investor->account_name) || is_null($investor->bank) || is_null($investor->branch)) {
                return redirect()->back()->withInput()->withErrors('Your Bank Credential is not valid!');
            }
        } elseif ($request->deposit_type == 'Bkash' && is_null($investor->bkash)) {
            return redirect()->back()->withInput()->withErrors('Your Bkash Credential is not valid!');
        } elseif ($request->deposit_type == 'Nagad' && is_null($investor->nagad)) {
            return redirect()->back()->withInput()->withErrors('Your Nagad Credential is not valid!');
        } elseif ($request->deposit_type == 'Rocket' && is_null($investor->rocket)) {
            return redirect()->back()->withInput()->withErrors('Your Rocket Credential is not valid!');
        }

        DB::transaction(function () use ($request, $investor, $id) {
            $data = InvestorPayment::findOrFail($id);
            foreach (json_decode($data->data) as $single) {
                $list_item = InvestorProfitList::findOrFail($single->investor_profit_list_id);
                $list_item->update([
                    'deposited' => 0,
                    'deposited_amount' => $single->deposited_amount - $single->deposited_amount,
                ]);
            }

            $profit_list = InvestorProfitList::where('investor_id', $request->investor_id)->whereColumn('amount', '>', 'deposited_amount')->get();
            $amount = $request->amount;
            $deposit_data = [];
            foreach ($profit_list as $item) {
                $dipositable_amount = $item->amount - $item->deposited_amount;
                if ($amount > $dipositable_amount) {
                    $item->update([
                        'deposited' => 1,
                        'deposited_amount' => $item->deposited_amount + $dipositable_amount,
                    ]);
                    $single = [
                        'investor_profit_list_id' => $item->id,
                        'deposited_amount' => $dipositable_amount,
                    ];
                    array_push($deposit_data, $single);
                    $amount -= $dipositable_amount;
                } elseif ($amount > 0 && $amount <= $dipositable_amount) {
                    $item->update([
                        'deposited' => $amount == $dipositable_amount ? 1 : 0,
                        'deposited_amount' => $item->deposited_amount + $amount,
                    ]);
                    $single = [
                        'investor_profit_list_id' => $item->id,
                        'deposited_amount' => $amount,
                    ];
                    array_push($deposit_data, $single);
                    break;
                }
            }

            $data->update([
                'investor_id' => $request->investor_id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'deposit_type' => $request->deposit_type,
                'amount' => $request->amount,
                'bkash' => $request->deposit_type == 'Bkash' ? $investor->bkash : NULL,
                'rocket' => $request->deposit_type == 'Rocket' ? $investor->rocket : NULL,
                'nagad' => $request->deposit_type == 'Nagad' ? $investor->nagad : NULL,
                'bank_account' => $request->deposit_type == 'Bank Deposit' ? $investor->account_no : NULL,
                'remarks' => $request->remarks,
                'data' => json_encode($deposit_data),
                'updated_by' => Auth::user()->id,
            ]);

            $wallet = Wallet::where('investor_payment_id', $id)->first();
            $wallet->update([
                'investor_id' => $investor->id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount_out' => $request->amount,
                'type' => 'Payment',
                'updated_by' => Auth::user()->id,
            ]);

            AccountTransactionAuto::where('voucher_no', $data->payment_no)->where('voucher_type', 'Profit Payment')->forceDelete();
            $investor = Investor::findOrFail($data->investor_id);
            if ($investor->coa) {
                $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                $headCode = collect([
                    '0' => $investor->coa->head_code,
                    '1' => $cash_head->head_code,
                ]);

                $debit_amount = collect([
                    '0' => $data->amount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $data->amount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $data->payment_no,
                        'voucher_type' => "Profit Payment",
                        'voucher_date' => date('Y-m-d', strtotime($data->date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Investor Payment Against PAYMENT NO - ' . $data->payment_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }
        });

        return redirect()->route('admin.payment.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = InvestorPayment::withTrashed()->findOrFail($id);
            foreach (json_decode($data->data) as $single) {
                $list_item = InvestorProfitList::findOrFail($single->investor_profit_list_id);
                $list_item->update([
                    'deposited' => 0,
                    'deposited_amount' => $single->deposited_amount - $single->deposited_amount,
                ]);
            }
            Wallet::where('investor_payment_id', $id)->forceDelete();
            AccountTransactionAuto::where('voucher_no', $data->payment_no)->where('voucher_type', 'Profit Payment')->forceDelete();
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = InvestorPayment::withTrashed()->findOrFail($id);
        foreach (json_decode($data->data) as $single) {
            $list_item = InvestorProfitList::findOrFail($single->investor_profit_list_id);
            $list_item->update([
                'deposited' => 0,
                'deposited_amount' => $single->deposited_amount - $single->deposited_amount,
            ]);
        }
        Wallet::where('investor_payment_id', $id)->forceDelete();
        AccountTransactionAuto::where('voucher_no', $data->payment_no)->where('voucher_type', 'Profit Payment')->forceDelete();
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->forceDelete();

        return response()->json(['status' => 'success']);
    }
}
