<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\AccountTransaction;
use App\Models\AccountTransactionAuto;
use App\Models\AdminSetting;
use App\Models\CoaSetup;
use App\Models\Lifting;
use App\Models\LiftingDocument;
use App\Models\LiftingProduct;
use App\Models\LiftingReturnList;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Scopes\CompanyScope;
use App\Models\Store;
use App\Models\Vendor;
use App\Models\VendorPayment;
use App\Models\VendorPaymentData;
use App\Services\ActionButtons\ActionButtons;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class LiftingFashionProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Lifting::with(['company', 'store', 'staff', 'vendor'])->where('product_type', 'Fashion')->latest('id');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $payemnt = VendorPaymentData::where('lifting_id', $row->id)->whereHas('payment')->first();
                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->lifting_no)->where('voucher_type', 'Product Purchase')->first();
                    $pay_transaction = AccountTransaction::withTrashed()->where('voucher_no', @$payemnt->payment->payment_no)->where('voucher_type', 'Vendor Payment')->first();
                    if (is_null($payemnt) && is_null($transaction) && is_null($pay_transaction)) {
                        $checkbox = '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                        return $checkbox;
                    }
                })
                ->addColumn('lifting_date', function ($row) {
                    return date('d-m-Y', strtotime($row->lifting_date));
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.lifting-fashion-product.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';
                    $payemnt = VendorPaymentData::where('lifting_id', $row->id)->whereHas('payment')->first();

                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->lifting_no)->where('voucher_type', 'Product Purchase')->first();
                    $pay_transaction = AccountTransaction::withTrashed()->where('voucher_no', @$payemnt->payment->payment_no)->where('voucher_type', 'Vendor Payment')->first();
                    if (is_null($payemnt) && is_null($transaction) && is_null($pay_transaction)) {
                        return ActionButtons::actions($data, $actionBtn);
                    }
                    return '<div class="btn-group">' . $actionBtn . '</div>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Fashion Product Lifting";
        return view('admin.lifting_fashion_product.index', compact('title'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $data = Lifting::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['lifting_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($data) {
            $trim = str_replace("ST", '', $data->lifting_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "ST" . $dataPrefix;
        } else {
            $invoice = "ST" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (request()->ajax() && request('get_variant')) {
            $variant = ProductSku::with(['product', 'product.category'])->where('id', $request->variant_id)->first();
            return response()->json(['status' => 'success', 'variant' => $variant]);
        }

        if (request()->ajax() && request('get_variants')) {
            $product = Product::with('sku')->where('id', $request->product_id)->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        $title = 'Add Fashion Product Lifting';
        $lifting_no = $this->invoice();
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        $products = Product::where('status', 1)->where('product_type', 'Fashion')->orderBy('name', 'asc')->get();
        return view('admin.lifting_fashion_product.create', compact('title', 'lifting_no', 'vendors', 'stores', 'cash_heads', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lifting_no' => 'required',
            'lifting_date' => 'required',
            'voucher_no' => 'required',
            'variant_id' => 'required',
            'lifting_price' => 'required',
            'quantity' => 'required',
        ]);

        $admin_setting = AdminSetting::first();
        if (@$admin_setting->accounting == 1 && $request->payment_type == 'cash') {
            $request->validate([
                'coa_setup_id' => 'required',
            ]);
        }

        $vendor = Vendor::find($request->vendor_id);
        if (@$admin_setting->accounting == 1 && is_null($vendor->coa)) {
            return redirect()->back()->withErrors('Please Setup a vendors account!');
        }

        DB::transaction(function () use ($request, $admin_setting) {
            $total_cost = 0;
            foreach ($request->quantity as $key => $quantity) {
                $total_cost += $request->lifting_price[$key] * $quantity;
            }

            $lifting = Lifting::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'store_id' => $request->store_id,
                'vendor_id' => $request->vendor_id,
                'lifting_no' => $this->invoice(),
                'voucher_no' => $request->voucher_no,
                'payment_type' => $request->payment_type,
                'lifting_date' => date('Y-m-d', strtotime($request->lifting_date)),
                'total_cost' => $total_cost,
                'discount' => $request->discount,
                'total_paid' => $request->payment_type == 'cash' ? $total_cost - $request->discount : 0.00,
                'product_type' => 'Fashion',
                'created_by' => Auth::user()->id,
            ]);

            $log_data = '';
            foreach ($request->variant_id as $key => $variant_id) {
                $variant = ProductSku::with('product')->where('id', $variant_id)->first();
                $discount = ($request->discount / $total_cost) * $request->amount[$key];
                if ($request->payment_type == 'cash') {
                    $total_paid = $request->amount[$key] - $discount;
                } else {
                    $total_paid = 0;
                }
                LiftingProduct::create([
                    'lifting_id' => $lifting->id,
                    'vendor_id' => $request->vendor_id,
                    'company_id' => Auth::user()->company_id ?? 1,
                    'store_id' => $request->store_id,
                    'product_id' => @$variant->product->id,
                    'variant_id' => $variant_id,
                    'total_amount' => $request->amount[$key],
                    'total_paid' => $total_paid,
                    'lifting_price' => $request->lifting_price[$key],
                    'discount' => $discount,
                    'qty' => $request->quantity[$key],
                    'product_type' => 'Fashion',
                    'created_by' => Auth::user()->id,
                ]);
                $log_data .= ' ' . @$variant->product->name . ' ' . $request->quantity[$key] . ' ' . @$variant->sku . ', ';
            }

            $vendor = Vendor::find($request->vendor_id);
            if ($vendor->coa && @$admin_setting->accounting == 1) {
                $expense_head = CoaSetup::where('head_name', 'Product Purchase')->first();
                $headCode = collect([
                    '0' => $expense_head->head_code,
                    '1' => $vendor->coa->head_code
                ]);

                $debit_amount = collect([
                    '0' => $total_cost - $request->discount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $total_cost - $request->discount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $lifting->lifting_no,
                        'voucher_type' => "Product Purchase",
                        'voucher_date' => date('Y-m-d', strtotime($request->lifting_date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Product Purchase Against Purchase No - ' . $lifting->lifting_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }

            if ($request->payment_type == 'cash') {
                $first = date('Y-m-01');
                $last = new Carbon('last day of this month');
                $pay_data = VendorPayment::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
                if ($pay_data) {
                    $trim = str_replace("STP", '', $pay_data->payment_no);
                    $dataPrefix = (int)$trim + 1;
                    $payment_no = "STP" . $dataPrefix;
                } else {
                    $payment_no = "STP" . date('y') . date('m') . '000001';
                }

                $vendor_payment = VendorPayment::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'vendor_id' => $request->vendor_id,
                    'lifting_id' => $lifting->id,
                    'payment_no' => $payment_no,
                    'payment_date' => date('Y-m-d', strtotime($request->lifting_date)),
                    'payment_type' => $request->payment_type,
                    'type' => 'payment',
                    'amount' => $total_cost - $request->discount,
                    'remarks' => 'Cash Purchase',
                    'created_by' => Auth::user()->id,
                ]);

                VendorPaymentData::create([
                    'vendor_payment_id' => $vendor_payment->id,
                    'lifting_id' => $lifting->id,
                    'paid' => $total_cost - $request->discount,
                ]);

                if ($vendor->coa && @$admin_setting->accounting == 1) {
                    $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                    $headCode = collect([
                        '0' => $vendor->coa->head_code,
                        '1' => $cash_head->head_code,
                    ]);

                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $payment_no,
                            'voucher_type' => "Vendor Payment",
                            'voucher_date' => date('Y-m-d', strtotime($request->lifting_date)),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Payment Vendor Against PAYMENT NO - ' . $payment_no,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                }
            }
            $documents = $request->file('document');
            if (isset($documents)) {
                $path = 'media/lifting-document/';
                foreach ($documents as $key => $document) {
                    $extension = $document->getClientOriginalExtension();
                    $file_name = Carbon::now()->toDateString() . '-' . Str::random(40) . '.' . $extension;
                    $path_file_name = $path . $file_name;
                    $document->move(public_path($path), $file_name);
                    LiftingDocument::create([
                        'lifting_id' => $lifting->id,
                        'document' => $path_file_name,
                    ]);
                }
            }

            $store = Store::findOrFail($request->store_id);
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Purchase',
                'action' => 'Add',
                'description' => 'Create a new purhcase with purchase no ' . $lifting->lifting_no . ' to ' . $store->name . ' products ' . $log_data . ' on ' . $request->payment_type,
                'user_id' => Auth::user()->id,
            ]);
        });
        return redirect()->route('admin.lifting-fashion-product.index')->withSuccessMessage('Created Successfully!');
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
        if (request()->ajax() && request('get_variant')) {
            $variant = ProductSku::with(['product', 'product.category'])->where('id', $request->variant_id)->first();
            return response()->json(['status' => 'success', 'variant' => $variant]);
        }

        if (request()->ajax() && request('get_variants')) {
            $product = Product::with('sku')->where('id', $request->product_id)->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        $title = 'Update Lifting Fashion Products';
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $data = Lifting::findOrFail($id);
        $lifting_products = LiftingProduct::with(['variant'])->where('lifting_id', $id)->get();
        $link = Route('admin.lifting-fashion-product.update', $id);
        $products = Product::where('status', 1)->where('product_type', 'Fashion')->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        return view('admin.lifting_fashion_product.edit', compact('title', 'vendors', 'stores', 'data', 'lifting_products', 'link', 'products', 'cash_heads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'lifting_date' => 'required',
            'voucher_no' => 'required',
            'vendor_id' => 'required',
            'variant_id' => 'required',
            'lifting_price' => 'required',
            'quantity' => 'required',
        ]);

        $admin_setting = AdminSetting::first();
        if (@$admin_setting->accounting == 1 && $request->payment_type == 'cash') {
            $request->validate([
                'coa_setup_id' => 'required',
            ]);
        }

        $vendor = Vendor::find($request->vendor_id);
        if (@$admin_setting->accounting == 1 && is_null($vendor->coa)) {
            return redirect()->back()->withErrors('Please Setup a vendors account!');
        }

        DB::transaction(function () use ($request, $id, $admin_setting) {
            $total_cost = 0;
            foreach ($request->quantity as $key => $quantity) {
                $total_cost += $request->lifting_price[$key] * $quantity;
            }

            $lifting = Lifting::findOrFail($id);
            $payment = VendorPayment::withTrashed()->where('lifting_id', $id)->first();
            AccountTransactionAuto::withTrashed()->where('voucher_no', $lifting->lifting_no)->where('voucher_type', 'Product Purchase')->forceDelete();
            if ($payment) {
                AccountTransactionAuto::withTrashed()->where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->forceDelete();
                $payment->forceDelete();
            }
            LiftingProduct::where('lifting_id', $id)->delete();

            $lifting->update([
                'store_id' => $request->store_id,
                'vendor_id' => $request->vendor_id,
                'voucher_no' => $request->voucher_no,
                'payment_type' => $request->payment_type,
                'lifting_date' => date('Y-m-d', strtotime($request->lifting_date)),
                'total_cost' => $total_cost,
                'discount' => $request->discount,
                'total_paid' => $request->payment_type == 'cash' ? $total_cost - $request->discount : 0.00,
                'updated_by' => Auth::user()->id,
            ]);

            $log_data = '';
            foreach ($request->variant_id as $key => $variant_id) {
                $variant = ProductSku::with('product')->where('id', $variant_id)->first();
                $discount = ($request->discount / $total_cost) * $request->amount[$key];
                if ($request->payment_type == 'cash') {
                    $total_paid = $request->amount[$key] - $discount;
                } else {
                    $total_paid = 0;
                }
                LiftingProduct::create([
                    'lifting_id' => $lifting->id,
                    'vendor_id' => $request->vendor_id,
                    'company_id' => Auth::user()->company_id ?? 1,
                    'store_id' => $request->store_id,
                    'product_id' => @$variant->product->id,
                    'variant_id' => $variant_id,
                    'total_amount' => $request->amount[$key],
                    'total_paid' => $total_paid,
                    'lifting_price' => $request->lifting_price[$key],
                    'discount' => $discount,
                    'qty' => $request->quantity[$key],
                    'product_type' => 'Fashion',
                    'created_by' => Auth::user()->id,
                ]);
                $log_data .= ' ' . @$variant->product->name . ' ' . $request->quantity[$key] . ' ' . @$variant->sku . ', ';
            }

            $vendor = Vendor::find($request->vendor_id);
            if ($vendor->coa && @$admin_setting->accounting == 1) {
                $expense_head = CoaSetup::where('head_name', 'Product Purchase')->first();
                $headCode = collect([
                    '0' => $expense_head->head_code,
                    '1' => $vendor->coa->head_code
                ]);

                $debit_amount = collect([
                    '0' => $total_cost - $request->discount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $total_cost - $request->discount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $lifting->lifting_no,
                        'voucher_type' => "Product Purchase",
                        'voucher_date' => date('Y-m-d', strtotime($request->lifting_date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Product Purchase Against Purchase No - ' . $lifting->lifting_no,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }

            if ($request->payment_type == 'cash') {
                $first = date('Y-m-01');
                $last = new Carbon('last day of this month');
                $pay_data = VendorPayment::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
                if ($pay_data) {
                    $trim = str_replace("STP", '', $pay_data->payment_no);
                    $dataPrefix = (int)$trim + 1;
                    $payment_no = "STP" . $dataPrefix;
                } else {
                    $payment_no = "STP" . date('y') . date('m') . '000001';
                }

                // Need Fixing for multiple Vendor Lifting Product
                $vendor_payment = VendorPayment::create([
                    'company_id' => Auth::user()->company_id ? Auth::user()->company_id : 1,
                    'vendor_id' => $request->vendor_id,
                    'lifting_id' => $id,
                    'payment_no' => $payment_no,
                    'payment_date' => date('Y-m-d', strtotime($request->lifting_date)),
                    'payment_type' => $request->payment_type,
                    'type' => 'payment',
                    'amount' => $total_cost - $request->discount,
                    'remarks' => 'Cash Purchase',
                    'created_by' => Auth::user()->id,
                ]);

                VendorPaymentData::create([
                    'vendor_payment_id' => $vendor_payment->id,
                    'lifting_id' => $lifting->id,
                    'paid' => $total_cost - $request->discount,
                ]);

                if ($vendor->coa && @$admin_setting->accounting == 1) {
                    $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                    $headCode = collect([
                        '0' => $vendor->coa->head_code,
                        '1' => $cash_head->head_code,
                    ]);

                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $payment_no,
                            'voucher_type' => "Vendor Payment",
                            'voucher_date' => date('Y-m-d', strtotime($request->lifting_date)),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Payment Vendor Against PAYMENT NO - ' . $payment_no,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                }
            }
            $documents = $request->file('document');
            if (isset($documents)) {
                $path = 'media/lifting-document/';
                foreach ($documents as $key => $document) {
                    $extension = $document->getClientOriginalExtension();
                    $file_name = Carbon::now()->toDateString() . '-' . Str::random(40) . '.' . $extension;
                    $path_file_name = $path . $file_name;
                    $document->move(public_path($path), $file_name);
                    LiftingDocument::create([
                        'lifting_id' => $lifting->id,
                        'document' => $path_file_name,
                    ]);
                }
            }

            $store = Store::findOrFail($request->store_id);
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Purchase',
                'action' => 'Update',
                'description' => 'Update purhcase against purchase no ' . $lifting->lifting_no . ' to ' . $store->name . ' products : ' . $log_data . ' on ' . $request->payment_type,
                'user_id' => Auth::user()->id,
            ]);
        });
        return redirect()->route('admin.lifting-fashion-product.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Lifting::onlyTrashed()->findOrFail($id);
            foreach ($data->products as $item) {
                LiftingReturnList::onlyTrashed()->where('lifting_product_id', $item->id)->restore();
            }
            AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->restore();

            $payment = VendorPayment::onlyTrashed()->where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();
            if ($payment) {
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->restore();
                $payment->restore();
            }
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Lifting::onlyTrashed()->findOrFail($id);
                foreach ($data->products as $item) {
                    LiftingReturnList::where('lifting_product_id', $item->id)->forceDelete();
                }
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->forceDelete();
                $payment = VendorPayment::onlyTrashed()->where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();
                if ($payment) {
                    AccountTransactionAuto::onlyTrashed()->where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->forceDelete();
                    $payment->forceDelete();
                }
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Lifting::onlyTrashed()->findOrFail($id);
            foreach ($data->products as $item) {
                LiftingReturnList::where('lifting_product_id', $item->id)->forceDelete();
            }
            AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->forceDelete();
            $payment = VendorPayment::onlyTrashed()->where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();
            if ($payment) {
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->forceDelete();
                $payment->forceDelete();
            }
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Lifting::findOrFail($id);
                foreach ($data->products as $item) {
                    LiftingReturnList::where('lifting_product_id', $item->id)->delete();
                }
                AccountTransactionAuto::where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->delete();
                $payment = VendorPayment::where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();

                AccessLog::create([
                    'date_time' => Carbon::now(),
                    'page' => 'Purchase',
                    'action' => 'Delete',
                    'description' => 'Purchase delete against purchase no ' . $data->lifting_no . (!is_null($payment) ? ' payment delete ' . $payment->payment_no  : ''),
                    'user_id' => Auth::user()->id,
                ]);

                if ($payment) {
                    AccountTransactionAuto::where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->delete();
                    $payment->update(['deleted_by' => Auth::user()->id]);
                    $payment->delete();
                }
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Lifting::findOrFail($id);
        foreach ($data->products as $item) {
            LiftingReturnList::where('lifting_product_id', $item->id)->delete();
        }
        AccountTransactionAuto::where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->delete();
        $payment = VendorPayment::where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();

        AccessLog::create([
            'date_time' => Carbon::now(),
            'page' => 'Purchase',
            'action' => 'Delete',
            'description' => 'Purchase delete against purchase no ' . $data->lifting_no . (!is_null($payment) ? ' payment delete ' . $payment->payment_no  : ''),
            'user_id' => Auth::user()->id,
        ]);

        if ($payment) {
            AccountTransactionAuto::where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->delete();
            $payment->update(['deleted_by' => Auth::user()->id]);
            $payment->delete();
        }
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
