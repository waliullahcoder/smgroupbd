<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use Carbon\Carbon;
use App\Models\Store;
use App\Models\Vendor;
use App\Models\Company;
use App\Models\Lifting;
use App\Models\Product;
use App\Models\CoaSetup;
use App\Models\AccessLog;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Models\VendorPayment;
use App\Models\LiftingProduct;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\LiftingDocument;
use App\Models\LiftingReturnList;
use App\Models\VendorPaymentData;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTransaction;
use App\Models\Scopes\CompanyScope;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\AccountTransactionAuto;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;

class LiftingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Lifting::with(['company', 'store', 'staff', 'vendor'])->latest('id')->where('product_type', 'Consumer');
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
                    $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.lifting.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>
                                    <a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('admin.lifting-barcode.print', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Barcode" target="_blank"><i class="far fa-barcode-read"></i></a>';

                    $payemnt = VendorPaymentData::where('lifting_id', $row->id)->whereHas('payment')->first();
                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->lifting_no)->where('voucher_type', 'Product Purchase')->first();
                    if (is_null($payemnt) && is_null($transaction) || !is_null($payemnt) && $row->payment_type == 'cash' && is_null($transaction)) {
                        return ActionButtons::actions($data, $actionBtn);
                    }
                    return '<div class="btn-group">' . $actionBtn . '</div>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Product Lifting";
        return view('admin.lifting.index', compact('title'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $data = Lifting::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['lifting_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($data) {
            $trim = str_replace("STL", '', $data->lifting_no);
            $dataPrefix = (int)$trim + 1;
            $invoice = "STL" . $dataPrefix;
        } else {
            $invoice = "STL" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->get_product) {
            $product = Product::with(['price', 'category'])->where('id', $request->product_id)->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        if ($request->ajax()) {
            $product = Product::with('category')->where('code', $request->code)->whereNotNull('code')->first();
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $price = @$product->price->lifting_price;

            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->quantity[$product_id] + 1;
                $price = $request->lifting_price[$product_id];
                $amount = $total_qty * $price;
                return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount]);
            }

            return response()->json(['status' => 'success', 'product' => $product, 'price' => $price]);
        }

        $title = 'Add Product Lifting';
        $lifting_no = $this->invoice();
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.lifting.create', compact('title', 'lifting_no', 'vendors', 'stores', 'cash_heads', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lifting_no' => 'required',
            'lifting_date' => 'required',
            'vendor_id' => 'required',
            'product_id' => 'required',
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
            $lifting_no = $this->invoice();
            $lifting = Lifting::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'store_id' => $request->store_id,
                'vendor_id' => $request->vendor_id,
                'coa_setup_id' => $request->coa_setup_id,
                'lifting_no' => $lifting_no,
                'voucher_no' => $request->voucher_no,
                'payment_type' => $request->payment_type,
                'lifting_date' => date('Y-m-d', strtotime($request->lifting_date)),
                'total_cost' => $request->total_cost ?? 0,
                'discount' => $request->discount ?? 0,
                'net_amount' => ($request->total_cost ?? 0) - ($request->discount ?? 0),
                'total_paid' => $request->payment_type == 'cash' ? $request->net_payable : 0.00,
                'created_by' => Auth::user()->id,
            ]);

            $log_data = '';
            foreach ($request->product_id as $product_id) {
                $product = Product::where('id', $product_id)->first();
                $discount = ($request->discount / $request->total_cost) * $request->amount[$product_id];
                if ($request->payment_type == 'cash') {
                    $total_paid = $request->amount[$product_id] - $discount;
                } else {
                    $total_paid = 0;
                }
                LiftingProduct::create([
                    'lifting_id' => $lifting->id,
                    'company_id' => Auth::user()->company_id ?? 1,
                    'store_id' => $request->store_id,
                    'vendor_id' => $request->vendor_id,
                    'product_id' => $product_id,
                    'total_amount' => $request->amount[$product_id],
                    'total_paid' => $total_paid,
                    'lifting_price' => $request->lifting_price[$product_id],
                    'discount' => $discount,
                    'net_amount' => $request->amount[$product_id] - $discount,
                    'expiry_date' => !is_null(@$request->expiry_date[$product_id]) ? date('Y-m-d', strtotime(@$request->expiry_date[$product_id])) : null,
                    'qty' => $request->quantity[$product_id],
                    'created_by' => Auth::user()->id,
                ]);
                $log_data .= ' ' . $product->name . ' ' . $request->quantity[$product_id] . ' ' . $product->attribute->name . ' ';

                if ($productUpdate = Product::find($product_id)) {
                    $productUpdate->increaseStock(
                        date('Y-m-d', strtotime($request->lifting_date)),
                        $request->store_id,
                        $request->quantity[$product_id],
                        $request->lifting_price[$product_id],
                        "Purchase #{$lifting->lifting_no}",
                        "Stock increased from purchase"
                    );
                }
            }

            $vendor = Vendor::find($request->vendor_id);
            if ($vendor->coa && @$admin_setting->accounting == 1) {
                $expense_head = CoaSetup::where('head_type', 'E')->where('head_name', 'Product Purchase')->first();
                $headCode = collect([
                    '0' => $expense_head->head_code,
                    '1' => $vendor->coa->head_code
                ]);

                $debit_amount = collect([
                    '0' => $request->net_payable,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $request->net_payable,
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
                    'amount' => $request->total_cost - $request->discount,
                    'remarks' => 'Cash Purchase',
                    'created_by' => Auth::user()->id,
                ]);

                VendorPaymentData::create([
                    'vendor_payment_id' => $vendor_payment->id,
                    'lifting_id' => $lifting->id,
                    'paid' => $request->total_cost - $request->discount,
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

            $store = Store::findOrFail($request->store_id);
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Purchase',
                'action' => 'Add',
                'description' => 'Create a new purhcase with purchase no ' . $lifting->lifting_no . ' to ' . $store->name . ' products ' . $log_data . ' on ' . $request->payment_type,
                'user_id' => Auth::user()->id,
            ]);
        });

        return redirect()->route('admin.lifting.index')->withSuccessMessage('Created Successfully!');
    }

    public function barcodePrint(Request $request, string $id)
    {
        ini_set('max_execution_time', '500');
        ini_set("pcre.backtrack_limit", "5000000");

        $data = Lifting::findOrFail($id);
        return view('admin.lifting.barcode_print', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = Lifting::findOrFail($id);
        $report_title = 'Lifting Voucher';
        // return view('admin.lifting.print', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.lifting.print', compact('title', 'informations', 'report_title', 'data'));
        // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('product_lifting_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->get_product) {
            $product = Product::with(['price', 'category'])->where('id', $request->product_id)->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        if ($request->ajax()) {
            $product = Product::with('category')->where('code', $request->code)->whereNotNull('code')->first();
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $price = @$product->price->lifting_price;

            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->quantity[$product_id] + 1;
                $price = $request->lifting_price[$product_id];
                $amount = $total_qty * $price;
                return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount]);
            }

            return response()->json(['status' => 'success', 'product' => $product, 'price' => $price]);
        }

        $title = 'Update Lifting Products';
        $vendors = Vendor::where('status', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $data = Lifting::findOrFail($id);
        $lifting_products = LiftingProduct::with(['product'])->where('lifting_id', $id)->get();
        $link = Route('admin.lifting.update', $id);
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        return view('admin.lifting.edit', compact('title', 'vendors', 'stores', 'data', 'lifting_products', 'link', 'products', 'cash_heads'));
    }

    public function showDocument(string $id)
    {
        $lifting_documents =  LiftingDocument::where('lifting_id', $id)->get();
        $zip = new ZipArchive();
        $fileName = 'downloads.zip';
        // Add File in ZipArchive
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            foreach ($lifting_documents as $file) {
                $path =  public_path($file->document);
                $relativeName = basename($path);
                $zip->addFile($path, $relativeName);
            }
        }
        // Close ZipArchive
        $zip->close();
        return response()->download($fileName);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'lifting_no' => 'required',
            'lifting_date' => 'required',
            'vendor_id' => 'required',
            'product_id' => 'required',
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

            $lifting = Lifting::findOrFail($id);
            $oldStoreId = $lifting->store_id;
            $payment = VendorPayment::withTrashed()->where('lifting_id', $id)->first();
            AccountTransactionAuto::withTrashed()->where('voucher_no', $lifting->lifting_no)->where('voucher_type', 'Product Purchase')->forceDelete();
            if ($payment) {
                AccountTransactionAuto::withTrashed()->where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->forceDelete();
                $payment->forceDelete();
            }
            foreach ($lifting->products as $item) {
                LiftingReturnList::where('lifting_product_id', $item->id)->forceDelete();
            }

            // LiftingProduct::where('lifting_id', $id)->delete();

            $lifting->update([
                'store_id' => $request->store_id,
                'vendor_id' => $request->vendor_id,
                'coa_setup_id' => $request->coa_setup_id,
                'voucher_no' => $request->voucher_no,
                'payment_type' => $request->payment_type,
                'lifting_date' => date('Y-m-d', strtotime($request->lifting_date)),
                'total_cost' => $request->total_cost ?? 0,
                'discount' => $request->discount ?? 0,
                'net_amount' => ($request->total_cost ?? 0) - ($request->discount ?? 0),
                'total_paid' => $request->payment_type == 'cash' ? $request->net_payable : 0.00,
                'updated_by' => Auth::user()->id,
            ]);

            $log_data = '';
            $existingIds = $lifting->products()->pluck('id')->toArray();
            $updatedIds = [];
            foreach ($request->product_id as $product_id) {
                $discount = ($request->discount / $request->total_cost) * $request->amount[$product_id];
                if ($request->payment_type == 'cash') {
                    $total_paid = $request->amount[$product_id] - $discount;
                } else {
                    $total_paid = 0;
                }

                $existingItem = $lifting->products()->where('product_id', $product_id)->first();
                $oldQty = $existingItem ? $existingItem->qty : 0;

                $cartItem = $lifting->products()->updateOrCreate(
                    ['product_id' => $product_id],
                    [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'store_id' => $request->store_id,
                        'vendor_id' => $request->vendor_id,
                        'product_id' => $product_id,
                        'total_amount' => $request->amount[$product_id],
                        'total_paid' => $total_paid,
                        'lifting_price' => $request->lifting_price[$product_id],
                        'discount' => $discount,
                        'net_amount' => $request->amount[$product_id] - $discount,
                        'expiry_date' => !is_null(@$request->expiry_date[$product_id]) ? date('Y-m-d', strtotime(@$request->expiry_date[$product_id])) : null,
                        'qty' => $request->quantity[$product_id],
                        'created_by' => Auth::user()->id,
                    ]
                );

                $updatedIds[] = $cartItem->id;

                $diff = $request->quantity[$product_id] - $oldQty;
                if ($diff != 0 && ($productUpdate = Product::find($product_id))) {
                    if ($diff > 0) {
                        $productUpdate->increaseStock(date('Y-m-d', strtotime($request->lifting_date)), $request->store_id, $diff, $request->lifting_price[$product_id], "Purchase #{$lifting->lifting_no}", "Stock increased from purchase update");
                    } else {
                        $productUpdate->decreaseStock(date('Y-m-d', strtotime($request->lifting_date)), $oldStoreId, abs($diff), $request->lifting_price[$product_id], "Purchase #{$lifting->lifting_no}", "Stock decreased from purchase update");
                    }
                }


                $product = Product::where('id', $product_id)->first();
                $log_data .= ' ' . $product->name . ' ' . $request->quantity[$product_id] . ' ' . $product->attribute->name . ' ';
            }

            // Remove deleted items & adjust stock
            $removedIds = array_diff($existingIds, $updatedIds);
            foreach ($removedIds as $rmId) {
                $rmItem = $lifting->products()->find($rmId);
                if ($rmItem && ($oldProduct = Product::find($rmItem->product_id))) {
                    $oldProduct->decreaseStock(date('Y-m-d', strtotime($request->lifting_date)), $oldStoreId, $rmItem->quantity, $rmItem->unit_price, "Purchase #{$lifting->lifting_no}", "Removed from purchase update");
                }
                $rmItem?->delete();
            }

            $vendor = Vendor::find($request->vendor_id);
            if ($vendor->coa && @$admin_setting->accounting == 1) {
                $expense_head = CoaSetup::where('head_type', 'E')->where('head_name', 'Product Purchase')->first();
                $headCode = collect([
                    '0' => $expense_head->head_code,
                    '1' => $vendor->coa->head_code
                ]);

                $debit_amount = collect([
                    '0' => $request->net_payable,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $request->net_payable,
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
                    'amount' => $request->total_cost - $request->discount,
                    'remarks' => 'Cash Purchase',
                    'created_by' => Auth::user()->id,
                ]);

                VendorPaymentData::create([
                    'vendor_payment_id' => $vendor_payment->id,
                    'lifting_id' => $lifting->id,
                    'paid' => $request->total_cost - $request->discount,
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

            $store = Store::findOrFail($request->store_id);
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Purchase',
                'action' => 'Update',
                'description' => 'Update purhcase against purchase no ' . $lifting->lifting_no . ' to ' . $store->name . ' products : ' . $log_data . ' on ' . $request->payment_type,
                'user_id' => Auth::user()->id,
            ]);
        });
        return redirect()->route('admin.lifting.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return DB::transaction(function () use ($id) {

                $recovery = request()->boolean('recovery');
                $permanent = request()->boolean('parmanent');
                $ids = request('id') ?? [$id];

                // --- Recovery ---
                if ($recovery) {
                    $data = Lifting::onlyTrashed()->findOrFail($id);

                    AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->restore();

                    $payment = VendorPayment::onlyTrashed()->where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();
                    if ($payment) {
                        AccountTransactionAuto::onlyTrashed()->where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->restore();
                        $payment->restore();
                    }

                    // --- Restore stock ---
                    foreach ($data->products as $item) {
                        if ($product = $item->product) {
                            $product->increaseStock(date('Y-m-d'), $data->store_id, $item->qty, $item->lifting_price, "Purchase #{$data->lifting_no} restored", "Stock increased due to purchase recovery");
                        }
                    }

                    $data->restore();

                    return response()->json(['status' => 'success', 'message' => 'Recovered Successfully!']);
                }

                // --- Permanent Delete ---
                if ($permanent) {
                    $items = Lifting::withTrashed()->whereIn('id', $ids)->get();
                    foreach ($items as $data) {
                        AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->lifting_no)->where('voucher_type', 'Product Purchase')->forceDelete();
                        $payment = VendorPayment::onlyTrashed()->where('lifting_id', $id)->where('remarks', 'Cash Purchase')->first();
                        if ($payment) {
                            AccountTransactionAuto::onlyTrashed()->where('voucher_no', $payment->payment_no)->where('voucher_type', 'Vendor Payment')->forceDelete();
                            $payment->forceDelete();
                        }
                        // Delete purchase permanently
                        $data->forceDelete();
                    }
                    return response()->json(['status' => 'success', 'message' => 'Permanently Deleted!']);
                }

                // --- Soft Delete ---
                $items = Lifting::with('products.product')->whereIn('id', $ids)->get();
                foreach ($items as $data) {
                    foreach ($data->products as $item) {
                        $checkReturn = LiftingReturnList::where('lifting_product_id', $item->id)->count();
                        if ($checkReturn) {
                            throw new \Exception("Cannot delete purchase #{$data->lifting_no} because it has associated return records.");
                        }
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

                    // Reverse stock
                    foreach ($data->products as $item) {
                        if ($product = $item->product) {
                            $product->decreaseStock(date('Y-m-d'), $data->store_id, $item->qty, $item->lifting_price, "Purchase #{$data->lifting_no} deleted", "Stock decreased due to purchase deletion");
                        }
                    }

                    $data->update(['deleted_by' => Auth::user()->id]);
                    // Soft delete purchase
                    $data->delete();
                }

                return response()->json(['status' => 'success', 'message' => 'Successfully Deleted!']);
            });
        } catch (\Throwable $e) {
            // info($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
