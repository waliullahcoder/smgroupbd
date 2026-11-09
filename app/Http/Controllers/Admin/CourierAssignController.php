<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;

class CourierAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::with('area')->where('store_id', $request->store_id)->whereIn('status', ['Pending', 'Forward', 'On Route'])->where('courier_assigned', 0)->get();
            return response()->json(['status' => 'success', 'orders' => $orders]);
        }

        $title = 'Courier Assign';
        $stores = Store::where('status', 1)->orderBy('name', 'asc')->get();
        $disable_back = true;
        return view('admin.courier_assign.create', compact('title', 'stores', 'disable_back'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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

        // The endpoint you are hitting
        $url = 'https://quickexpressbd.com/api/v1/booking';

        // API Key and Secret Key for authentication
        $apiKey = 'EF6UqUzMN9GF61B5Aa6qxhMtj6sh3TCY';
        $secretKey = 'nmpkNyHCjte0mTAaK2YvFP04';

        // Request body payload
        $data = \App\Models\Order::whereIn('id', $request->order_id)->select('invoice as customer_invoice', 'user_name as customer_name', 'user_phone as customer_phone', 'shipping_address as customer_address', 'due as cod_amount', 'total as invoice_amount', 'order_note as remarks')->get();

        // Send the POST request
        $response = \Http::withHeaders([
            'Api-Key' => $apiKey,
            'Secret-Key' => $secretKey,
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        $data = $response->json();
        // Check for successful response
        if ($response->successful()) {
            foreach ($data['data'] as $item) {
                $order = \App\Models\Order::where('invoice', $item['customer_invoice'])->first();
                $order->update(['courier_assigned' => 1]);
                if ($order->status == 'Pending') {
                    $order->update(['status' => 'On Route']);
                }
                if (is_null($order->store_id)) {
                    $store = Store::first();
                    $order->update(['store_id' => @$store->id]);
                }
            }
            return redirect()->back()->withSuccessMessage('Assigned Successfully!');
        } else {
            return redirect()->back()->withErrors($data['data']);
        }
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
