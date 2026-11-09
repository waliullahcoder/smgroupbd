<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            if (Auth::user()->hasRole('System Admin') || Auth::user()->hasRole('Software Admin')) {
                $model = Order::with(['store', 'staff', 'area', 'products'])->orderBy('id', 'desc');
            } else {
                $model = Order::with(['store', 'staff', 'area', 'products'])->where('created_by', Auth::user()->id)->orderBy('id', 'desc');
            }
            $model->whereIn('status', ['Delivered']);
            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('items', function($row){
                    $string = '';
                    foreach ($row->products as $key => $item) {
                        $string .= ($key > 0 ? ', ' : '') . @$item->product->name . ' - ' . $item->quantity . ' ' . @$item->product->attribute->name . ' - ' . $item->subtotal . 'Taka ';
                    }
                    return $string;
                })
                ->addColumn('actions', function ($row) {
                    return '<a class="btn btn-sm border-0 px-10px btn-info tt" href="' . Route('admin.order-return.edit', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Return Product">Return</a>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }

        $title = "Order Return";
        return view('admin.order_return.index', compact('title'));
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
    public function edit(Request $request, string $id)
    {
        $title = "Return Product";
        $data = Order::findOrFail($id);
        $link = Route('admin.order-return.update', $id);
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.order_return.edit', compact('title', 'data', 'link', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::transaction(function () use ($request, $id) {
            $data = Order::findOrFail($id);
            $data->update([
                'total_return' => $request->total_return
            ]);

            foreach ($request->order_product_id as $order_product_id) {
                $item = OrderProduct::findOrFail($order_product_id);
                $item->update([
                    'return_amount' => @$request->return_amount[$order_product_id] ?? 0,
                ]);
            }
        });

        return redirect()->route('admin.order-return.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
