<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use App\Models\StoreArea;
use Illuminate\Http\Request;

class BulkForwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $store_area = StoreArea::where('store_id', $request->store_id)->pluck('area_id')->toArray();
            $orders = Order::with('area')->where('status', 'Pending')->whereIn('area_id', $store_area)->get();
            return response()->json(['status' => 'success', 'orders' => $orders]);
        }

        $title = 'Bulk Forward';
        $stores = Store::where('status', 1)->orderBy('name', 'asc')->get();
        $disable_back = true;
        return view('admin.bulk_forward.create', compact('title', 'stores', 'disable_back'));
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
            'store_id' => 'required',
            'order_id' => 'required',
        ]);
        Order::whereIn('id', $request->order_id)->update(['status' => 'Forward', 'store_id' => $request->store_id]);
        return redirect()->back()->withSuccessMessage('Forward Successfully!');
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
