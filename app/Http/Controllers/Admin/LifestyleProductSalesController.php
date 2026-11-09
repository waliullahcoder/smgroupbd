<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\AccountTransaction;
use App\Models\AccountTransactionAuto;
use App\Models\AdminMenu;
use App\Models\AdminMenuAction;
use App\Models\AdminSetting;
use App\Models\Client;
use App\Models\CoaSetup;
use App\Models\Collection;
use App\Models\CollectionData;
use App\Models\Company;
use App\Models\DeliveryList;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Sales;
use App\Models\SalesList;
use App\Models\SalesReturn;
use App\Models\SalesReturnList;
use App\Models\Scopes\CompanyScope;
use App\Services\ActionButtons\ActionButtons;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Store;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Throwable;

class LifestyleProductSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Sales::with(['company', 'store', 'client', 'staff'])->where('product_type', 'Fashion')->whereNotIn('sales_type', ['POS'])->latest('id');
            if (!is_null(request('invoice'))) {
                $model->where('invoice', request('invoice'));
            } else {
                $date = !is_null(request('sales_date')) ? date('Y-m-d', strtotime(request('sales_date'))) : date('Y-m-d');
                $model->where('date', $date);
            }
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $collection_data = CollectionData::with('collection')->whereHas('collection')->where('sales_id', $row->id)->first();
                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->invoice)->where('voucher_type', 'Sales')->first();
                    $coll_transaction = AccountTransaction::withTrashed()->where('voucher_no', @$collection_data->collection->payment_no)->where('voucher_type', 'Collection')->first();
                    $sales_return = SalesReturnList::with('sales_list')->whereHas('sales_list', function ($query) use ($row) {
                        $query->where('sales_id', $row->id);
                    })->first();
                    $delivery = DeliveryList::where('sales_id', $row->id)->first();
                    if (is_null($collection_data) && is_null($transaction) && is_null($coll_transaction) && is_null($sales_return) && is_null($delivery)) {
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
                    $collection_data = CollectionData::with('collection')->whereHas('collection')->where('sales_id', $row->id)->first();
                    $data = [
                        'id' => $row->id,
                        'edit' => !is_null($collection_data) || !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $addiotional_buttons = '';
                    $addiotional_buttons .= '<a class="btn btn-sm border-0 px-10px fs-15 text-white tt btn-print-1" href="' . Route('admin.sales-lifestyle-product.show', $row->id) . '" target="_blank"  data-bs-toggle="tooltip" data-bs-placement="top" title="Chalan"><i class="fal fa-print"></i></a>';
                    $addiotional_buttons .= '<a class="btn btn-sm border-0 px-10px fs-15 text-white tt btn-print-2" href="' . Route('admin.sales-lifestyle-product.invoice', $row->id) . '" target="_blank"  data-bs-toggle="tooltip" data-bs-placement="top" title="Invoice"><i class="fal fa-file-pdf"></i></a>';
                    if (@$row->client->is_vat == 1) {
                        $addiotional_buttons .= '<a class="btn btn-sm border-0 px-10px fs-15 text-white tt btn-print-3" href="' . Route('admin.sales-lifestyle-product.vat', $row->id) . '" target="_blank"  data-bs-toggle="tooltip" data-bs-placement="top" title="Vat Chalan"><i class="fal fa-print-search"></i></a>';
                    }
                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->invoice)->where('voucher_type', 'Sales')->first();
                    $coll_transaction = AccountTransaction::withTrashed()->where('voucher_no', @$collection_data->collection->payment_no)->where('voucher_type', 'Collection')->first();
                    $sales_return = SalesReturnList::with('sales_list')->whereHas('sales_list', function ($query) use ($row) {
                        $query->where('sales_id', $row->id);
                    })->first();
                    $delivery = DeliveryList::where('sales_id', $row->id)->first();
                    if (is_null($collection_data) && is_null($transaction) && is_null($coll_transaction) && is_null($sales_return) && is_null($delivery)) {
                        return ActionButtons::actions($data, $addiotional_buttons);
                    }
                    return '<div class="btn-group">' . $addiotional_buttons . '</div>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Lifestyle Product Sales";
        $params = '';
        $currentRouteName = \Request::route()->getName();
        $menu = AdminMenu::where('route', $currentRouteName)->first();
        $edit = str_replace('index', 'edit', $menu->route);
        $menuAction = AdminMenuAction::where('route', $edit)->first();
        $currentRoutePermission = Permission::findById($menuAction->permission_id);
        if (!is_null($currentRoutePermission)) {
            if (auth()->user()->can($currentRoutePermission->name)) {
                $params .= '<form class="d-inline-flex gap-2" method="get" target="_blank" action="' . Route('admin.sales-lifestyle-product.search-edit') . '"><input type="text" class="form-control px-2 py-1" id="invoice" name="invoice" style="width: 150px; min-height: auto;" placeholder="Invoice No."><button type="submit" class="btn btn-sm btn-warning tt"><i class="far fa-pencil-alt"></i></button></form>';
            }
        }
        $params .= '<input type="text" class="form-control date_picker px-2 py-1" id="sales_date" name="sales_date" style="width: 150px; min-height: auto;" value="' . date('d-m-Y') . '" placeholder="Sales Date">';
        return view('admin.lifestyle_product_sales.index', compact('title', 'params'));
    }

    public function getOrderNo()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $order = Sales::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['invoice'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($order) {
            $trim = str_replace("STS", '', $order->invoice);
            $orderPrefix = (int)$trim + 1;
            $invoice = "STS" . $orderPrefix;
        } else {
            $invoice = "STS" . date('y') . date('m') . '000001';
        }
        return $invoice;
    }

    public static function stock($variant_id, $store_id)
    {
        $liftings = DB::table('view_fashion_product_liftings')->where('store_id', $store_id)->whereNotNull('date')->where('sku_id', $variant_id)->sum('qty');
        $lifting_returns = DB::table('view_fashion_product_lifting_returns')->where('store_id', $store_id)->whereNotNull('date')->where('sku_id', $variant_id)->sum('qty');
        $client_sales = DB::table('view_sales')->where('product_type', 'Fashion')->where('store_id', $store_id)->where('sku_id', $variant_id)->sum('qty');
        $sales_returns = DB::table('view_sales_returns')->where('product_type', 'Consumer')->where('sku_id', $variant_id)->where('store_id', $store_id)->sum('qty');
        $online_sales = DB::table('view_online_sales')->where('product_type', 'Consumer')->where('sku_id', $variant_id)->where('store_id', $store_id)->sum('qty');
        $transfers = DB::table('view_transfers')->whereNotNull('date')->where('sku_id', $variant_id)->where('host_id', $store_id)->sum('qty');
        $receives = DB::table('view_transfers')->whereNotNull('date')->where('sku_id', $variant_id)->where('destination_id', $store_id)->sum('qty');
        return $liftings + $sales_returns + $receives - $lifting_returns - $client_sales - $online_sales - $transfers;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('get_variants')) {
            $variants = ProductSku::where('product_id', $request->product_id)->get();
            return response()->json(['status' => 'success', 'variants' => $variants]);
        }

        if ($request->ajax() && $request->has('get_stock')) {
            $stock = $this->stock($request->variant_id, $request->store_id);
            return response()->json(['status' => 'success', 'stock' => $stock]);
        }

        if ($request->ajax() && $request->has('get_client_balance')) {
            $client = Client::findOrFail($request->client_id);
            $salesAmount = Sales::where('client_id', $request->client_id)->sum('total_amount') - Sales::where('client_id', $request->client_id)->sum('discount');
            $paymentAmount = Collection::where('client_id', $request->client_id)->where('collection_type', '!=', 'adjust')->sum('amount');
            $returnAmount = SalesReturn::where('client_id', $request->client_id)->sum('amount');
            $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;
            return response()->json(['status' => 'success', 'balance' => $balance, 'client' => $client]);
        }

        if ($request->ajax() && $request->has('add_product')) {
            $stock = $this->stock($request->variant_id, $request->store_id);
            if ($request->quantity > $stock) {
                return response()->json(['status' => 'error', 'data' => 'stock not available please decrease quantity!']);
            } else {
                $variant = ProductSku::with('product')->find($request->variant_id);
                $amount = $request->quantity * $variant->price;
                return response()->json(['status' => 'success', 'variant' => $variant, 'quantity' => $request->quantity, 'stock' => $stock, 'price' => $variant->price, 'amount' => $amount]);
            }
        }

        $products = Product::where('product_type', 'Fashion')->where('status', 1)->orderBy('name', 'asc')->get();
        $title = 'Add New Sales';
        $clients = Client::where('status', 1)->orWhere('is_chain', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $invoice = $this->getOrderNo();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        return view('admin.lifestyle_product_sales.create', compact('title', 'clients', 'invoice', 'stores', 'staffs', 'products', 'cash_heads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sales_type' => 'required',
            'invoice' => 'required',
            'date' => 'required',
            'client_id' => 'required',
            'store_id' => 'required',
            'variant_id' => 'required',
            'qty' => 'required',
        ]);

        $client = Client::find($request->client_id);
        $admin_setting = AdminSetting::first();
        if (@$admin_setting->accounting == 1 && is_null($client->coa)) {
            return redirect()->back()->withErrors('Please Setup a clients account!');
        }

        $client_id = $request->client_id;
        $client = Client::findOrFail($client_id);
        $salesAmount = Sales::where('client_id', $client_id)->sum('total_amount') - Sales::where('client_id', $client_id)->sum('discount');
        $paymentAmount = Collection::where('client_id', $client_id)->where('collection_type', '!=', 'adjust')->sum('amount');
        $returnAmount = SalesReturn::where('client_id', $client_id)->sum('amount');
        $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;

        if ($request->sales_type == 'credit' && $balance < $request->net_payable) {
            return redirect()->back()->withErrors('Insufficient Credit Limit please check client limitation');
        }

        try {
            DB::transaction(function () use ($request) {
                $total_amount = 0;
                foreach ($request->amount as $amount) {
                    $total_amount += $amount;
                }

                $invoice = $this->getOrderNo();
                $store_id = $request->store_id;
                $sales = Sales::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'product_type' => 'Fashion',
                    'store_id' => $store_id,
                    'client_id' => $request->client_id,
                    'invoice' => $invoice,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'sales_type' => $request->sales_type,
                    'total_amount' => $total_amount,
                    'discount' => $request->discount,
                    'total_paid' => $request->sales_type == 'cash' ? $request->net_payable : 0,
                    'created_by' => Auth::user()->id,
                    'staff_id' => $request->staff_id,
                ]);

                foreach ($request->variant_id as $key => $variant_id) {
                    $stock = $this->stock($variant_id, $store_id);
                    $variant = ProductSku::with('product')->find($variant_id);
                    if ($request->qty[$key] > $stock) {
                        throw new Exception('stock not available please decrease quantity for ' . $variant->product->name . ' variant ' . $variant->sku);
                    } else {
                        $discount = ($request->discount / $request->total_amount) * $request->amount[$key];
                        SalesList::create([
                            'company_id' => Auth::user()->company_id ?? 1,
                            'product_type' => 'Fashion',
                            'sales_id' => $sales->id,
                            'store_id' => $request->store_id,
                            'client_id' => $request->client_id,
                            'product_id' => $variant->product_id,
                            'variant_id' => $variant_id,
                            'rate' => $request->rate[$key],
                            'qty' => $request->qty[$key],
                            'amount' => $request->amount[$key],
                            'discount' => $discount,
                            'collection' => $request->sales_type == 'cash' ? ($request->amount[$key] - $discount) : 0.00,
                        ]);
                    }
                }

                $client = Client::find($request->client_id);
                if ($client->coa) {
                    $income_head = CoaSetup::where('head_type', 'I')->where('head_name', 'Whole Sale')->first();
                    $headCode = collect([
                        '0' => $client->coa->head_code,
                        '1' => $income_head->head_code,
                    ]);

                    $debit_amount = collect([
                        '0' => $total_amount - $request->discount,
                        '1' => 0.00
                    ]);

                    $credit_amount = collect([
                        '0' => 0.00,
                        '1' => $total_amount - $request->discount,
                    ]);

                    $countHead = count($headCode);
                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $invoice,
                            'voucher_type' => "Sales",
                            'voucher_date' => date('Y-m-d', strtotime($request->date)),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Product Sales Against Invoice No - ' . $invoice,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                }

                if ($request->sales_type == 'cash') {
                    $first = date('Y-m-01');
                    $last = new Carbon('last day of this month');
                    $pay_data = Collection::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
                    if ($pay_data) {
                        $trim = str_replace("STC", '', $pay_data->payment_no);
                        $dataPrefix = (int)$trim + 1;
                        $payment_no = "STC" . $dataPrefix;
                    } else {
                        $payment_no = "STC" . date('y') . date('m') . '000001';
                    }

                    $collection = Collection::create([
                        'company_id' => Auth::user()->company_id ?? 1,
                        'client_id' => $request->client_id,
                        'payment_no' => $payment_no,
                        'amount' => $total_amount - $request->discount,
                        'payment_date' => date('Y-m-d', strtotime($request->date)),
                        'collection_type' => 'collection',
                        'payment_type' => $request->sales_type,
                        'remarks' => 'Paid on Sale',
                        'sales_id' => $sales->id,
                        'created_by' => Auth::user()->id,
                    ]);

                    CollectionData::create([
                        'collection_id' => $collection->id,
                        'sales_id' => $sales->id,
                        'amount' => $total_amount - $request->discount,
                    ]);

                    if ($client->coa) {
                        $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                        $headCode = collect([
                            '0' => $cash_head->head_code,
                            '1' => $client->coa->head_code
                        ]);

                        $postData = [];
                        for ($i = 0; $i < $countHead; $i++) {
                            $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                            $postData[] = [
                                'company_id' => Auth::user()->company_id ?? 1,
                                'voucher_no' => $payment_no,
                                'voucher_type' => "Collection",
                                'voucher_date' => date('Y-m-d', strtotime($request->date)),
                                'coa_setup_id' => $coa->id,
                                'coa_head_code' => $headCode[$i],
                                'narration' => 'Collection Against PAYMENT NO - ' . $payment_no,
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

                $store = Store::find($request->store_id);
                $products_info = '';
                foreach ($request->variant_id as $key => $variant_id) {
                    $variant = ProductSku::with('product')->findOrFail($variant_id);
                    $products_info .= ' ' . $variant->product->name . ' Variant - ' . $variant->sku . ' Quanity : ' . $request->qty[$key] . ', ';
                }
                AccessLog::create([
                    'date_time' => Carbon::now(),
                    'page' => 'Sales',
                    'action' => 'Add',
                    'description' => 'Create a new sales with invoice no ' . $sales->invoice . ' to client ' . $client->name . ' from store ' . $store->name . ' sales amount is ' . $sales->total_amount . ' sales discount ' . $sales->discount . ' products ' . $products_info . ' on ' . ($request->sales_type == 'cash' ? 'cash sale' : 'credit sale'),
                    'user_id' => Auth::user()->id,
                ]);
            });
        } catch (Throwable $caught) {
            if ($caught) {
                return redirect()->back()->withErrors('Stock not available!');
            }
        }
        return redirect()->route('admin.sales-lifestyle-product.index')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $logo = $company->logo;
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $logo = NULL;
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = Sales::findOrFail($id);
        $report_title = 'Chalan';
        // return view('admin.lifestyle_product_sales.chalan', compact('title', 'logo', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.lifestyle_product_sales.chalan', compact('title', 'logo', 'informations', 'report_title', 'data'));
        // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function invoice(string $id)
    {
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $hotline = $company->fax;
            $logo = $company->logo;
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $logo = NULL;
            $hotline = '01xxxxx-xxxxx';
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = Sales::findOrFail($id);

        $total_sale_amount = Sales::whereNotIn('id', [$id])->where('client_id', $data->client_id)->sum('total_amount');
        $total_discount_amount = Sales::whereNotIn('id', [$id])->where('client_id', $data->client_id)->sum('discount');
        $total_paid_amount = Collection::where('client_id', $data->client_id)->where('payment_no', '!=', $data->invoice)->where('collection_type', '!=', 'adjust')->sum('amount');
        $opening = $total_sale_amount - ($total_discount_amount + $total_paid_amount);

        $report_title = 'Invoice';
        // return view('admin.sales.invoice', compact('title', 'logo', 'informations', 'hotline', 'report_title', 'data', 'opening'));
        $pdf = Pdf::loadView('admin.sales.invoice', compact('title', 'logo', 'informations', 'hotline', 'report_title', 'data', 'opening'));
        // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('sales_invoice_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function vat(string $id)
    {
        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $logo = $company->logo;
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $logo = NULL;
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = Sales::findOrFail($id);

        $report_title = 'Vat Chalan';
        // return view('admin.sales.vat', compact('title', 'logo', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.sales.vat', compact('title', 'logo', 'informations', 'report_title', 'data'));
        $pdf->setPaper('A4');
        return $pdf->stream('sales_invoice_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('get_variants')) {
            $variants = ProductSku::where('product_id', $request->product_id)->get();
            return response()->json(['status' => 'success', 'variants' => $variants]);
        }

        if ($request->ajax() && $request->has('get_stock')) {
            $sales = SalesList::where('sales_id', $id)->where('store_id', $request->store_id)->where('variant_id', $request->variant_id)->first();
            $stock = $this->stock($request->variant_id, $request->store_id) + @$sales->qty ?? 0;
            return response()->json(['status' => 'success', 'stock' => $stock]);
        }

        if ($request->ajax() && $request->has('get_client_balance')) {
            $client = Client::findOrFail($request->client_id);
            $salesAmount = Sales::where('client_id', $request->client_id)->where('id', '!=', $id)->sum('total_amount') - Sales::where('client_id', $request->client_id)->where('id', '!=', $id)->sum('discount');
            $paymentAmount = Collection::where('client_id', $request->client_id)->where('sales_id', '!=', $id)->where('collection_type', '!=', 'adjust')->sum('amount');
            $returnAmount = SalesReturn::where('client_id', $request->client_id)->sum('amount');
            $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;
            return response()->json(['status' => 'success', 'balance' => $balance, 'client' => $client]);
        }

        if ($request->ajax() && $request->has('add_product')) {
            $sales = SalesList::where('sales_id', $id)->where('store_id', $request->store_id)->where('variant_id', $request->variant_id)->first();
            $stock = $this->stock($request->variant_id, $request->store_id) + @$sales->qty ?? 0;
            if ($request->quantity > $stock) {
                return response()->json(['status' => 'error', 'data' => 'stock not available please decrease quantity!']);
            } else {
                $variant = ProductSku::with('product')->find($request->variant_id);
                $amount = $request->quantity * $variant->price;
                return response()->json(['status' => 'success', 'variant' => $variant, 'quantity' => $request->quantity, 'stock' => $stock, 'price' => $variant->price, 'amount' => $amount]);
            }
        }

        $title = 'Update Sales';
        $clients = Client::where('status', 1)->orWhere('is_chain', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $data = Sales::findOrFail($id);

        $client_id = $data->client_id;
        $client = Client::findOrFail($client_id);
        $salesAmount = Sales::where('client_id', $client_id)->where('id', '!=', $id)->sum('total_amount') - Sales::where('client_id', $client_id)->where('id', '!=', $id)->sum('discount');
        $paymentAmount = Collection::where('client_id', $client_id)->where('sales_id', '!=', $id)->where('collection_type', '!=', 'adjust')->sum('amount');
        $returnAmount = SalesReturn::where('client_id', $client_id)->sum('amount');
        $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;

        $products = Product::where('product_type', 'Fashion')->where('status', 1)->orderBy('name', 'asc')->get();
        $link = Route('admin.sales-lifestyle-product.update', $id);
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        return view('admin.lifestyle_product_sales.edit', compact('title', 'clients', 'stores', 'staffs', 'data', 'link', 'balance', 'products', 'cash_heads'));
    }

    public function searchEdit(Request $request)
    {
        if (is_null($request->invoice)) {
            return redirect()->route('admin.sales-lifestyle-product.index');
        }
        $title = 'Update Sales';
        $clients = Client::where('status', 1)->orWhere('is_chain', 1)->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $data = Sales::where('product_type', 'Fashion')->where('invoice', $request->invoice)->first();

        $collection_data = CollectionData::with('collection')->whereHas('collection')->where('sales_id', $data->id)->first();
        if (!is_null($collection_data)) {
            return redirect()->back()->withErrors('Has Collection!');
        }

        $client_id = $data->client_id;
        $client = Client::findOrFail($client_id);
        $salesAmount = Sales::where('client_id', $client_id)->where('id', '!=', $data->id)->sum('total_amount') - Sales::where('client_id', $client_id)->where('id', '!=', $data->id)->sum('discount');
        $paymentAmount = Collection::where('client_id', $client_id)->where('sales_id', '!=', $data->id)->where('collection_type', '!=', 'adjust')->sum('amount');
        $returnAmount = SalesReturn::where('client_id', $client_id)->sum('amount');
        $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;

        $products = Product::where('product_type', 'Fashion')->where('status', 1)->orderBy('name', 'asc')->get();
        $link = Route('admin.sales-lifestyle-product.update', $data->id);
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        return view('admin.lifestyle_product_sales.edit', compact('title', 'clients', 'stores', 'staffs', 'data', 'link', 'balance', 'products', 'cash_heads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'sales_type' => 'required',
            'invoice' => 'required',
            'date' => 'required',
            'client_id' => 'required',
            'store_id' => 'required',
            'variant_id' => 'required',
            'qty' => 'required',
        ]);

        $client = Client::find($request->client_id);
        $admin_setting = AdminSetting::first();
        if (@$admin_setting->accounting == 1 && is_null($client->coa)) {
            return redirect()->back()->withErrors('Please Setup a clients account!');
        }

        $client_id = $request->client_id;
        $client = Client::findOrFail($client_id);
        $salesAmount = Sales::where('client_id', $client_id)->where('id', '!=', $id)->sum('total_amount') - Sales::where('client_id', $client_id)->where('id', '!=', $id)->sum('discount');
        $paymentAmount = Collection::where('client_id', $client_id)->where('collection_type', '!=', 'adjust')->sum('amount');
        $returnAmount = SalesReturn::where('client_id', $client_id)->sum('amount');
        $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;

        if ($request->sales_type == 'credit' && $balance < $request->net_payable) {
            return redirect()->back()->withErrors('Insufficient Credit Limit please check client limitation');
        }

        try {
            DB::transaction(function () use ($request, $id) {
                $total_amount = 0;
                foreach ($request->amount as $amount) {
                    $total_amount += $amount;
                }

                $sales = Sales::findOrFail($id);
                $sales->update([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'store_id' => $request->store_id,
                    'client_id' => $request->client_id,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'sales_type' => $request->sales_type,
                    'total_amount' => $total_amount,
                    'discount' => $request->discount,
                    'total_paid' => $request->sales_type == 'cash' ? $request->net_payable : 0,
                    'updated_by' => Auth::user()->id,
                    'staff_id' => $request->staff_id,
                ]);

                $old_sales = SalesList::where('sales_id', $id)->get();

                foreach ($request->variant_id as $key => $variant_id) {
                    $increment = SalesList::where('sales_id', $id)->where('store_id', $request->store_id)->where('variant_id', $request->variant_id)->first();
                    $stock = $this->stock($variant_id, $request->store_id) + @$increment->qty ?? 0;
                    $variant = ProductSku::with('product')->find($variant_id);
                    if ($request->qty[$key] > $stock) {
                        throw new Exception('stock not available please decrease quantity for ' . $variant->product->name . ' variant ' . $variant->sku);
                    } else {
                        $discount = ($request->discount / $request->total_amount) * $request->amount[$key];
                        SalesList::create([
                            'company_id' => Auth::user()->company_id ?? 1,
                            'product_type' => 'Fashion',
                            'sales_id' => $sales->id,
                            'store_id' => $request->store_id,
                            'client_id' => $request->client_id,
                            'product_id' => $variant->product_id,
                            'variant_id' => $variant_id,
                            'rate' => $request->rate[$key],
                            'qty' => $request->qty[$key],
                            'amount' => $request->amount[$key],
                            'discount' => $discount,
                            'collection' => $request->sales_type == 'cash' ? ($request->amount[$key] - $discount) : 0.00,
                        ]);
                    }
                }

                // Delete Old Data
                $old_collection = Collection::withTrashed()->where('sales_id', $id)->first();
                AccountTransactionAuto::withTrashed()->where('voucher_no', $sales->invoice)->where('voucher_type', 'Sales')->forceDelete();
                if ($old_collection) {
                    AccountTransactionAuto::withTrashed()->where('voucher_no', $old_collection->payment_no)->where('voucher_type', 'Collection')->forceDelete();
                    $old_collection->forceDelete();
                }
                SalesList::whereIn('id', $old_sales->pluck('id')->toArray())->delete();
                // Delete Old Data

                $client = Client::find($request->client_id);
                if ($client->coa) {
                    $income_head = CoaSetup::where('head_type', 'I')->where('head_name', 'Whole Sale')->first();
                    $headCode = collect([
                        '0' => $client->coa->head_code,
                        '1' => $income_head->head_code,
                    ]);

                    $debit_amount = collect([
                        '0' => $total_amount - $request->discount,
                        '1' => 0.00
                    ]);

                    $credit_amount = collect([
                        '0' => 0.00,
                        '1' => $total_amount - $request->discount,
                    ]);

                    $countHead = count($headCode);
                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $sales->invoice,
                            'voucher_type' => "Sales",
                            'voucher_date' => date('Y-m-d', strtotime($request->date)),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Product Sales Against Invoice No - ' . $sales->invoice,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                }

                if ($request->sales_type == 'cash') {
                    $first = date('Y-m-01');
                    $last = new Carbon('last day of this month');
                    $pay_data = Collection::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['payment_no'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
                    if ($pay_data) {
                        $trim = str_replace("STC", '', $pay_data->payment_no);
                        $dataPrefix = (int)$trim + 1;
                        $payment_no = "STC" . $dataPrefix;
                    } else {
                        $payment_no = "STC" . date('y') . date('m') . '000001';
                    }

                    $collection = Collection::create([
                        'company_id' => Auth::user()->company_id ?? 1,
                        'client_id' => $request->client_id,
                        'payment_no' => $payment_no,
                        'amount' => $total_amount - $request->discount,
                        'payment_date' => date('Y-m-d', strtotime($request->date)),
                        'collection_type' => 'collection',
                        'payment_type' => $request->sales_type,
                        'remarks' => 'Paid on Sale',
                        'sales_id' => $sales->id,
                        'created_by' => Auth::user()->id,
                    ]);

                    CollectionData::create([
                        'collection_id' => $collection->id,
                        'sales_id' => $sales->id,
                        'amount' => $total_amount - $request->discount,
                    ]);

                    if ($client->coa) {
                        $cash_head = CoaSetup::findOrFail($request->coa_setup_id);
                        $headCode = collect([
                            '0' => $cash_head->head_code,
                            '1' => $client->coa->head_code
                        ]);

                        $postData = [];
                        for ($i = 0; $i < $countHead; $i++) {
                            $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                            $postData[] = [
                                'company_id' => Auth::user()->company_id ?? 1,
                                'voucher_no' => $payment_no,
                                'voucher_type' => "Collection",
                                'voucher_date' => date('Y-m-d', strtotime($request->date)),
                                'coa_setup_id' => $coa->id,
                                'coa_head_code' => $headCode[$i],
                                'narration' => 'Collection Against PAYMENT NO - ' . $payment_no,
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

                $store = Store::find($request->store_id);
                $products_info = '';
                foreach ($request->variant_id as $key => $variant_id) {
                    $variant = ProductSku::with('product')->findOrFail($variant_id);
                    $products_info .= ' ' . $variant->product->name . ' Variant - ' . $variant->sku . ' Quanity : ' . $request->qty[$key] . ', ';
                }
                AccessLog::create([
                    'date_time' => Carbon::now(),
                    'page' => 'Sales',
                    'action' => 'Add',
                    'description' => 'Create a new sales with invoice no ' . $sales->invoice . ' to client ' . $client->name . ' from store ' . $store->name . ' sales amount is ' . $sales->total_amount . ' sales discount ' . $sales->discount . ' products ' . $products_info . ' on ' . ($request->sales_type == 'cash' ? 'cash sale' : 'credit sale'),
                    'user_id' => Auth::user()->id,
                ]);
            });
        } catch (Throwable $caught) {
            if ($caught) {
                return redirect()->back()->withErrors('Stock not available!');
            }
        }
        return redirect()->route('admin.sales-lifestyle-product.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Sales::onlyTrashed()->findOrFail($id);
            $collection = Collection::onlyTrashed()->where('sales_id', $id)->first();
            AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Sales')->restore();
            if ($collection) {
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $collection->payment_no)->where('voucher_type', 'Collection')->restore();
                $collection->restore();
            }
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Sales::onlyTrashed()->findOrFail($id);
                $collection = Collection::onlyTrashed()->where('sales_id', $id)->first();
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Sales')->forceDelete();
                if ($collection) {
                    AccountTransactionAuto::onlyTrashed()->where('voucher_no', $collection->payment_no)->where('voucher_type', 'Collection')->forceDelete();
                    $collection->forceDelete();
                }
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Sales::onlyTrashed()->findOrFail($id);
            $collection = Collection::onlyTrashed()->where('sales_id', $id)->first();
            AccountTransactionAuto::onlyTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Sales')->forceDelete();
            if ($collection) {
                AccountTransactionAuto::onlyTrashed()->where('voucher_no', $collection->payment_no)->where('voucher_type', 'Collection')->forceDelete();
                $collection->forceDelete();
            }
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Sales::findOrFail($id);
                AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Sales')->update(['deleted_by' => Auth::user()->id]);
                AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Sales')->delete();

                $collection = Collection::where('sales_id', $id)->first();
                AccessLog::create([
                    'date_time' => Carbon::now(),
                    'page' => 'Sales',
                    'action' => 'Delete',
                    'description' => 'Sales delete invoice no ' . $data->invoice . !is_null($collection) ? ' Collection delete ' . $collection->payment_no  : '',
                    'user_id' => Auth::user()->id,
                ]);
                if (!is_null($collection)) {
                    AccountTransactionAuto::where('voucher_no', $collection->payment_no)->where('voucher_type', 'Collection')->update(['deleted_by' => Auth::user()->id]);
                    AccountTransactionAuto::where('voucher_no', $collection->payment_no)->where('voucher_type', 'Collection')->delete();
                    $collection->update(['deleted_by' => Auth::user()->id]);
                    $collection->delete();
                }

                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        $data = Sales::findOrFail($id);
        AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Sales')->update(['deleted_by' => Auth::user()->id]);
        AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Sales')->delete();
        $collection = Collection::where('sales_id', $id)->first();

        AccessLog::create([
            'date_time' => Carbon::now(),
            'page' => 'Sales',
            'action' => 'Delete',
            'description' => 'Sales delete invoice no ' . $data->invoice . (!is_null($collection) ? ' Collection delete ' . $collection->payment_no  : ''),
            'user_id' => Auth::user()->id,
        ]);
        if (!is_null($collection)) {
            AccountTransactionAuto::where('voucher_no', $collection->payment_no)->where('voucher_type', 'Collection')->update(['deleted_by' => Auth::user()->id]);
            AccountTransactionAuto::where('voucher_no', $collection->payment_no)->where('voucher_type', 'Collection')->delete();

            $collection->update(['deleted_by' => Auth::user()->id]);
            $collection->delete();
        }

        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
