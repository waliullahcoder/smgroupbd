<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Invest;
use App\Models\InvestorPayment;
use App\Models\InvestorProfitList;
use App\Models\Scopes\CompanyScope;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Payment Request";
        $payment_no = $this->invoice();
        $amount_in = Wallet::where('investor_id', Auth::user()->investor->id)->where('type', 'Profit')->sum('amount_in');
        $amount_out = Wallet::where('investor_id', Auth::user()->investor->id)->where('type', 'Payment')->sum('amount_out');
        $balance = $amount_in - $amount_out;
        $total_investment = Invest::where('investor_id', Auth::user()->investor->id)->where('sattled', 0)->sum('amount');
        return view('investor.payment.index', compact('title', 'payment_no', 'total_investment', 'balance'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $pay_data = InvestorPayment::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($pay_data) {
            $trim = str_replace("STIP", '', $pay_data->payment_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "STIP" . $dataPrefix;
        } else {
            $invoice = "STIP" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add New Request';
        $data = InvestorProfitList::with(['parent'])->where('investor_id', Auth::user()->investor->id)->where('deposited', 0)->get();
        $payment_no = $this->invoice();
        return view('investor.payment.create', compact('title', 'data', 'payment_no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'amount' => 'required',
            'deposit_type' => 'required',
        ]);

        $amount_in = Wallet::where('investor_id', Auth::user()->investor->id)->where('type', 'Profit')->sum('amount_in');
        $amount_out = Wallet::where('investor_id', Auth::user()->investor->id)->where('type', 'Payment')->sum('amount_out');
        $balance = $amount_in - $amount_out;
        if ($request->amount > $balance) {
            return redirect()->back()->withErrors('You can not request more than balance amount!');
        }

        if ($request->deposit_type == 'Bank Deposit') {
            if (is_null(Auth::user()->investor->account_no) || is_null(Auth::user()->investor->account_name) || is_null(Auth::user()->investor->bank) || is_null(Auth::user()->investor->branch)) {
                return redirect()->back()->withErrors('Your Bank Credential is not valid!');
            }
        } elseif ($request->deposit_type == 'Bkash' && is_null(Auth::user()->investor->bkash)) {
            return redirect()->back()->withErrors('Your Bkash Credential is not valid!');
        } elseif ($request->deposit_type == 'Nagad' && is_null(Auth::user()->investor->nagad)) {
            return redirect()->back()->withErrors('Your Nagad Credential is not valid!');
        } elseif ($request->deposit_type == 'Rocket' && is_null(Auth::user()->investor->rocket)) {
            return redirect()->back()->withErrors('Your Rocket Credential is not valid!');
        }

        DB::transaction(function () use ($request) {
            $data = InvestorPayment::create([
                'investor_id' => Auth::user()->investor->id,
                'payment_no' => $this->invoice(),
                'date' => date('Y-m-d', strtotime($request->date)),
                'deposit_type' => $request->deposit_type,
                'amount' => $request->amount,
                'bkash' => $request->deposit_type == 'Bkash' ? Auth::user()->investor->bkash : NULL,
                'rocket' => $request->deposit_type == 'Rocket' ? Auth::user()->investor->rocket : NULL,
                'nagad' => $request->deposit_type == 'Nagad' ? Auth::user()->investor->nagad : NULL,
                'bank_account' => $request->deposit_type == 'Bank Deposit' ? Auth::user()->investor->account_no : NULL,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->id,
            ]);

            Wallet::create([
                'investor_id' => Auth::user()->investor->id,
                'investor_payment_id' => $data->id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount_out' => $request->amount,
                'type' => 'Payment',
                'created_by' => Auth::user()->id,
            ]);
        });

        return redirect()->route('investor.payment.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Update Request';
        $data = InvestorPayment::findOrFail($id);
        $link = Route('investor.payment.update', $id);
        return view('investor.payment.edit', compact('title', 'data', 'link'));
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
