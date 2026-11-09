<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountTransactionAuto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTransaction;
use App\Models\AdminSetting;
use App\Models\CoaSetup;
use App\Models\DeliveryMan;
use Carbon\Carbon;

class OrderCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Order::with('area')->where('store_id', $request->store_id);
            if ($request->delivery_man_id) {
                $query->where('delivery_man_id', $request->delivery_man_id);
            }
            $orders = $query->where('status', 'Delivered')->where('collected', 0)->get();
            $delivery_men = DeliveryMan::where('store_id', $request->store_id)->where('status', 1)->get();
            return response()->json(['status' => 'success', 'orders' => $orders, 'delivery_men' => $delivery_men]);
        }

        $orders = Order::with('area')->where('status', 'Delivered')->where('collected', 0)->get();
        $title = 'Bulk Collection';
        $stores = Store::where('status', 1)->orderBy('name', 'asc')->get();
        $disable_back = true;
        return view('admin.order_collection.create', compact('title', 'stores', 'disable_back', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $orders = Order::whereIn('id', $request->order_id)->get();
            $admin_setting = AdminSetting::first();
            $client_head = CoaSetup::where('head_type', 'A')->where('head_name', 'Retail Client')->first();
            $cash_head = CoaSetup::where('head_type', 'A')->where('head_code', '1010201')->first();
            foreach ($orders as $item) {
                if (@$admin_setting->accounting == 1) {
                    $headCode = collect([
                        '0' => $cash_head->head_code,
                        '1' => $client_head->head_code
                    ]);

                    $debit_amount = collect([
                        '0' => $item->due,
                        '1' => 0.00
                    ]);

                    $credit_amount = collect([
                        '0' => 0.00,
                        '1' => $item->due,
                    ]);

                    $trim = str_replace("STOS", '', $item->invoice);
                    $invoice = "STOC" . $trim;

                    $countHead = count($headCode);
                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $invoice,
                            'voucher_type' => "Retail Collection",
                            'voucher_date' => date('Y-m-d', strtotime($item->date)),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Retail Collection Against PAYMENT NO - ' . $invoice,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'posted' => 1,
                            'approve' => 1,
                            'approve_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                    $transactions = AccountTransactionAuto::where('voucher_no', $invoice)->where('voucher_type', 'Retail Collection')->get();

                    foreach ($transactions as $single) {
                        AccountTransaction::create([
                            'company_id' => $single->company_id,
                            'account_transaction_auto_id' => $single->id,
                            'voucher_no' => $single->voucher_no,
                            'voucher_type' => $single->voucher_type,
                            'voucher_date' => $single->voucher_date,
                            'coa_setup_id' => $single->coa_setup_id,
                            'coa_head_code' => $single->coa_head_code,
                            'narration' => $single->narration,
                            'debit_amount' => $single->debit_amount,
                            'credit_amount' => $single->credit_amount,
                            'posted' => $single->posted,
                            'approve' => $single->approve,
                            'approve_by' => $single->approve_by,
                            'created_by' => $single->created_by,
                            'updated_by' => $single->updated_by
                        ]);
                    }
                }
                $item->update(['collected' => 1, 'status' => 'Collected', 'collected_at' => date('Y-m-d', strtotime($request->collected_at))]);
            }
        });

        return redirect()->back()->withSuccessMessage('Collected Successfully!');
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
    public function edit(Request $request, string $id)
    {
        //
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
