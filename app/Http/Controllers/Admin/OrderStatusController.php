<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\DeliveryMan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::with('area')->where('delivery_man_id', $request->delivery_man_id)->where('status', 'On Route')->get();
            return response()->json(['status' => 'success', 'orders' => $orders, 'total_shipping' => $orders->sum('shipping_charge'), 'total_amount' => $orders->sum('sub_total'), 'total_receivable' => $orders->sum('total')]);
        }

        $title = 'Order Status Update';
        $query = DeliveryMan::where('status', 1);
        if (Auth::user()->stores) {
            $query->whereIn('store_id', Auth::user()->stores);
        }
        $delivery_men = $query->orderBy('name', 'asc')->get();
        $disable_back = true;
        return view('admin.order_status.create', compact('title', 'delivery_men', 'disable_back'));
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
            foreach ($request->order_id as $order_id) {
                if (in_array($request->status[$order_id], ['Delivered', 'Cancelled'])) {
                    $order = Order::findOrFail($order_id);
                    $order->update(['status' => $request->status[$order_id]]);
                    if ($request->status[$order_id] == 'Delivered') {
                        $order->update(['delivered_at' => date('Y-m-d H:i:s'), 'receive' => $request->receive[$order_id]]);
                    }
                    if ($request->status[$order_id] == 'Cancelled') {
                        $order->update(['canceled_at' => date('Y-m-d H:i:s')]);
                    }
                }
            }
        });

        return redirect()->back()->withSuccessMessage('Updated Successfully!');
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
