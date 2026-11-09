<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OfflineOrderListDataTable;
use App\DataTables\OfflineOrderSummaryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Scopes\CompanyScope;
use App\Models\Vendor;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfflineOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OfflineOrderListDataTable $listDataTable, OfflineOrderSummaryDataTable $summaryDataTable, Request $request)
    {

        if ($request->has('print')) {
            if (Auth::user()->company_id) {
                $company = Company::find(Auth::user()->company_id);
                $title = $company->name;
                $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
            } else {
                $title = 'Company Name Goes Here.';
                $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
            }

            if ($request->type == 'list') {
                $report_type = 'list';
                $report_title = 'Order List';
                $query = Order::with(['company', 'client', 'staff'])->where('order_type', 'offline')->orderBy('date', 'desc');
                $query->whereHas('products', function ($query) {
                    $query->where('sold', 0);
                });
                $data = $query->get();
                // return view('admin.offline_order.order_history_print', compact('title', 'informations', 'report_title', 'report_type', 'data'));
                $pdf = Pdf::loadView('admin.offline_order.order_history_print', compact('title', 'informations', 'report_title', 'report_type', 'data'));
                return $pdf->stream('order_list_' . date('d_m_Y_H_i_s') . '.pdf');
            } else {
                $report_type = 'summary';
                $report_title = 'Order Summary';
                $query = OrderProduct::with(['product'])->select(
                    'order_products.product_id',
                    DB::raw('SUM(order_products.quantity) as total_qty'),
                );
                $query->where('sold', 0);
                $query->groupBy('product_id');
                $data = $query->get();
                // return view('admin.offline_order.order_history_print', compact('title', 'informations', 'report_title', 'report_type', 'data'));
                $pdf = Pdf::loadView('admin.offline_order.order_history_print', compact('title', 'informations', 'report_title', 'report_type', 'data'));
                return $pdf->stream('order_summary_' . date('d_m_Y_H_i_s') . '.pdf');
            }
        }

        $type = $request->type;
        $params = '<form action="' . Route('admin.offline-order.index') . '" method="GET" id="type_filter_form">
        <select name="type" id="type"
            class="form-select custom-select flex-shrink-0"
            style="width: 100px; padding: 4px 10px; min-height: auto;">
            <option value="list" ' . (!is_null($type) && $type == "list" ? "selected" : "") . '>List</option>
            <option value="summary" ' . (!is_null($type) && $type == "summary" ? "selected" : "") . '>Summary</option>
        </select></form>';
        $title = "Offline Orders";
        if ($request->has('type') && !is_null($request->type) && $request->type == 'summary') {
            return $summaryDataTable->render('admin.offline_order.index', compact('title', 'params', 'type'));
        } else {
            return $listDataTable->render('admin.offline_order.index', compact('title', 'params', 'type'));
        }
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $order = Order::withoutGlobalScope(CompanyScope::class)->withTrashed()->select(['invoice'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->where('order_type', 'offline')->latest('id')->first();
        if ($order) {
            $trim = str_replace("ST", '', $order->invoice);
            $orderPrefix = (int)$trim + 1;
            $invoice = "ST" . $orderPrefix;
        } else {
            $invoice = "ST" . date('Y') . date('m') . '000001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->ajax() && request('get_product')) {
            $product = Product::with(['price', 'vendor'])->where('id', request('product_id'))->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        if (request()->ajax()) {
            $products = Product::where('vendor_id', request('vendor_id'))->orderBy('name')->get();
            return response()->json(['status' => 'success', 'products' => $products]);
        }

        $title = 'Add New Order';
        $invoice_no = $this->invoice();
        $clients = Client::orderBy('name', 'asc')->get();
        $vendors = Vendor::orderBy('name', 'asc')->get();
        return view('admin.offline_order.create', compact('title', 'clients', 'vendors', 'invoice_no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'date' => 'required',
            'invoice' => 'required',
            'product_id' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $invoice_no = $this->invoice();
            $client = Client::findOrFail($request->client_id);
            $order = Order::create([
                'company_id' => Auth::user()->company_id ? Auth::user()->company_id : 1,
                'client_id' => $request->client_id,
                'order_code' => 'ST' . mt_rand(111111, 999999),
                'date' => date('Y-m-d', strtotime($request->date)),
                'invoice' => $invoice_no,
                'user_name' => $client->name,
                'user_phone' => $client->phone,
                'sub_total' => 0,
                'discount' => 0,
                'total' => 0,
                'paid' => 0,
                'due' => 0,
                'pending_at' => Carbon::now(),
                'created_by' => Auth::user()->id,
            ]);

            foreach ($request->product_id as $key => $product_id) {
                $product = Product::findOrFail($product_id);
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product_id,
                    'sale_price' => $product->price->sale_price,
                    'regular_price' => $product->price->sale_price,
                    'discount_price' => $product->price->sale_price,
                    'order_price' => $product->price->sale_price,
                    'quantity' => $request->quantity[$key]
                ]);
            }
        });

        return redirect()->route('admin.offline-order.index')->withSuccessMessage('Created Successfully!');
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
        $data = Order::findOrFail($id);
        $report_title = 'Client Order';
        $products = OrderProduct::with(['product'])->where('order_id', $id)->get();
        $pdf = Pdf::loadView('admin.offline_order.print', compact('title', 'informations', 'report_title', 'data', 'products'));
        return $pdf->stream('client_order_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (request()->ajax() && request('status')) {
            $data = Order::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        if (request()->ajax() && request('get_product')) {
            $product = Product::with(['price', 'vendor'])->where('id', request('product_id'))->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        if (request()->ajax()) {
            $products = Product::where('vendor_id', request('vendor_id'))->orderBy('name')->get();
            return response()->json(['status' => 'success', 'products' => $products]);
        }

        $title = 'Update Order';
        $data = Order::findOrFail($id);
        $link = Route('admin.offline-order.update', $id);
        $clients = Client::orderBy('name', 'asc')->get();
        $vendors = Vendor::orderBy('name', 'asc')->get();
        $products = OrderProduct::with(['product'])->where('order_id', $id)->get();
        return view('admin.offline_order.edit', compact('title', 'data', 'link', 'clients', 'vendors', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_id' => 'required',
            'date' => 'required',
            'invoice' => 'required',
            'product_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $data = Order::findOrFail($id);
            $client = Client::findOrFail($request->client_id);
            $data->update([
                'client_id' => $request->client_id,
                'date' => date('Y-m-d', strtotime($request->date)),
                'invoice' => $request->invoice,
                'user_name' => $client->name,
                'user_phone' => $client->phone,
                'sub_total' => 0,
                'discount' => 0,
                'total' => 0,
                'paid' => 0,
                'due' => 0,
                'updated_by' => Auth::user()->id,
            ]);
            OrderProduct::where('order_id', $id)->delete();
            foreach ($request->product_id as $key => $product_id) {
                $product = Product::findOrFail($product_id);
                OrderProduct::create([
                    'order_id' => $id,
                    'product_id' => $product_id,
                    'sale_price' => $product->price->sale_price,
                    'regular_price' => $product->price->sale_price,
                    'discount_price' => $product->price->sale_price,
                    'order_price' => $product->price->sale_price,
                    'quantity' => $request->quantity[$key]
                ]);
            }
        });

        return redirect()->route('admin.offline-order.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Order::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Order::onlyTrashed()->findOrFail($id);
                foreach ($data->products as $product) {
                    $product->forceDelete();
                }
                $data->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Order::onlyTrashed()->findOrFail($id);
            foreach ($data->products as $product) {
                $product->forceDelete();
            }
            $data->forceDelete();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Order::findOrFail($id);
                $data->update(['deleted_by' => Auth::user()->id]);
                $data->delete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Order::findOrFail($id);
        $data->update(['deleted_by' => Auth::user()->id]);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
}
