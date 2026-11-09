<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\ActionButtons\ActionButtons;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $client_id = Auth::user()->client->id;
            $model = Order::where('order_type', 'offline')->orderBy('date', 'desc')->where('client_id', $client_id);
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input ' . (!empty(request('type')) && request('type') == "trash" ? 'trash_multi_checkbox' : 'multi_checkbox') . '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                    return $checkbox;
                })
                ->addColumn('date', function ($row) {
                    return date('Y-m-d', strtotime($row->date));
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" href="' . Route('client.product-request.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher" target="_blank"><i class="fal fa-print"></i></a>';
                    return ActionButtons::actions($data, $actionBtn);
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Product Request";
        return view('client.offline_order.index', compact('title'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $order = Order::withTrashed()->select(['invoice'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->where('order_type', 'offline')->latest('id')->first();
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
        if (request()->ajax()) {
            $product = Product::with(['price', 'vendor'])->where('id', request('product_id'))->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        $title = 'Add Product Request';
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        return view('client.offline_order.create', compact('title', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $invoice_no = $this->invoice();
            $client_id = Auth::user()->client->id;
            $client = Client::findOrFail($client_id);
            $order = Order::create([
                'company_id' => Auth::user()->company_id ? Auth::user()->company_id : 1,
                'client_id' => $client_id,
                'order_code' => 'ST' . mt_rand(111111, 999999),
                'date' => date('Y-m-d'),
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

        return redirect()->route('client.product-request.index')->withSuccessMessage('Created Successfully!');
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
        $data = Order::findOrFail($id);
        $report_title = 'Product Request';
        $products = OrderProduct::with(['product'])->where('order_id', $id)->get();
        $pdf = Pdf::loadView('client.offline_order.print', compact('title', 'informations', 'report_title', 'data', 'products'));
        return $pdf->stream('client_order_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (request()->ajax()) {
            $product = Product::with(['price', 'vendor'])->where('id', request('product_id'))->first();
            return response()->json(['status' => 'success', 'product' => $product]);
        }

        $title = 'Update Product Request';
        $data = Order::findOrFail($id);
        $link = Route('client.product-request.update', $id);
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        $order_products = OrderProduct::with(['product'])->where('order_id', $id)->get();
        return view('client.offline_order.edit', compact('title', 'data', 'link', 'products', 'order_products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $data = Order::findOrFail($id);
            $data->update([
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
        return redirect()->route('client.product-request.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Order::findOrFail($id)->forceDelete();
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Order::findOrFail($id)->forceDelete();
        return response()->json(['status' => 'success']);
    }
}
