<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCharge;
use Illuminate\Http\Request;

class DeliveryChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Update Delivery Charge';
        $link = Route('admin.delivery-charge.update', '0');
        $data = DeliveryCharge::first();
        return view('admin.delivery_charge.edit', compact('data', 'link', 'title'));
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
        //
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
        $request->validate([
            'inside_charge' => 'required',
            'outside_charge' => 'required',
        ]);

        $data = DeliveryCharge::first();
        if (is_null($data)) {
            $data = new DeliveryCharge();
        }
        $data->inside_charge = $request->inside_charge;
        $data->outside_charge = $request->outside_charge;
        $data->save();
        return redirect()->back()->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
