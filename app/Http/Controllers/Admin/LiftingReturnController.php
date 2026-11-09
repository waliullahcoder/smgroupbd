<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\AccountTransactionAuto;
use App\Models\AdminSetting;
use App\Models\CoaSetup;
use App\Models\Company;
use App\Models\Lifting;
use App\Models\LiftingProduct;
use App\Models\LiftingReturn;
use App\Models\LiftingReturnList;
use App\Models\LiftingReturnPayment;
use App\Models\Product;
use App\Models\Scopes\CompanyScope;
use App\Models\Store;
use App\Models\Vendor;
use App\Models\VendorPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;

class LiftingReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = LiftingReturn::with(['company', 'vendor', 'store', 'staff'])->orderBy('id', 'desc');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $transaction = AccountTransactionAuto::withTrashed()->where('voucher_no', $row->return_no)->where('voucher_type', 'Purchase Return')->first();
                    if (!is_null($transaction) && $transaction->posted == 0 || is_null($transaction)) {
                        $checkbox = '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                        return $checkbox;
                    }
                })
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info" href="' . Route('admin.lifting-return.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';

                    $transaction = AccountTransactionAuto::withTrashed()->where('voucher_no', $row->return_no)->where('voucher_type', 'Purchase Return')->first();
                    if (!is_null($transaction) && $transaction->posted == 0 || is_null($transaction)) {
                        return ActionButtons::actions($data, $actionBtn);
                    }
                    return '<div class="btn-group">' . $actionBtn . '</div>';

                    return ActionButtons::actions($data, $actionBtn);
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Purchase Return";
        return view('admin.lifting_return.index', compact('title'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $data = LiftingReturn::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['return_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($data) {
            $trim = str_replace("STR", '', $data->return_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "STR" . $dataPrefix;
        } else {
            $invoice = "STR" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('get_products')) {
            $products = Product::whereHas('liftings', function ($query) use ($request) {
                $query->where('vendor_id', $request->vendor_id);
            })->where('status', 1)->orderBy('name', 'asc')->get();
            return response()->json(['status' => 'success', 'products' => $products]);
        }

        if ($request->ajax()) {
            $query = LiftingProduct::with(['vendor', 'product', 'variant', 'variant.product', 'lifting'])->where('vendor_id', $request->vendor_id)->whereColumn('qty', '>', 'return_qty');
            if (!empty($request->product_id)) {
                $query->whereIn('product_id', $request->product_id);
            }
            $data = $query->get();
            return response()->json(['status' => 'success', 'data' => $data]);
        }

        $title = 'Add New Purchase Return';
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $return_no = $this->invoice();
        return view('admin.lifting_return.create', compact('title', 'vendors', 'stores', 'return_no'));
    }

    public function paymentNo()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $pay_data = VendorPayment::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($pay_data) {
            $trim = str_replace("STP", '', $pay_data->payment_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "STP" . $dataPrefix;
        } else {
            $invoice = "STP" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required',
            'store_id' => 'required',
            'date' => 'required',
            'return_no' => 'required',
            'remarks' => 'required',
            'lifting_product_id' => 'required',
        ]);

        $return_no = $this->invoice();
        DB::transaction(function () use ($request, $return_no) {
            $amount = 0;
            foreach ($request->lifting_product_id as $lifting_product_id) {
                if ($request->return_qty[$lifting_product_id] <= 0) {
                    continue;
                }
                $lifting_product = LiftingProduct::findOrFail($lifting_product_id);
                $amount += ($lifting_product->net_amount / $lifting_product->qty)  * $request->return_qty[$lifting_product_id];
            }

            $lifting_return = LiftingReturn::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'product_type' => $request->product_type ?? 'Consumer',
                'vendor_id' => $request->vendor_id,
                'store_id' => $request->store_id,
                'return_no' => $return_no,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $amount,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->id,
            ]);

            $log_data = '';
            $lifting_id = [];
            foreach ($request->lifting_product_id as $lifting_product_id) {
                if ($request->return_qty[$lifting_product_id] <= 0) {
                    continue;
                } else {
                    $lifting_product = LiftingProduct::findOrFail($lifting_product_id);
                    $lifting_id[] = $lifting_product->lifting_id;
                    if ($lifting_product->product_type == 'Consumer') {
                        $log_data .= ' ' . $lifting_product->product->name . ' ' . $request->return_qty[$lifting_product_id] . ' ' . $lifting_product->product->attribute->name . ' ';
                    } else {
                        $log_data .= ' ' . @$lifting_product->variant->product->name . ' ' . @$lifting_product->variant->sku . ' ' . $request->return_qty[$lifting_product_id] . ' ';
                    }

                    $discount = ($lifting_product->discount / $lifting_product->total_amount) * ($request->return_qty[$lifting_product_id] * $lifting_product->lifting_price);
                    $net_price = $lifting_product->net_amount / $lifting_product->qty;
                    $lifting_product->update([
                        'return_qty' =>  $lifting_product->return_qty + $request->return_qty[$lifting_product_id],
                        'return_amount' => $lifting_product->return_amount + $net_price * $request->return_qty[$lifting_product_id]
                    ]);

                    $purchase =  Lifting::find($lifting_product->lifting_id);
                    $purchase->update([
                        'return_amount' => $purchase->return_amount + $net_price * $request->return_qty[$lifting_product_id],
                    ]);

                    LiftingReturnList::create([
                        'company_id' => Auth::user()->company_id ?? 1,
                        'lifting_return_id' => $lifting_return->id,
                        'vendor_id' => $request->vendor_id,
                        'store_id' => $request->store_id,
                        'lifting_id' => $lifting_product->lifting_id,
                        'lifting_product_id' => $lifting_product_id,
                        'product_type' => $lifting_product->product_type,
                        'product_id' => $lifting_product->product_id,
                        'variant_id' => $lifting_product->variant_id,
                        'lifting_price' => $lifting_product->lifting_price,
                        'qty' => $request->return_qty[$lifting_product_id],
                        'amount' => $request->return_qty[$lifting_product_id] * $lifting_product->lifting_price,
                        'lifting_discount' => $discount,
                        'remarks' => $request->remarks,
                    ]);
                    // Decrease product stock for returned quantity
                    if ($product = Product::find($lifting_product->product_id)) {
                        $product->decreaseStock(
                            date('Y-m-d', strtotime($request->date)),
                            $request->store_id,
                            $request->return_qty[$lifting_product_id],
                            $lifting_product->lifting_price,
                            "Purchase Return #{$lifting_return->return_no}",
                            "Stock decreased due to purchase return"
                        );
                    }
                }
            }

            $vendor = Vendor::find($request->vendor_id);
            $admin_settings = AdminSetting::first();
            if (@$admin_settings->accounting == 1 && $vendor->coa) {
                $expense_head = CoaSetup::where('head_type', 'E')->where('head_name', 'Product Purchase')->first();
                $headCode = collect([
                    '0' => $vendor->coa->head_code,
                    '1' => $expense_head->head_code
                ]);

                $debit_amount = collect([
                    '0' => $amount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $amount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $lifting_return->return_no,
                        'voucher_type' => "Purchase Return",
                        'voucher_date' => date('Y-m-d', strtotime($request->date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Product Purchase Return Against Voucher No - ' . $lifting_return->return_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }

            $previous_payment = 0;
            $purchases = Lifting::whereIn('id', array_unique($lifting_id))->get();
            foreach ($purchases as $item) {
                $balance = $item->total_paid + $item->return_amount - $item->net_amount - $item->return_paid;
                if ($balance > 0) {
                    $lifting = Lifting::find($item->id);
                    $lifting->update([
                        'return_paid' => $lifting->return_paid + $balance
                    ]);
                    LiftingReturnPayment::create([
                        'lifting_return_id' => $lifting_return->id,
                        'lifting_id' => $item->id,
                        'amount' => $balance
                    ]);
                    $previous_payment +=  $balance;
                }
            }

            if ($previous_payment > 0) {
                $payment_no = $this->paymentNo();
                VendorPayment::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'vendor_id' => $request->vendor_id,
                    'lifting_return_id' => $lifting_return->id,
                    'payment_no' => $payment_no,
                    'payment_date' => date('Y-m-d', strtotime($request->date)),
                    'payment_type' => 'return',
                    'type' => 'return',
                    'amount' => $previous_payment,
                    'remarks' => 'Paid on Return Products',
                    'created_by' => Auth::user()->id,
                ]);
            }

            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Purchase Return',
                'action' => 'Add',
                'description' => 'Create a new purchase Return with Return no ' . $lifting_return->return_no . ' to ' . $vendor->name . ' return amount is ' . $lifting_return->amount . ' products ' . $log_data . ' for reason ' . $request->remarks,
                'user_id' => Auth::user()->id,
            ]);
        });
        return redirect()->Route('admin.lifting-return.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = LiftingReturn::findOrFail($id);
        $report_title = 'Purchase Return Voucher';
        // return view('admin.lifting_return.print', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.lifting_return.print', compact('title', 'informations', 'report_title', 'data'));
        return $pdf->stream('lifting_return_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('get_products')) {
            $products = Product::whereHas('liftings', function ($query) use ($request) {
                $query->where('vendor_id', $request->vendor_id);
            })->where('status', 1)->orderBy('name', 'asc')->get();
            return response()->json(['status' => 'success', 'products' => $products]);
        }

        if ($request->ajax()) {
            $editingReturnId = $id;

            $query = LiftingProduct::with(['vendor', 'product', 'lifting', 'returns'])
                ->where('vendor_id', $request->vendor_id);

            if (!empty($request->product_id)) {
                $query->whereIn('product_id', $request->product_id);
            }

            $data = $query->get();

            foreach ($data as $item) {
                $totalReturned = \App\Models\LiftingReturnList::where('lifting_product_id', $item->id)
                    ->when($editingReturnId, fn($q) => $q->where('lifting_return_id', '!=', $editingReturnId))
                    ->sum('qty');

                $currentReturnQty = \App\Models\LiftingReturnList::where('lifting_return_id', $editingReturnId)
                    ->where('lifting_product_id', $item->id)
                    ->value('qty') ?? 0;

                // Fix: do NOT add $currentReturnQty here
                $remaining = $item->qty - $totalReturned;

                $item->return_qty = $totalReturned;
                $item->current_return_qty = $currentReturnQty;
                $item->remaining_qty = $remaining;
            }

            // Only return items that can still be returned
            $data = $data->filter(fn($item) => $item->remaining_qty > 0)->values();

            return response()->json(['status' => 'success', 'data' => $data]);
        }


        $title = 'Update Purchase Return';
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $data = LiftingReturn::findOrFail($id);
        $products = Product::whereHas('liftings', function ($query) use ($data) {
            $query->where('vendor_id', $data->vendor_id);
        })->where('status', 1)->orderBy('name', 'asc')->get();
        $link = Route('admin.lifting-return.update', $id);
        return view('admin.lifting_return.edit', compact('title', 'vendors', 'stores', 'products', 'data', 'link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'vendor_id' => 'required',
            'store_id' => 'required',
            'date' => 'required',
            'return_no' => 'required',
            'remarks' => 'required',
            'lifting_product_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $amount = 0;
            foreach ($request->lifting_product_id as $lifting_product_id) {
                if ($request->return_qty[$lifting_product_id] <= 0) {
                    continue;
                }
                $lifting_product = LiftingProduct::findOrFail($lifting_product_id);
                $amount += ($lifting_product->net_amount / $lifting_product->qty)  * $request->return_qty[$lifting_product_id];
            }

            $lifting_return = LiftingReturn::findOrFail($id);

            $lifting_return->update([
                'company_id' => Auth::user()->company_id ?? 1,
                'vendor_id' => $request->vendor_id,
                'store_id' => $request->store_id,
                'product_type' => $request->product_type ?? 'Consumer',
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $amount,
                'remarks' => $request->remarks,
                'updated_by' => Auth::user()->id,
            ]);

            // Reverse Data
            $lifting_return_list = LiftingReturnList::where('lifting_return_id', $id)->get();
            foreach ($lifting_return_list as $item) {
                $lifting_product = LiftingProduct::findOrFail($item->lifting_product_id);
                $lifting_product->update([
                    'return_qty' => $lifting_product->return_qty - $item->qty,
                    'return_amount' => $lifting_product->return_amount - $item->amount + $item->lifting_discount
                ]);

                $purchase =  Lifting::find($lifting_product->lifting_id);
                $purchase->update([
                    'return_amount' => $purchase->return_amount - $item->amount + $item->lifting_discount
                ]);
                // When reversing an existing return (during update) put stock back
                if ($product = Product::find($lifting_product->product_id)) {
                    $product->increaseStock(
                        date('Y-m-d', strtotime($request->date)),
                        $request->store_id,
                        $item->qty,
                        $item->lifting_price,
                        "Purchase Return Update Reversal #{$lifting_return->return_no}",
                        "Stock increased due to return reversal during update"
                    );
                }
            }

            foreach ($lifting_return->payments as $item) {
                $lifting = Lifting::find($item->lifting_id);
                $lifting->update([
                    'return_paid' => $lifting->return_paid - $item->amount
                ]);
            }

            LiftingReturnPayment::where('lifting_return_id', $id)->delete();
            VendorPayment::where('lifting_return_id', $id)->forceDelete();
            LiftingReturnList::where('lifting_return_id', $id)->delete();
            // Reverse Data

            $log_data = '';
            $lifting_id = [];
            foreach ($request->lifting_product_id as $lifting_product_id) {
                if ($request->return_qty[$lifting_product_id] <= 0) {
                    continue;
                } else {
                    $lifting_product = LiftingProduct::findOrFail($lifting_product_id);
                    $lifting_id[] = $lifting_product->lifting_id;
                    if ($lifting_product->product_type == 'Consumer') {
                        $log_data .= ' ' . $lifting_product->product->name . ' ' . $request->return_qty[$lifting_product_id] . ' ' . $lifting_product->product->attribute->name . ' ';
                    } else {
                        $log_data .= ' ' . @$lifting_product->variant->product->name . ' ' . @$lifting_product->variant->sku . ' ' . $request->return_qty[$lifting_product_id] . ' ';
                    }

                    $discount = ($lifting_product->discount / $lifting_product->total_amount) * ($request->return_qty[$lifting_product_id] * $lifting_product->lifting_price);
                    $net_price = $lifting_product->net_amount / $lifting_product->qty;
                    $lifting_product->update([
                        'return_qty' =>  $lifting_product->return_qty + $request->return_qty[$lifting_product_id],
                        'return_amount' => $lifting_product->return_amount + $net_price * $request->return_qty[$lifting_product_id]
                    ]);

                    $purchase =  Lifting::find($lifting_product->lifting_id);
                    $purchase->update([
                        'return_amount' => $purchase->return_amount + $net_price * $request->return_qty[$lifting_product_id]
                    ]);

                    LiftingReturnList::create([
                        'company_id' => Auth::user()->company_id ?? 1,
                        'lifting_return_id' => $lifting_return->id,
                        'vendor_id' => $request->vendor_id,
                        'store_id' => $request->store_id,
                        'lifting_id' => $lifting_product->lifting_id,
                        'lifting_product_id' => $lifting_product_id,
                        'product_type' => $lifting_product->product_type,
                        'product_id' => $lifting_product->product_id,
                        'variant_id' => $lifting_product->variant_id,
                        'lifting_price' => $lifting_product->lifting_price,
                        'qty' => $request->return_qty[$lifting_product_id],
                        'amount' => $request->return_qty[$lifting_product_id] * $lifting_product->lifting_price,
                        'lifting_discount' => $discount,
                        'remarks' => $request->remarks,
                    ]);
                    // Decrease product stock for returned quantity (updated)
                    if ($product = Product::find($lifting_product->product_id)) {
                        $product->decreaseStock(
                            date('Y-m-d', strtotime($request->date)),
                            $request->store_id,
                            $request->return_qty[$lifting_product_id],
                            $lifting_product->lifting_price,
                            "Purchase Return #{$lifting_return->return_no}",
                            "Stock decreased due to purchase return"
                        );
                    }
                }
            }

            AccountTransactionAuto::withTrashed()->where('voucher_no', $lifting_return->return_no)->where('voucher_type', 'Purchase Return')->forceDelete();

            $vendor = Vendor::findOrFail($request->vendor_id);
            $admin_settings = AdminSetting::first();
            if (@$admin_settings->accounting == 1 && $vendor->coa) {
                $expense_head = CoaSetup::where('head_type', 'E')->where('head_name', 'Product Purchase')->first();
                $headCode = collect([
                    '0' => $vendor->coa->head_code,
                    '1' => $expense_head->head_code
                ]);

                $debit_amount = collect([
                    '0' => $amount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $amount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $lifting_return->return_no,
                        'voucher_type' => "Purchase Return",
                        'voucher_date' => date('Y-m-d', strtotime($request->date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Product Purchase Return Against Voucher No - ' . $lifting_return->return_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }

            $previous_payment = 0;
            $purchases = Lifting::whereIn('id', array_unique($lifting_id))->get();
            foreach ($purchases as $item) {
                $balance = $item->total_paid + $item->return_amount - $item->net_amount - $item->return_paid;
                if ($balance > 0) {
                    $lifting = Lifting::find($item->id);
                    $lifting->update([
                        'return_paid' => $lifting->return_paid + $balance
                    ]);
                    LiftingReturnPayment::create([
                        'lifting_return_id' => $lifting_return->id,
                        'lifting_id' => $item->id,
                        'amount' => $balance
                    ]);
                    $previous_payment +=  $balance;
                }
            }

            if ($previous_payment > 0) {
                $payment_no = $this->paymentNo();
                VendorPayment::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'vendor_id' => $request->vendor_id,
                    'lifting_return_id' => $lifting_return->id,
                    'payment_no' => $payment_no,
                    'payment_date' => date('Y-m-d', strtotime($request->date)),
                    'payment_type' => 'return',
                    'type' => 'return',
                    'amount' => $previous_payment,
                    'remarks' => 'Paid on Return Products',
                    'created_by' => Auth::user()->id,
                ]);
            }

            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Purchase Return',
                'action' => 'Update',
                'description' => 'Update purchase Return against Return no ' . $lifting_return->return_no . ' to ' . $vendor->name . ' return amount is ' . $lifting_return->amount . ' products ' . $log_data . ' for reason ' . $request->remarks,
                'user_id' => Auth::user()->id,
            ]);
        });
        return redirect()->Route('admin.lifting-return.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = LiftingReturn::onlyTrashed()->findOrFail($id);

            $lifting_return_list = LiftingReturnList::where('lifting_return_id', $id)->get();
            foreach ($lifting_return_list as $item) {
                $lifting_product = LiftingProduct::findOrFail($item->lifting_product_id);
                $lifting_product->update([
                    'return_qty' => $lifting_product->return_qty + $item->qty,
                    'return_amount' => $lifting_product->return_amount + $item->amount - $item->lifting_discount
                ]);

                $purchase =  Lifting::find($lifting_product->lifting_id);
                $purchase->update([
                    'return_amount' => $purchase->return_amount + $item->amount - $item->lifting_discount
                ]);
                // Reduce stock again because this is recovering a return
                if ($product = Product::find($lifting_product->product_id)) {
                    $product->decreaseStock(
                        date('Y-m-d'),
                        $data->store_id,
                        $item->qty,
                        $item->lifting_price,
                        "Purchase Return #{$data->return_no}",
                        "Stock decreased due to purchase return recovery"
                    );
                }
            }

            foreach ($data->payments as $item) {
                $lifting = Lifting::find($item->lifting_id);
                $lifting->update([
                    'return_paid' => $lifting->return_paid + $item->amount
                ]);
            }

            AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->return_no)->where('voucher_type', 'Purchase Return')->restore();
            VendorPayment::onlyTrashed()->where('lifting_return_id', $id)->restore();
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $lifting_return = LiftingReturn::onlyTrashed()->findOrFail($id);
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $lifting_return->return_no)->where('voucher_type', 'Purchase Return')->forceDelete();
                VendorPayment::onlyTrashed()->where('lifting_return_id', $id)->forceDelete();
                $lifting_return->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $lifting_return = LiftingReturn::onlyTrashed()->findOrFail($id);

            AccountTransactionAuto::onlyTrashed()->where('voucher_no', $lifting_return->return_no)->where('voucher_type', 'Purchase Return')->forceDelete();

            VendorPayment::onlyTrashed()->where('lifting_return_id', $id)->forceDelete();
            $lifting_return->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = LiftingReturn::findOrFail($id);
                $lifting_return_list = LiftingReturnList::where('lifting_return_id', $id)->get();
                foreach ($lifting_return_list as $item) {
                    $lifting_product = LiftingProduct::findOrFail($item->lifting_product_id);
                    $lifting_product->update([
                        'return_qty' => $lifting_product->return_qty - $item->qty,
                        'return_amount' => $lifting_product->return_amount - $item->amount + $item->lifting_discount
                    ]);

                    $purchase =  Lifting::find($lifting_product->lifting_id);
                    $purchase->update([
                        'return_amount' => $purchase->return_amount - $item->amount + $item->lifting_discount
                    ]);
                    // Return deletion: put returned items back into stock
                    if ($product = Product::find($lifting_product->product_id)) {
                        $product->increaseStock(
                            date('Y-m-d'),
                            $data->store_id,
                            $item->qty,
                            $item->lifting_price,
                            "Purchase Return Delete #{$data->return_no}",
                            "Stock increased due to purchase return deletion"
                        );
                    }
                }

                $log_data = '';
                foreach ($data->list as $item) {
                    $log_data .= ' ' . @$item->product->name . ' ' . $item->qty . ' ' . @$item->product->attribute->name . ' ';
                }
                AccessLog::create([
                    'date_time' => Carbon::now(),
                    'page' => 'Sales Return',
                    'action' => 'Delete',
                    'description' => 'Purchase return delete against return no ' . $data->return_no . ' on vendor ' . @$data->vendor->name . ' products ' . $log_data,
                    'user_id' => Auth::user()->id,
                ]);

                AccountTransactionAuto::where('voucher_no', $data->return_no)->where('voucher_type', 'Purchase Return')->update(['deleted_by' => Auth::user()->id]);
                AccountTransactionAuto::where('voucher_no', $data->return_no)->where('voucher_type', 'Purchase Return')->delete();

                foreach ($data->payments as $item) {
                    $lifting = Lifting::find($item->lifting_id);
                    $lifting->update([
                        'return_paid' => $lifting->return_paid - $item->amount
                    ]);
                }

                VendorPayment::where('lifting_return_id', $id)->delete();

                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        $data = LiftingReturn::findOrFail($id);
        $lifting_return_list = LiftingReturnList::where('lifting_return_id', $id)->get();
        foreach ($lifting_return_list as $item) {
            $lifting_product = LiftingProduct::findOrFail($item->lifting_product_id);
            $lifting_product->update([
                'return_qty' => $lifting_product->return_qty - $item->qty,
                'return_amount' => $lifting_product->return_amount - $item->amount + $item->lifting_discount
            ]);

            $purchase =  Lifting::find($lifting_product->lifting_id);
            $purchase->update([
                'return_amount' => $purchase->return_amount - $item->amount + $item->lifting_discount
            ]);
            // Single delete: put returned items back into stock
            if ($product = Product::find($lifting_product->product_id)) {
                $product->increaseStock(
                    date('Y-m-d'),
                    $data->store_id,
                    $item->qty,
                    $item->lifting_price,
                    "Purchase Return Delete #{$data->return_no}",
                    "Stock increased due to purchase return deletion"
                );
            }
        }

        $log_data = '';
        foreach ($data->list as $item) {
            $log_data .= ' ' . @$item->product->name . ' ' . $item->qty . ' ' . @$item->product->attribute->name . ' ';
        }
        AccessLog::create([
            'date_time' => Carbon::now(),
            'page' => 'Sales Return',
            'action' => 'Delete',
            'description' => 'Purchase return delete against return no ' . $data->return_no . ' on vendor ' . @$data->vendor->name . ' products ' . $log_data,
            'user_id' => Auth::user()->id,
        ]);

        AccountTransactionAuto::where('voucher_no', $data->return_no)->where('voucher_type', 'Purchase Return')->update(['deleted_by' => Auth::user()->id]);
        AccountTransactionAuto::where('voucher_no', $data->return_no)->where('voucher_type', 'Purchase Return')->delete();

        foreach ($data->payments as $item) {
            $lifting = Lifting::find($item->lifting_id);
            $lifting->update([
                'return_paid' => $lifting->return_paid - $item->amount
            ]);
        }

        VendorPayment::where('lifting_return_id', $id)->delete();

        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
