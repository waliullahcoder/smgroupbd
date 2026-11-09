<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Order;
use App\Models\DeliveryMan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Bulk Assign';
        $query = DeliveryMan::where('status', 1);
        if (Auth::user()->stores) {
            $query->whereIn('store_id', Auth::user()->stores);
        }
        $delivery_men = $query->orderBy('name', 'asc')->get();
        $query = Order::where('status', 'Forward');
        if(Auth::user()->stores){
            $query->whereIn('store_id', Auth::user()->stores);
        }
        $orders = $query->get();
        $disable_back = true;
        return view('admin.order_assign.create', compact('title', 'delivery_men', 'orders', 'disable_back'));
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
            'delivery_man_id' => 'required',
            'order_id' => 'required',
        ]);
        Order::whereIn('id', $request->order_id)->update(['status' => 'On Route', 'delivery_man_id' => $request->delivery_man_id]);
        return redirect()->back()->withSuccessMessage('Assigned Successfully!');
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
