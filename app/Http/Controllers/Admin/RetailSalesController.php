<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Throwable;
use Carbon\Carbon;
use App\HelperClass;
use App\Models\Store;
use App\Models\Product;
use App\Models\CoaSetup;
use App\Models\AccessLog;
use App\Models\RetailSale;
use Illuminate\Http\Request;
use App\Models\AdminSetting;
use App\Models\RetailReturn;
use App\Models\RetailSaleList;
use App\Models\AccountTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\Scopes\CompanyScope;
use App\Services\RongtaRP850Printer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\AccountTransactionAuto;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;

class RetailSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = RetailSale::with(['company', 'store', 'staff'])->orderBy('id', 'desc');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            } else {
                $date = !is_null(request('date')) ? date('Y-m-d', strtotime(request('date'))) : date('Y-m-d');
                $model->where('date', $date);
            }

            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->invoice)->where('voucher_type', 'Retail Sales')->first();
                    if (is_null($transaction) && is_null($row->retail_return_id)) {
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

                    $addiotional_buttons = '<a class="btn btn-sm border-0 fs-13 text-white tt btn-print-1 brintToPos" href="' . Route('admin.running-sales.show', $row->id) . '" data-id="' . $row->id . '" id="printBtn' . $row->id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Invoice">
                        <span class="spinner">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor">
                                <circle class="spinner_DupU" cx="12" cy="3" r="0" />
                                <circle class="spinner_DupU spinner_GWtZ" cx="16.50" cy="4.21" r="0" />
                                <circle class="spinner_DupU spinner_n0Yb" cx="7.50" cy="4.21" r="0" />
                                <circle class="spinner_DupU spinner_dwN6" cx="19.79" cy="7.50" r="0" />
                                <circle class="spinner_DupU spinner_GIL4" cx="4.21" cy="7.50" r="0" />
                                <circle class="spinner_DupU spinner_46QP" cx="21.00" cy="12.00" r="0" />
                                <circle class="spinner_DupU spinner_DQhX" cx="3.00" cy="12.00" r="0" />
                                <circle class="spinner_DupU spinner_PD82" cx="19.79" cy="16.50" r="0" />
                                <circle class="spinner_DupU spinner_tVmX" cx="4.21" cy="16.50" r="0" />
                                <circle class="spinner_DupU spinner_eUgh" cx="16.50" cy="19.79" r="0" />
                                <circle class="spinner_DupU spinner_j38H" cx="7.50" cy="19.79" r="0" />
                                <circle class="spinner_DupU spinner_eUaP" cx="12" cy="21" r="0" />
                            </svg>
                        </span>
                    <i class="fal fa-print"></i></a>';
                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->invoice)->where('voucher_type', 'Retail Sales')->first();
                    $delete = 'yes';
                    $edit = 'yes';
                    if ($row->retail_return_id) {
                        $delete = 'no';
                        $edit = 'no';
                    }
                    if (is_null($transaction)) {
                        return ActionButtons::actions($data, $addiotional_buttons, $delete, $edit);
                    }
                    return '<div class="btn-group">' . $addiotional_buttons . '</div>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Retail Sales";
        $params = '<input type="text" class="form-control date_picker input-sm" id="date" name="date" style="width: 100px; min-height: auto;" value="' . date('d-m-Y') . '" placeholder="Sales Date">';
        return view('admin.retail_sales.index', compact('title', 'params'));
    }

    public function getOrderNo()
    {
        $sale = RetailSale::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['invoice'])->whereDate('created_at', '>=', date('Y-m-01'))->whereDate('created_at', '<=', date('Y-m-t'))->orderBy('id', 'desc')->first();
        if ($sale) {
            $trim = str_replace("RS", '', $sale->invoice);
            $salePrefix = (int)$trim + 1;
            $invoice = "RS" . $salePrefix;
        } else {
            $invoice = "RS" . date('y') . date('m') . '0001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('string')) {
            $phones = RetailSale::where('client_phone', 'like', $request->string . '%')->distinct('client_phone')->limit(10)->pluck('client_phone')->toArray();
            return response()->json(['status' => 'success', 'phones' => $phones]);
        }

        if ($request->ajax() && $request->has('add_product_id')) {
            $admin_setting = AdminSetting::first();
            $store_id = $admin_setting->store_id;
            $product = Product::with('attribute')->find($request->add_product_id);
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $unit = @$product->attribute->name;
            $price = $product->price->online_price - $product->price->discount_tk;
            $stock = HelperClass::stock($product_id, $store_id);

            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->qty[$product_id] + 1;
                if ($stock >= $total_qty) {
                    $amount = $total_qty * $price;
                    return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount, 'stock' => $stock]);
                } else {
                    return response()->json(['status' => 'error', 'data' => 'Stock Insuficient!']);
                }
            }
            if ($stock >= 0) {
                return response()->json(['status' => 'success', 'product' => $product, 'unit' => $unit, 'price' => $price, 'stock' => $stock]);
            } else {
                return response()->json(['status' => 'error', 'data' => 'stock not available any more for this product!']);
            }
        }

        if ($request->ajax()) {
            $admin_setting = AdminSetting::first();
            $store_id = $admin_setting->store_id;
            $product = Product::with('attribute')->where('code', $request->barcode)->first();
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $unit = @$product->attribute->name;
            $price = $product->price->online_price - $product->price->discount_tk;
            $stock = HelperClass::stock($product_id, $store_id);
           
            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->qty[$product_id] + 1;
                if ($stock >= $total_qty) {
                    $amount = $total_qty * $price;
                    return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount, 'stock' => $stock]);
                } else {
                    return response()->json(['status' => 'error', 'data' => 'Stock Insuficient!']);
                }
            }

            if ($stock >= 1) {
                return response()->json(['status' => 'success', 'product' => $product, 'unit' => $unit, 'price' => $price, 'stock' => $stock]);
            } else {
                return response()->json(['status' => 'error', 'data' => 'stock not available any more for this product!']);
            }
        }

        $admin_setting = AdminSetting::first();
        if (is_null(@$admin_setting->store)) {
            return redirect()->back()->withErrors('Please setup a store for POS Sale!');
        }

        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash at Bank');
        })->get();

        $title = 'Add New Sales';
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        $custom_btn = ['name' => 'New Cart', 'link' => url()->current(), 'target' => '_blank'];
        $returnData = RetailReturn::find($request->return_id);
        $customHtml = '<div class="d-inline-flex gap-2 align-items-center pe-2">
                            <div class="form-check d-inline-flex mb-0 align-items-baseline gap-1">
                                <input class="form-check-input c-pointer" type="checkbox" name="is_print" id="isPrint" value="1" checked>
                                <label class="form-check-label c-pointer" for="isPrint">Print</label>
                            </div>
                            <div class="form-check d-inline-flex mb-0 align-items-baseline gap-1">
                                <input class="form-check-input c-pointer sale_type" type="radio" name="sale_type" id="barcodeType" value="barcode" checked>
                                <label class="form-check-label c-pointer" for="barcodeType">By Barcode</label>
                            </div>
                            <div class="form-check d-inline-flex mb-0 align-items-baseline gap-1">
                                <input class="form-check-input c-pointer sale_type" type="radio" name="sale_type" id="manual" value="manual">
                                <label class="form-check-label c-pointer" for="manual">By Manual</label>
                            </div>
                        </div>';
        return view('admin.retail_sales.create', compact('title', 'custom_btn', 'cash_heads', 'products', 'returnData', 'customHtml'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coa_setup_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, &$data) {
                $admin_setting = AdminSetting::first();
                $data = RetailSale::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'store_id' => $admin_setting->store_id,
                    'invoice' => $this->getOrderNo(),
                    'coa_setup_id' => $request->coa_setup_id,
                    'payment_type' => $request->payment_type,
                    'client_name' => $request->client_name,
                    'client_phone' => $request->client_phone,
                    'date' => date('Y-m-d'),
                    'total_amount' => array_sum($request->amount),
                    'discount' => $request->discount ?? 0,
                    'net_amount' => array_sum($request->amount) - $request->discount,
                    'retail_return_id' => $request->retail_return_id,
                    'return_deduction' => $request->return_deduction ?? 0,
                    'product_discount' => array_sum($request->product_discount),
                    'receive_amount' => $request->receive_amount ?? 0,
                    'change_amount' => $request->change_amount ?? 0,
                    'staff_id' => @Auth::user()->staff->id,
                    'created_by' => Auth::user()->id,
                ]);

                foreach ($request->product_id as $product_id) {
                    $stock = HelperClass::stock($product_id, $admin_setting->store_id);
                    if ($request->qty[$product_id] > $stock) {
                        $product = Product::find($product_id);
                        throw new Exception('stock not available please decrease quantity for ' . $product->name);
                    } else {
                        $discount = $request->total_amount > 0 ? ($request->discount / $request->total_amount) * $request->amount[$product_id] : 0;
                        RetailSaleList::create([
                            'company_id' => Auth::user()->company_id ?? 1,
                            'retail_sale_id' => $data->id,
                            'product_id' => $product_id,
                            'variant_id' => @$request->variant_id[$product_id],
                            'rate' => $request->rate[$product_id],
                            'qty' => $request->qty[$product_id],
                            'product_discount' => @$request->product_discount[$product_id] ?? 0,
                            'discount' => $discount,
                            'amount' => $request->amount[$product_id],
                        ]);
                        // Decrease product stock for sold quantity in store method
                        if ($product = Product::find($product_id)) {
                            $product->decreaseStock(
                                date('Y-m-d'),
                                $admin_setting->store_id,
                                $request->qty[$product_id],
                                $request->rate[$product_id],
                                "Retail Sale #{$data->invoice}",
                                "Stock decreased due to retail sale"
                            );
                        }
                    }
                }

                $cash_head = CoaSetup::find($request->coa_setup_id);
                if ($cash_head) {
                    $income_head = CoaSetup::where('head_type', 'I')->where('head_name', 'Retail Sale')->first();
                    $headCode = collect([
                        '0' => $cash_head->head_code,
                        '1' => $income_head->head_code,
                    ]);

                    $debit_amount = collect([
                        '0' => array_sum($request->amount) - $request->discount - $request->return_deduction,
                        '1' => 0.00
                    ]);

                    $credit_amount = collect([
                        '0' => 0.00,
                        '1' => array_sum($request->amount) - $request->discount - $request->return_deduction,
                    ]);

                    $countHead = count($headCode);
                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $data->invoice,
                            'voucher_type' => "Retail Sales",
                            'voucher_date' => date('Y-m-d'),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Retail Sales Against Invoice No - ' . $data->invoice,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                }

                $store = Store::find($admin_setting->store_id);
                $products_info = '';
                foreach ($request->product_id as $product_id) {
                    $product = Product::find($product_id);
                    $products_info .= ' ' . $product->name . ' Quantity : ' . $request->qty[$product_id] . ' ' . @$product->attribute->name;
                }
                AccessLog::create([
                    'date_time' => Carbon::now(),
                    'page' => 'Retail Sales',
                    'action' => 'Add',
                    'description' => 'Create a new retail sales with invoice no ' . $data->invoice . ' to client ' . $request->client_name . ' from store ' . $store->name . ' sales amount is ' . $data->total_amount . ' sales discount ' . $data->discount . ' products ' . $products_info . ' on Retail Sales',
                    'user_id' => Auth::user()->id,
                ]);
            });
            if ($request->is_print) {
                return $this->show($request, $data->id);
            }
        } catch (Throwable $caught) {
            if ($caught) {
                return redirect()->back()->withErrors($caught->getMessage());
            }
        }

        return redirect()->back()->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try {
            $data = RetailSale::findOrFail($id);
            $printer = new RongtaRP850Printer();
            $printer->printInvoice($data);
            if ($request->ajax()) {
                return response()->json(['status' => 'success']);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
        return redirect()->route('admin.running-sales.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('add_product_id')) {
            $admin_setting = AdminSetting::first();
            $store_id = $admin_setting->store_id;
            $product = Product::with('attribute')->find($request->add_product_id);
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $unit = @$product->attribute->name;
            $price = $product->price->online_price - $product->price->discount_tk;
            $stock = HelperClass::stock($product_id, $store_id);

            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->qty[$product_id] + 1;
                if ($stock >= $total_qty) {
                    $amount = $total_qty * $price;
                    return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount, 'stock' => $stock]);
                } else {
                    return response()->json(['status' => 'error', 'data' => 'Stock Insuficient!']);
                }
            }

            if ($stock >= 1) {
                return response()->json(['status' => 'success', 'product' => $product, 'unit' => $unit, 'price' => $price, 'stock' => $stock]);
            } else {
                return response()->json(['status' => 'error', 'data' => 'stock not available any more for this product!']);
            }
        }

        if ($request->ajax()) {
            $admin_setting = AdminSetting::first();
            $store_id = $admin_setting->store_id;
            $product = Product::with('attribute')->where('code', $request->barcode)->first();
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $unit = $product->attribute->name;
            $price = $product->price->online_price - $product->price->discount_tk;

            $old_stock = RetailSaleList::where('retail_sale_id', $id)->where('product_id', $product_id)->first();
            $stock = HelperClass::stock($product_id, $store_id) + @$old_stock->qty;

            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->qty[$product_id] + 1;
                if ($stock >= $total_qty) {
                    $amount = $total_qty * $price;
                    return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount, 'stock' => $stock]);
                } else {
                    return response()->json(['status' => 'error', 'data' => 'Stock Insuficient!']);
                }
            }

            if ($stock >= 1) {
                return response()->json(['status' => 'success', 'product' => $product, 'unit' => $unit, 'price' => $price, 'stock' => $stock]);
            } else {
                return response()->json(['status' => 'error', 'data' => 'stock not available any more for this product!']);
            }
        }

        $admin_setting = AdminSetting::first();

        if (is_null(@$admin_setting->store)) {
            return redirect()->back()->withErrors('Please setup a store for POS Sale!');
        }

        $title = 'Update Sales';
        $data = RetailSale::findOrFail($id);
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash at Bank');
        })->get();
        $link = Route('admin.running-sales.update', $id);

        $returnData = RetailReturn::find($data->retail_return_id);
        $customHtml = '<div class="d-inline-flex gap-2 align-items-center pe-2">
                            <div class="form-check d-inline-flex mb-0 align-items-baseline gap-1">
                                <input class="form-check-input c-pointer sale_type" type="radio" name="sale_type" id="barcodeType" value="barcode" checked>
                                <label class="form-check-label c-pointer" for="barcodeType">By Barcode</label>
                            </div>
                            <div class="form-check d-inline-flex mb-0 align-items-baseline gap-1">
                                <input class="form-check-input c-pointer sale_type" type="radio" name="sale_type" id="manual" value="manual">
                                <label class="form-check-label c-pointer" for="manual">By Manual</label>
                            </div>
                        </div>';
        return view('admin.retail_sales.edit', compact('title', 'data', 'products', 'cash_heads', 'link', 'returnData', 'customHtml'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id, &$data) {
                $admin_setting = AdminSetting::first();
                $data = RetailSale::findOrFail($id);

                // Reverse old stock first
                $old_sales_list = RetailSaleList::where('retail_sale_id', $id)->get();
                foreach ($old_sales_list as $item) {
                    if ($product = Product::find($item->product_id)) {
                        $product->increaseStock(
                            date('Y-m-d'),
                            $data->store_id,
                            $item->qty,
                            $item->rate,
                            "Retail Sale Update Reversal #{$data->invoice}",
                            "Stock increased due to sale reversal during update"
                        );
                    }
                }

                $data->update([
                    'payment_type' => $request->payment_type,
                    'coa_setup_id' => $request->coa_setup_id,
                    'client_name' => $request->client_name,
                    'client_phone' => $request->client_phone,
                    'total_amount' => array_sum($request->amount),
                    'discount' => $request->discount ?? 0,
                    'net_amount' => array_sum($request->amount) - $request->discount,
                    'retail_return_id' => $request->retail_return_id,
                    'return_deduction' => $request->return_deduction ?? 0,
                    'product_discount' => array_sum($request->product_discount),
                    'receive_amount' => $request->receive_amount ?? 0,
                    'change_amount' => $request->change_amount ?? 0,
                    'updated_by' => Auth::user()->id,
                ]);

                RetailSaleList::where('retail_sale_id', $id)->delete();
                foreach ($request->product_id as $product_id) {
                    $stock = HelperClass::stock($product_id, $admin_setting->store_id);
                    if ($request->qty[$product_id] > $stock) {
                        $product = Product::find($product_id);
                        throw new Exception('stock not available please decrease quantity for ' . $product->name);
                    } else {
                        $discount = $request->total_amount > 0 ? ($request->discount / $request->total_amount) * $request->amount[$product_id] : 0;
                        RetailSaleList::create([
                            'company_id' => Auth::user()->company_id ?? 1,
                            'retail_sale_id' => $data->id,
                            'product_id' => $product_id,
                            'variant_id' => @$request->variant_id[$product_id],
                            'rate' => $request->rate[$product_id],
                            'qty' => $request->qty[$product_id],
                            'product_discount' => @$request->product_discount[$product_id] ?? 0,
                            'discount' => $discount,
                            'amount' => $request->amount[$product_id],
                        ]);
                        // Decrease product stock for newly sold quantity in update method
                        if ($product = Product::find($product_id)) {
                            $product->decreaseStock(
                                date('Y-m-d'),
                                $admin_setting->store_id,
                                $request->qty[$product_id],
                                $request->rate[$product_id],
                                "Retail Sale #{$data->invoice}",
                                "Stock decreased due to retail sale"
                            );
                        }
                    }
                }

                AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->forceDelete();
                $cash_head = CoaSetup::find($request->coa_setup_id);
                if ($cash_head) {
                    $income_head = CoaSetup::where('head_type', 'I')->where('head_name', 'Retail Sale')->first();
                    $headCode = collect([
                        '0' => $cash_head->head_code,
                        '1' => $income_head->head_code,
                    ]);

                    $debit_amount = collect([
                        '0' => array_sum($request->amount) - $request->discount - $request->return_deduction,
                        '1' => 0.00
                    ]);

                    $credit_amount = collect([
                        '0' => 0.00,
                        '1' => array_sum($request->amount) - $request->discount - $request->return_deduction,
                    ]);

                    $countHead = count($headCode);
                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $data->invoice,
                            'voucher_type' => "Retail Sales",
                            'voucher_date' => date('Y-m-d'),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Retail Sales Against Invoice No - ' . $data->invoice,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                }

                $store = Store::find($admin_setting->store_id);
                $products_info = '';
                foreach ($request->product_id as $product_id) {
                    $product = Product::find($product_id);
                    $products_info .= ' ' . $product->name . ' Quantity : ' . $request->qty[$product_id] . ' ' . @$product->attribute->name;
                }
                AccessLog::create([
                    'date_time' => Carbon::now(),
                    'page' => 'Retail Sales',
                    'action' => 'Edit',
                    'description' => 'Update retail sales with invoice no ' . $data->invoice . ' to client ' . $request->client_name . ' from store ' . $store->name . ' sales amount is ' . $data->total_amount . ' sales discount ' . $data->discount . ' products ' . $products_info . ' on Retail Sales',
                    'user_id' => Auth::user()->id,
                ]);
            });
        } catch (Throwable $caught) {
            if ($caught) {
                return redirect()->back()->withErrors($caught->getMessage());
            }
        }

        return redirect()->route('admin.running-sales.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            DB::transaction(function () use ($id) {
                $data = RetailSale::onlyTrashed()->findOrFail($id);
                // Restore stock when recovering a deleted sale
                foreach ($data->list as $item) {
                    if ($product = Product::find($item->product_id)) {
                        $product->decreaseStock(
                            date('Y-m-d'),
                            $data->store_id,
                            $item->qty,
                            $item->rate,
                            "Retail Sale Recovery #{$data->invoice}",
                            "Stock decreased due to retail sale recovery"
                        );
                    }
                }
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->restore();
                $data->restore();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                foreach (request('id') as $id) {
                    $data = RetailSale::onlyTrashed()->findOrFail($id);
                    AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->forceDelete();
                    $data->forceDelete();
                }
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                $data = RetailSale::onlyTrashed()->findOrFail($id);
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->forceDelete();
                $data->forceDelete();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            DB::transaction(function () use ($id) {
                foreach (request('id') as $id) {
                    $data = RetailSale::findOrFail($id);
                    // Restore stock when deleting a sale
                    foreach ($data->list as $item) {
                        if ($product = Product::find($item->product_id)) {
                            $product->increaseStock(
                                date('Y-m-d'),
                                $data->store_id,
                                $item->qty,
                                $item->rate,
                                "Retail Sale Delete #{$data->invoice}",
                                "Stock increased due to retail sale deletion"
                            );
                        }
                    }
                    AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->update(['deleted_by' => Auth::user()->id]);
                    AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->delete();
                    AccessLog::create([
                        'date_time' => Carbon::now(),
                        'page' => 'Retail Sales',
                        'action' => 'Delete',
                        'description' => 'Retail Sales delete invoice no ' . $data->invoice,
                        'user_id' => Auth::user()->id,
                    ]);

                    $data->update(['deleted_by' => Auth::user()->id]);
                    $data->delete();
                }
            });
            return response()->json(['status' => 'success']);
        }

        DB::transaction(function () use ($id) {
            $data = RetailSale::findOrFail($id);
            // Restore stock when deleting a sale (single delete)
            foreach ($data->list as $item) {
                if ($product = Product::find($item->product_id)) {
                    $product->increaseStock(
                        date('Y-m-d'),
                        $data->store_id,
                        $item->qty,
                        $item->rate,
                        "Retail Sale Delete #{$data->invoice}",
                        "Stock increased due to retail sale deletion"
                    );
                }
            }
            AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->update(['deleted_by' => Auth::user()->id]);
            AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->delete();
            AccessLog::create([
                'date_time' => Carbon::now(),
                'page' => 'Retail Sales',
                'action' => 'Delete',
                'description' => 'Retail Sales delete invoice no ' . $data->invoice,
                'user_id' => Auth::user()->id,
            ]);

            $data->update(['deleted_by' => Auth::user()->id]);
            $data->delete();
        });

        return response()->json(['status' => 'success']);
    }
}
