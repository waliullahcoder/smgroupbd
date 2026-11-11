<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use Throwable;
use Exception;
use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Order;
use App\Models\Staff;
use App\Models\Store;
use App\Models\Sales;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\Company;
use App\Models\Product;
use App\Models\CoaSetup;
use App\Models\SalesList;
use App\Models\AccessLog;
use App\Models\AdminMenu;
use App\Models\Collection;
use App\Models\SalesReturn;
use App\Models\ClientPrice;
use App\Models\AdminSetting;
use App\Models\DeliveryList;
use Illuminate\Http\Request;
use App\Models\OrderProduct;
use App\Models\CollectionData;
use App\Models\SalesReturnList;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AdminMenuAction;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTransaction;
use App\Models\Scopes\CompanyScope;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\AccountTransactionAuto;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use App\Services\ActionButtons\ActionButtons;

const API_TOKEN = "zabcxpps-3p2u0j8t-poamlcuh-vfukis8d-gveezohu";
const SID = "BONTONBULK";
const DOMAIN = "https://smsplus.sslwireless.com";

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
           $model = Sales::with(['company', 'store', 'client', 'staff'])
                ->where('product_type', 'Consumer')
                ->whereNotIn('sales_type', ['POS', 'running'])
                ->latest('id');

            if (!is_null(request('invoice'))) {
                $model->where('invoice', request('invoice'));
            } else {
                $date = !is_null(request('sales_date'))
                    ? date('Y-m-d', strtotime(request('sales_date')))
                    : date('Y-m-d');
            }

            $type = request('type');

            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }

            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {

                    $collection_data = CollectionData::with('collection')
                        ->whereHas('collection')
                        ->where('sales_id', $row->id)
                        ->first();

                    $transaction = AccountTransaction::withTrashed()
                        ->where('voucher_no', $row->invoice)
                        ->where('voucher_type', 'Sales')
                        ->first();

                    $coll_transaction = AccountTransaction::withTrashed()
                        ->where('voucher_no', @$collection_data->collection->payment_no)
                        ->where('voucher_type', 'Collection')
                        ->first();

                    $sales_return = SalesReturnList::with('sales_list')
                        ->whereHas('sales_list', function ($query) use ($row) {
                            $query->where('sales_id', $row->id);
                        })->first();

                    $delivery = DeliveryList::where('sales_id', $row->id)->first();

                    // if (
                    //     is_null($collection_data) &&
                    //     is_null($transaction) &&
                    //     is_null($coll_transaction) &&
                    //     is_null($sales_return) &&
                    //     is_null($delivery)
                    // ) {
                    //     return '<div class="custom-control custom-checkbox">
                    //         <input type="checkbox" class="' .
                    //         (!empty(request('type')) && request('type') == "trash"
                    //             ? 'trash_multi_checkbox'
                    //             : 'multi_checkbox') .
                    //         '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '">
                    //         <label for="' . $row->id . '" class="custom-control-label"></label>
                    //     </div>';
                    // }

                    return '';
                })

               ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })

                ->addColumn('staff_name', function ($row) {
                    return optional($row->staff)->name ?? '-';
                })

                // Discount
                ->addColumn('discount', function ($row) {
                    return number_format($row->discount ?? 0, 2);
                })

                // Discount
                ->addColumn('discount', function ($row) {
                    return number_format($row->discount ?? 0, 2);
                })

                // Tax Percentage
                ->addColumn('tax', function ($row) {
                    return number_format($row->tax ?? 0, 2) . '%';
                })
                

                // Tax Amount
                ->addColumn('tax_amount', function ($row) {
                    return number_format($row->tax_amount ?? 0, 2);
                })

                

                // Net Payable (Tax Included)
                ->addColumn('net_amount', function ($row) {
                    return number_format(
                        $row->net_amount ?? (
                            ($row->total_amount ?? 0) -
                            ($row->discount ?? 0) +
                            ($row->tax_amount ?? 0)
                        ),
                        2
                    );
                })

                ->addColumn('actions', function ($row) {

                    $type = request('type');

                    $collection_data = CollectionData::with('collection')
                        ->whereHas('collection')
                        ->where('sales_id', $row->id)
                        ->first();

                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];

                    $addiotional_buttons = '';

                    $addiotional_buttons .= '<a class="btn btn-sm border-0 text-white tt btn-print-1"
                        href="' . Route('admin.sales.show', $row->id) . '"
                        target="_blank" data-bs-toggle="tooltip" title="Chalan">
                        <i class="fal fa-print"></i></a>';

                    $addiotional_buttons .= '<a class="btn btn-sm border-0 text-white tt btn-print-2"
                        href="' . Route('admin.sales.invoice', $row->id) . '"
                        target="_blank" data-bs-toggle="tooltip" title="Invoice">
                        <i class="fal fa-file-pdf"></i></a>';

                    if (@$row->client->is_vat == 1) {
                        $addiotional_buttons .= '<a class="btn btn-sm border-0 text-white tt btn-print-3"
                            href="' . Route('admin.sales.vat', $row->id) . '"
                            target="_blank" data-bs-toggle="tooltip" title="Vat Chalan">
                            <i class="fal fa-print-search"></i></a>';
                    }

                    $transaction = AccountTransaction::withTrashed()
                        ->where('voucher_no', $row->invoice)
                        ->where('voucher_type', 'Sales')
                        ->first();

                    $coll_transaction = AccountTransaction::withTrashed()
                        ->where('voucher_no', @$collection_data->collection->payment_no)
                        ->where('voucher_type', 'Collection')
                        ->first();

                    $sales_return = SalesReturnList::with('sales_list')
                        ->whereHas('sales_list', function ($query) use ($row) {
                            $query->where('sales_id', $row->id);
                        })->first();

                    $delivery = DeliveryList::where('sales_id', $row->id)->first();

                    if (
                        is_null($transaction) &&
                        is_null($coll_transaction) &&
                        is_null($sales_return) &&
                        is_null($delivery)
                    ) {
                        return ActionButtons::actions($data, $addiotional_buttons);
                    }

                    return '<div class="btn-group">' . $addiotional_buttons . '</div>';
                })

                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Daily Sales";
        $params = '';
        $currentRouteName = \Request::route()->getName();
        $menu = AdminMenu::where('route', $currentRouteName)->first();
        $edit = str_replace('index', 'edit', $menu->route);
        $menuAction = AdminMenuAction::where('route', $edit)->first();
        $currentRoutePermission = Permission::findById($menuAction->permission_id);
        if (!is_null($currentRoutePermission)) {
            if (Auth::user()->can($currentRoutePermission->name)) {
                $params .= '<form class="d-inline-flex gap-2" method="get" target="_blank" action="' . Route('admin.sales.search-edit') . '"><input type="text" class="form-control input-sm" id="invoice" name="invoice" style="width: 150px; min-height: auto;" placeholder="Invoice No."><button type="submit" class="btn btn-sm btn-warning tt"><i class="far fa-pencil-alt"></i></button></form>';
            }
        }
        $params .= '<input type="text" class="form-control date_picker input-sm" id="sales_date" name="sales_date" style="width: 150px; min-height: auto;" value="' . date('d-m-Y') . '" placeholder="Sales Date">';
        return view('admin.sales.index', compact('title', 'params'));
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('get_stock')) {
            $store_id = $request->store_id;
            $product_id = $request->product_id;
            $stock = HelperClass::stock($product_id, $store_id);
            return response()->json(['status' => 'success', 'stock' => $stock]);
        }

        if ($request->ajax() && $request->has('get_balance')) {
            $client = Client::findOrFail($request->client_id);
            $salesAmount = Sales::where('client_id', $request->client_id)->sum(DB::raw('total_amount - discount'));
            $paymentAmount = Collection::where('client_id', $request->client_id)->where('collection_type', '!=', 'adjust')->sum('amount');
            $returnAmount = SalesReturn::where('client_id', $request->client_id)->sum('amount');
            $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;
            return response()->json(['status' => 'success', 'balance' => $balance]);
        }

        if ($request->ajax() && $request->has('barcode')) {
            $product = Product::with('category')->where('code', $request->code)->whereNotNull('code')->first();
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $price = @$product->price->sale_price;
            $stock = HelperClass::stock($product_id, $request->store_id);

            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->qty[$product_id] + 1;
                // if ($stock < $total_qty) {
                //     return response()->json(['status' => 'error', 'data' => 'Stock Insuficient!']);
                // }
                $price = $request->rate[$product_id];
                $amount = $total_qty * $price;
                return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount]);
            }

            // if ($stock < 1) {
            //     return response()->json(['status' => 'error', 'data' => 'Stock Insuficient!']);
            // }

            return response()->json(['status' => 'success', 'product' => $product, 'price' => $price]);
        }

        if ($request->ajax()) {
            $store_id = $request->store_id;
            $product_id = $request->product_id;

            // $stock = HelperClass::stock($product_id, $store_id);
            // if ($request->quantity > $stock) {
            //     return response()->json(['status' => 'error', 'data' => 'stock not available!']);
            // } else {
                $product = Product::findOrFail($request->product_id);
                $price = $product->price->sale_price;
                $amount = $request->quantity * $price;
                return response()->json(['status' => 'success', 'product' => $product, 'price' => $price, 'amount' => $amount]);
            // }
        }

        $title = 'Add New Sales';
        $invoice = $this->getOrderNo();
        $companies = Company::orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $clients = Client::where('status', 1)->orderBy('name', 'asc')->get();
        $products = Product::where('product_type', 'Consumer')->where('status', 1)->orderBy('name', 'asc')->get();
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        return view('admin.sales.create', compact('title', 'clients', 'invoice', 'stores', 'staffs', 'products', 'cash_heads','companies'));
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
            'product_id' => 'required',
            'qty' => 'required',
        ]);

        $client = Client::find($request->client_id);
        $admin_setting = AdminSetting::first();
        if (@$admin_setting->accounting == 1 && is_null($client->coa)) {
            return redirect()->back()->withErrors('Please Setup clients account!');
        }

        try {
            DB::transaction(function () use ($request, $admin_setting) {
                $sales = Sales::create([
                    'company_id' => $request->company_id,
                    'branch_id' => $request->project_id,
                    'tax' => $request->tax,
                    'tax_amount' => $request->tax_amount,
                    'store_id' => $request->store_id,
                    'client_id' => $request->client_id,
                    'coa_setup_id' => $request->coa_setup_id,
                    'invoice' => $this->getOrderNo(),
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'sales_type' => $request->sales_type,
                    'total_amount' => $request->total_amount,
                    'discount' => $request->discount,
                    'total_paid' => $request->sales_type == 'cash' ? $request->net_amount : 0,
                    'staff_id' => $request->staff_id,
                    'created_by' => Auth::user()->id,
                ]);

                foreach ($request->product_id as $product_id) {
                    $stock = HelperClass::stock($product_id, $request->store_id);
                    // if ($request->qty[$product_id] > $stock) {
                    //     $product = Product::find($product_id);
                    //     throw new Exception('stock not available please decrease quantity for ' . $product->name);
                    // } else {
                        $discount = ($request->discount / $request->total_amount) * $request->amount[$product_id];
                        SalesList::create([
                            'company_id' => Auth::user()->company_id ?? 1,
                            'sales_id' => $sales->id,
                            'store_id' => $request->store_id,
                            'client_id' => $request->client_id,
                            'product_id' => $product_id,
                            'rate' => $request->rate[$product_id],
                            'qty' => $request->qty[$product_id],
                            'amount' => $request->amount[$product_id],
                            'discount' => $discount,
                            'collection' => $request->sales_type == 'cash' ? ($request->amount[$product_id] - $discount) : 0.00,
                        ]);
                    //}
                }

                $client = Client::find($request->client_id);
                if (@$admin_setting->accounting == 1 && $client->coa) {
                    $income_head = CoaSetup::where('head_type', 'I')->where('head_name', 'Whole Sale')->first();
                    $headCode = collect([
                        '0' => $client->coa->head_code,
                        '1' => $income_head->head_code,
                    ]);

                    $debit_amount = collect([
                        '0' => $request->net_amount,
                        '1' => 0.00
                    ]);

                    $credit_amount = collect([
                        '0' => 0.00,
                        '1' => $request->net_amount,
                    ]);

                    $countHead = count($headCode);
                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', (Auth::user()->company_id ?? 1))->where('head_code', $headCode[$i])->first();
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

               

                $store = Store::find($request->store_id);
                $products_info = '';
                foreach ($request->product_id as $product_id) {
                    $product = Product::find($product_id);
                    $products_info .= ' ' . $product->name . ' Quanity : ' . $request->qty[$product_id] . ' ' . $product->attribute->name;
                }
              
            });
        } catch (Throwable $caught) {
            if ($caught) {
                return redirect()->back()->withErrors($caught->getMessage());
            }
        }
        return redirect()->route('admin.sales.index')->withSuccessMessage('Created Successfully!');
    }

    function singleSms($msisdn, $messageBody, $csmsId)
    {
        $params = [
            "api_token" => API_TOKEN,
            "sid" => SID,
            "msisdn" => $msisdn,
            "sms" => $messageBody,
            "csms_id" => $csmsId
        ];
        $url = trim(DOMAIN, '/') . "/api/v3/send-sms";
        $params = json_encode($params);

        return $this->callApi($url, $params);
    }

    public static function callApi($url, $params)
    {
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
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
        // return view('admin.sales.chalan', compact('title', 'logo', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.sales.chalan', compact('title', 'logo', 'informations', 'report_title', 'data'));
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
        return view('admin.sales.vat', compact('title', 'logo', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.sales.vat', compact('title', 'logo', 'informations', 'report_title', 'data'));
        $pdf->setPaper('A4');
        return $pdf->stream('sales_invoice_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('get_stock')) {
            $store_id = $request->store_id;
            $product_id = $request->product_id;
            $sales = SalesList::where('sales_id', $id)->where('store_id', $store_id)->where('product_id', $product_id)->first();
            $stock = HelperClass::stock($product_id, $store_id) + @$sales->qty;
            return response()->json(['status' => 'success', 'stock' => $stock]);
        }

        if ($request->ajax() && $request->has('get_balance')) {
            $client = Client::findOrFail($request->client_id);
            $salesAmount = Sales::where('client_id', $request->client_id)->where('id', '!=', $id)->sum(DB::raw('total_amount - discount'));
            $paymentAmount = Collection::where('client_id', $request->client_id)->where('sales_id', '!=', $id)->where('collection_type', '!=', 'adjust')->sum('amount');
            $returnAmount = SalesReturn::where('client_id', $request->client_id)->sum('amount');
            $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;
            return response()->json(['status' => 'success', 'balance' => $balance]);
        }

        if ($request->ajax() && $request->has('barcode')) {
            $product = Product::with('category')->where('code', $request->code)->whereNotNull('code')->first();
            if (is_null($product)) {
                return response()->json(['status' => 'error', 'data' => 'Product Not Found!']);
            }
            $product_id = $product->id;
            $price = @$product->price->sale_price;
            $sales = SalesList::where('sales_id', $id)->where('store_id', $request->store_id)->where('product_id', $product_id)->first();
            $stock = HelperClass::stock($product_id, $request->store_id) + @$sales->qty;

            if (is_array($request->product_id) && in_array($product_id, $request->product_id)) {
                $total_qty = $request->qty[$product_id] + 1;
                // if ($stock < $total_qty) {
                //     return response()->json(['status' => 'error', 'data' => 'Stock Insuficient!']);
                // }
                $price = $request->rate[$product_id];
                $amount = $total_qty * $price;
                return response()->json(['status' => 'increment', 'product_id' => $product_id, 'total_qty' => $total_qty, 'amount' => $amount]);
            }

            // if ($stock < 1) {
            //     return response()->json(['status' => 'error', 'data' => 'Stock Insuficient!']);
            // }

            return response()->json(['status' => 'success', 'product' => $product, 'price' => $price]);
        }

        if ($request->ajax()) {
            $store_id = $request->store_id;
            $product_id = $request->product_id;

            $sales = SalesList::where('sales_id', $id)->where('store_id', $store_id)->where('product_id', $product_id)->first();
            $stock = HelperClass::stock($product_id, $store_id) + @$sales->qty;
            // if ($request->quantity > $stock) {
            //     return response()->json(['status' => 'error', 'data' => 'stock not available!']);
            // } else {
                $product = Product::findOrFail($request->product_id);
                $price = $product->price->sale_price;
                $amount = $request->quantity * $price;
                return response()->json(['status' => 'success', 'product' => $product, 'price' => $price, 'amount' => $amount]);
            // }
        }

        $title = 'Update Sales';
        $stores = Store::where('status', 1)->get();
        $clients = Client::where('status', 1)->orderBy('name', 'asc')->get();
        $staffs = Staff::where('status', 1)->orderBy('name', 'asc')->get();

        $data = Sales::findOrFail($id);
        $client = Client::findOrFail($data->client_id);
        $salesAmount = Sales::where('client_id', $data->client_id)->where('id', '!=', $id)->sum(DB::raw('total_amount - discount'));
        $paymentAmount = Collection::where('client_id', $data->client_id)->where('sales_id', '!=', $id)->where('collection_type', '!=', 'adjust')->sum('amount');
        $returnAmount = SalesReturn::where('client_id', $data->client_id)->sum('amount');
        $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;

        $products = Product::where('product_type', 'Consumer')->where('status', 1)->orderBy('name', 'asc')->get();
        $link = Route('admin.sales.update', $id);
        $cash_heads = CoaSetup::with('parent')->whereHas('parent', function ($query) {
            $query->where('head_name', 'Cash In Hand')->orWhere('head_name', 'Cash In Bank');
        })->get();
        $companies = Company::orderBy('name', 'asc')->get();
        $projects = Branch::where('company_id', $data->company_id)
            ->orderBy('name', 'asc')
            ->get(['id', 'name']);
        return view('admin.sales.edit', compact('title', 'clients', 'stores', 'staffs', 'data', 'link', 'balance', 'products', 'cash_heads','companies','projects'));
    }

    public function searchEdit(Request $request)
    {
        if (is_null($request->invoice)) {
            return redirect()->route('admin.sales.index');
        }

        $title = 'Update Sales';
        $stores = Store::where('status', 1)->get();
        $clients = Client::where('status', 1)->orderBy('name', 'asc')->get();
        $staffs = Staff::where('status', 1)->where('type', 'sales')->orderBy('name', 'asc')->get();
        $data = Sales::where('product_type', 'Consumer')->where('invoice', $request->invoice)->latest('id')->first();
        $collection_data = CollectionData::with('collection')->whereHas('collection')->where('sales_id', $data->id)->first();
        if (!is_null($collection_data)) {
            return redirect()->back()->withErrors('Has Collection!');
        }

        $client = Client::findOrFail($data->client_id);
        $salesAmount = Sales::where('client_id', $data->client_id)->where('id', '!=', $data->id)->sum(DB::raw('total_amount - discount'));
        $paymentAmount = Collection::where('client_id', $data->client_id)->where('sales_id', '!=', $data->id)->where('collection_type', '!=', 'adjust')->sum('amount');
        $returnAmount = SalesReturn::where('client_id', $data->client_id)->sum('amount');
        $balance = ($returnAmount + $paymentAmount + $client->credit_limit) - $salesAmount;

        $products = Product::where('product_type', 'Consumer')->where('status', 1)->orderBy('name', 'asc')->get();
        $link = Route('admin.sales.update', $data->id);
        return view('admin.sales.edit', compact('title', 'clients', 'stores', 'staffs', 'data', 'link', 'balance', 'products'));
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
            'product_id' => 'required',
            'qty' => 'required',
        ]);

        $client = Client::find($request->client_id);
        $admin_setting = AdminSetting::first();
        if (@$admin_setting->accounting == 1 && is_null($client->coa)) {
            return redirect()->back()->withErrors('Please Setup a clients account!');
        }

        try {
            DB::transaction(function () use ($request, $id, $admin_setting) {
                $sales = Sales::findOrFail($id);
                $collection = Collection::withTrashed()->where('sales_id', $id)->first();
                AccountTransactionAuto::withTrashed()->where('voucher_no', $sales->invoice)->where('voucher_type', 'Sales')->forceDelete();
                if ($collection) {
                    AccountTransactionAuto::withTrashed()->where('voucher_no', $collection->payment_no)->where('voucher_type', 'Collection')->forceDelete();
                    $collection->forceDelete();
                }
                SalesList::where('sales_id', $id)->delete();
                $sales->update([
                    'company_id' => $request->company_id,
                    'branch_id' => $request->project_id,
                    'tax' => $request->tax,
                    'tax_amount' => $request->tax_amount,
                    'store_id' => $request->store_id,
                    'client_id' => $request->client_id,
                    'coa_setup_id' => $request->coa_setup_id,
                    'invoice' => $this->getOrderNo(),
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'sales_type' => $request->sales_type,
                    'total_amount' => $request->total_amount,
                    'discount' => $request->discount,
                    'total_paid' => $request->sales_type == 'cash' ? $request->net_amount : 0,
                    'staff_id' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ]);

                foreach ($request->product_id as $product_id) {
                    $stock = HelperClass::stock($product_id, $request->store_id);
                    // if ($request->qty[$product_id] > $stock) {
                    //     $product = Product::find($product_id);
                    //     throw new Exception('stock not available please decrease quantity for ' . $product->name);
                    // } else {
                        $discount = ($request->discount / $request->total_amount) * $request->amount[$product_id];
                        SalesList::create([
                            'company_id' => Auth::user()->company_id ?? 1,
                            'sales_id' => $sales->id,
                            'store_id' => $request->store_id,
                            'client_id' => $request->client_id,
                            'product_id' => $product_id,
                            'rate' => $request->rate[$product_id],
                            'qty' => $request->qty[$product_id],
                            'amount' => $request->amount[$product_id],
                            'discount' => $discount,
                            'collection' => $request->sales_type == 'cash' ? ($request->amount[$product_id] - $discount) : 0.00,
                        ]);
                    // }
                }

              
               
               
            });

            return redirect()->Route('admin.sales.index')->withSuccessMessage('Created Successfully!');
        } catch (Throwable $caught) {
            if ($caught) {
                return redirect()->back()->withErrors($caught->getMessage());
            }
        }
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
