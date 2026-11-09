<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Area;
use App\Models\Order;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\OrderProduct;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AccountTransaction;
use App\Models\AccountTransactionAuto;
use App\Models\AdminSetting;
use App\Models\CoaSetup;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;

class OnlineOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            if (Auth::user()->hasRole('System Admin') || Auth::user()->hasRole('Software Admin')) {
                $model = Order::with(['store', 'staff', 'area'])->orderBy('id', 'desc');
            } else {
                $model = Order::with(['store', 'staff', 'area'])->where('created_by', Auth::user()->id)->orderBy('id', 'desc');
            }
            $model->whereIn('status', ['Pending', 'Forward', 'On Route']);
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->date));
                })
                ->addColumn('potential_delivery_date', function ($row) {
                    return date('d-m-Y', strtotime($row->potential_delivery_date));
                })
                ->addColumn('order_status', function ($row) {
                    if ($row->status == 'Cancelled') {
                        $status = '<span class="btn btn-xs text-white px-2 bg-danger" style="min-width: 80px;">Cancelled</span>';
                    } elseif ($row->status == 'Successed') {
                        $status = '<span class="btn btn-xs text-white px-2 bg-success" style="min-width: 80px;">Successed</span>';
                    } else {
                        $status = '<a class="btn btn-xs text-white px-2 ';
                        if ($row->status == 'Pending') {
                            $status .= 'bg-primary';
                        } elseif ($row->status == 'On Route') {
                            $status .= 'bg-route';
                        } elseif ($row->status == 'Forward') {
                            $status .= 'bg-warning';
                        } elseif ($row->status == 'Delivered') {
                            $status .= 'bg-delivered';
                        } elseif ($row->status == 'Returned') {
                            $status .= 'bg-danger';
                        }
                        $status .= '" style="min-width: 80px;" href="' . (!Auth::user()->hasRole('Moderator') ? Route('admin.order-dashboard.edit', $row->id) : '') . '">' . $row->status . '</a>';
                    }
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];
                    $actionBtn = '<a class="btn btn-sm border-0 px-10px fs-15 btn-info tt" target="_blank" href="' . Route('admin.order.show', $row->id) . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Voucher"><i class="fas fa-eye"></i></a>';

                    $transaction = AccountTransaction::withTrashed()->where('voucher_no', $row->invoice)->where('voucher_type', 'Retail Sales')->first();
                    $trim = str_replace("STOS", '', $row->invoice);
                    $invoice = "STOC" . $trim;
                    $coll_transaction = AccountTransaction::withTrashed()->where('voucher_no', $invoice)->where('voucher_type', 'Retail Collection')->first();
                    if (in_array($row->status, ['Pending', 'Forward', 'On Route']) && is_null($transaction) && is_null($coll_transaction)) {
                        return ActionButtons::actions($data, $actionBtn);
                    }
                    return '<div class="btn-group">' . $actionBtn . '</div>';
                })
                ->rawColumns(['checkbox', 'order_status', 'actions'])
                ->make(true);
        }

        $title = "Online Order Setup";
        return view('admin.online_order.index', compact('title'));
    }

    public function getOrderNo()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $order = Order::withTrashed()->select(['invoice'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($order) {
            $trim = str_replace("STOS", '', $order->invoice);
            $orderPrefix = (int)$trim + 1;
            $invoice = "STOS" . $orderPrefix;
        } else {
            $invoice = "STOS" . date('Y') . date('m') . '0001';
        }
        return $invoice;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('user_phone')) {
            $order = Order::where('user_phone', 'like', $request->user_phone)->first();
            if ($order) {
                return response()->json(['status' => 'success', 'user_name' => $order->user_name, 'shipping_address' => $order->shipping_address]);
            }
        }

        if ($request->ajax() && $request->has('get_product')) {
            $stock = $this->stock($request->product_id, $request->store_id);
            return response()->json(['status' => 'success', 'stock' => $stock]);
        }

        if ($request->ajax() && $request->has('get_stock')) {
            $store_id = $request->store_id;
            $product_id = $request->product_id;
            $stock = $this->stock($product_id, $store_id);
            // if ($request->quantity > $stock) {
            //     return response()->json(['status' => 'error', 'data' => 'stock not available please decrease quantity!']);
            // } else {
            $product = Product::find($request->product_id);
            $price = $product->price->online_price;
            $amount = $request->quantity * $product->price->online_price;
            $unit = $product->attribute->name;
            return response()->json(['status' => 'success', 'product' => $product, 'unit' => $unit, 'quantity' => $request->quantity, 'stock' => $stock, 'price' => $price, 'amount' => $amount]);
            // }
        }

        $title = "Add New Order";
        $order_no = $this->getOrderNo();
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.online_order.create', compact('title', 'order_no', 'products', 'areas'));
    }

    public static function stock($product_id, $store_id)
    {
        $liftings = DB::table('view_liftings')->where('product_type', 'Consumer')->where('product_id', $product_id)->where('store_id', $store_id)->sum('qty');
        $lifting_returns = DB::table('view_lifting_returns')->where('product_type', 'Consumer')->where('product_id', $product_id)->where('store_id', $store_id)->sum('qty');
        $client_sales = DB::table('view_sales')->where('product_type', 'Consumer')->where('product_id', $product_id)->where('store_id', $store_id)->sum('qty');
        $sales_returns = DB::table('view_sales_returns')->where('product_type', 'Consumer')->where('product_id', $product_id)->where('store_id', $store_id)->sum('qty');
        $online_sales = DB::table('view_online_sales')->where('product_type', 'Consumer')->where('product_id', $product_id)->where('store_id', $store_id)->sum('qty');
        $transfers = DB::table('view_transfers')->where('product_type', 'Consumer')->where('product_id', $product_id)->where('host_id', $store_id)->sum('qty');
        $receives = DB::table('view_transfers')->where('product_type', 'Consumer')->where('product_id', $product_id)->where('destination_id', $store_id)->sum('qty');
        return $liftings + $sales_returns + $receives - $lifting_returns - $client_sales - $online_sales - $transfers;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'user_phone' => 'required',
            'shipping_address' => 'required',
            'date' => 'required',
            'area_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $invoice = $this->getOrderNo();
            $data = Order::create([
                'company_id' => Auth::user()->company_id ?? 1,
                'invoice' => $invoice,
                'order_code' => 'R' . mt_rand(111111, 999999),
                'user_name' => $request->user_name,
                'user_phone' => $request->user_phone,
                'shipping_charge' => $request->shipping_charge,
                'shipping_address' => $request->shipping_address,
                'area_id' => $request->area_id,
                'sub_total' => $request->total_amount,
                'total' => $request->total_amount + $request->shipping_charge,
                'discount' => $request->discount,
                'paid' => 0,
                'due' => $request->total_amount + $request->shipping_charge - $request->discount,
                'order_type' => 'online',
                'status' => 'Pending',
                'coupon_id' => NULL,
                'order_note' => NULL,
                'payment_method' => 'COD',
                'order_note' => $request->order_note,
                'date' => date('Y-m-d', strtotime($request->date)),
                'potential_delivery_date' => date('Y-m-d', strtotime($request->potential_delivery_date)),
                'pending_at' => Carbon::now(),
                'created_by' => $request->created_by ?? Auth::user()->id,
            ]);

            foreach ($request->product_id as $key => $product_id) {
                $discount = ($request->discount / $request->total_amount) * $request->amount[$key];
                OrderProduct::create([
                    'order_id' => $data->id,
                    'product_id' => $product_id,
                    'discount' => $discount,
                    'sale_price' => $request->price[$key],
                    'subtotal' => $request->amount[$key],
                    'quantity' => $request->quantity[$key],
                ]);
            }

            $admin_setting = AdminSetting::first();
            if (@$admin_setting->accounting == 1) {
                $client_head = CoaSetup::where('head_type', 'A')->where('head_name', 'Retail Client')->first();
                $income_head = CoaSetup::where('head_type', 'I')->where('head_name', 'Retail Sale')->first();
                $headCode = collect([
                    '0' => $client_head->head_code,
                    '1' => $income_head->head_code,
                ]);

                $debit_amount = collect([
                    '0' => $request->total_amount + $request->shipping_charge - $request->discount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $request->total_amount + $request->shipping_charge - $request->discount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', (Auth::user()->company_id ?? 1))->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $invoice,
                        'voucher_type' => "Retail Sales",
                        'voucher_date' => date('Y-m-d', strtotime($request->date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Retail Sales Against Invoice No - ' . $invoice,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }
        });

        return redirect()->route('admin.order.index')->withSuccessMessage('Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.print', compact('order'));

        if (Auth::user()->company_id) {
            $company = Company::find(Auth::user()->company_id);
            $title = $company->name;
            $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
        } else {
            $title = 'Company Name Goes Here.';
            $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
        }
        $data = Order::findOrFail($id);
        $report_title = 'Order Voucher';
        // return view('admin.online_order.print', compact('title', 'informations', 'report_title', 'data'));
        $pdf = Pdf::loadView('admin.online_order.print', compact('title', 'informations', 'report_title', 'data'));
        // $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('order_chalan_' . date('d_m_Y_H_i_s') . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('get_product')) {
            $store_id = $request->store_id;
            $old_qty = OrderProduct::with('order')->where('order_id', $id)->where('product_id', $request->product_id)->whereHas('order', function ($query) use ($store_id) {
                $query->where('store_id', $store_id);
            })->sum('quantity');
            $stock = $this->stock($request->product_id, $request->store_id) + $old_qty;
            return response()->json(['status' => 'success', 'stock' => $stock]);
        }

        if ($request->ajax() && $request->has('get_stock')) {
            $store_id = $request->store_id;
            $product_id = $request->product_id;
            $old_qty = OrderProduct::with('order')->where('order_id', $id)->where('product_id', $request->product_id)->whereHas('order', function ($query) use ($store_id) {
                $query->where('store_id', $store_id);
            })->sum('quantity');
            $stock = $this->stock($request->product_id, $request->store_id) + $old_qty;
            if ($request->quantity > $stock) {
                return response()->json(['status' => 'error', 'data' => 'stock not available please decrease quantity!']);
            } else {
                $product = Product::find($request->product_id);
                $price = $product->price->online_price;
                $amount = $request->quantity * $product->price->online_price;
                $unit = $product->attribute->name;
                return response()->json(['status' => 'success', 'product' => $product, 'unit' => $unit, 'quantity' => $request->quantity, 'stock' => $stock, 'price' => $price, 'amount' => $amount]);
            }
        }

        $title = "Update Order";
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        $data = Order::findOrFail($id);
        $link = Route('admin.order.update', $id);
        $areas = Area::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.online_order.edit', compact('title', 'products', 'data', 'link', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_name' => 'required',
            'user_phone' => 'required',
            'shipping_address' => 'required',
            'date' => 'required',
            'area_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        DB::transaction(function () use ($request, $id) {
            $data = Order::findOrFail($id);
            AccountTransactionAuto::withTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->forceDelete();

            $trim = str_replace("STOS", '', $data->invoice);
            $invoice = "STOC" . $trim;
            AccountTransactionAuto::withTrashed()->where('voucher_no', $invoice)->where('voucher_type', 'Retail Collection')->forceDelete();
            OrderProduct::where('order_id', $id)->delete();

            $data->update([
                'user_name' => $request->user_name,
                'user_phone' => $request->user_phone,
                'shipping_charge' => $request->shipping_charge,
                'shipping_address' => $request->shipping_address,
                'area_id' => $request->area_id,
                'sub_total' => $request->total_amount,
                'total' => $request->total_amount + $request->shipping_charge,
                'discount' => $request->discount,
                'paid' => 0,
                'due' => $request->total_amount + $request->shipping_charge - $request->discount,
                'date' => date('Y-m-d', strtotime($request->date)),
                'potential_delivery_date' => date('Y-m-d', strtotime($request->potential_delivery_date)),
                'order_note' => $request->order_note,
                'created_by' => $request->created_by ?? Auth::user()->id,
            ]);

            foreach ($request->product_id as $key => $product_id) {
                $discount = ($request->discount / $request->total_amount) * $request->amount[$key];
                OrderProduct::create([
                    'order_id' => $data->id,
                    'product_id' => $product_id,
                    'discount' => $discount,
                    'sale_price' => $request->price[$key],
                    'subtotal' => $request->amount[$key],
                    'quantity' => $request->quantity[$key],
                ]);
            }

            $admin_setting = AdminSetting::first();
            if (@$admin_setting->accounting == 1) {
                $client_head = CoaSetup::where('head_type', 'A')->where('head_name', 'Retail Client')->first();
                $income_head = CoaSetup::where('head_type', 'I')->where('head_name', 'Retail Sale')->first();
                $headCode = collect([
                    '0' => $client_head->head_code,
                    '1' => $income_head->head_code,
                ]);

                $debit_amount = collect([
                    '0' => $request->total_amount + $request->shipping_charge - $request->discount,
                    '1' => 0.00
                ]);

                $credit_amount = collect([
                    '0' => 0.00,
                    '1' => $request->total_amount + $request->shipping_charge - $request->discount,
                ]);

                $countHead = count($headCode);
                $postData = [];
                for ($i = 0; $i < $countHead; $i++) {
                    $coa = CoaSetup::where('company_id', (Auth::user()->company_id ?? 1))->where('head_code', $headCode[$i])->first();
                    $postData[] = [
                        'company_id' => Auth::user()->company_id ?? 1,
                        'voucher_no' => $data->invoice,
                        'voucher_type' => "Retail Sales",
                        'voucher_date' => date('Y-m-d', strtotime($request->date)),
                        'coa_setup_id' => $coa->id,
                        'coa_head_code' => $headCode[$i],
                        'narration' => 'Retail Sales Against Invoice No - ' . $data->invoice,
                        'debit_amount' => $debit_amount[$i],
                        'credit_amount' => $credit_amount[$i],
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
                AccountTransactionAuto::insert($postData);
            }
        });

        return redirect()->route('admin.order.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            DB::transaction(function () use ($id) {
                $data = Order::onlyTrashed()->findOrFail($id);
                AccountTransactionAuto::withTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->restore();
                $trim = str_replace("STOS", '', $data->invoice);
                $invoice = "STOC" . $trim;
                AccountTransactionAuto::withTrashed()->where('voucher_no', $invoice)->where('voucher_type', 'Retail Collection')->restore();
                $data->restore();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            DB::transaction(function () use ($id) {
                $data = Order::onlyTrashed()->findOrFail($id);
                AccountTransactionAuto::withTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->forceDelete();
                $trim = str_replace("STOS", '', $data->invoice);
                $invoice = "STOC" . $trim;
                AccountTransactionAuto::withTrashed()->where('voucher_no', $invoice)->where('voucher_type', 'Retail Collection')->forceDelete();
                $data->forceDelete();
            });
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        DB::transaction(function () use ($id) {
            $data = Order::findOrFail($id);
            $data->update(['deleted_by' => Auth::user()->id]);
            AccountTransactionAuto::withTrashed()->where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->delete();
            $trim = str_replace("STOS", '', $data->invoice);
            $invoice = "STOC" . $trim;
            AccountTransactionAuto::withTrashed()->where('voucher_no', $invoice)->where('voucher_type', 'Retail Collection')->delete();
            $data->delete();
        });

        return response()->json(['status' => 'success']);
    }
}
