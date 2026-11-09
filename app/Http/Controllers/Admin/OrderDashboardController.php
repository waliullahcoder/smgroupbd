<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountTransactionAuto;
use App\Models\AdminSetting;
use App\Models\CoaSetup;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\DeliveryMan;
use App\Models\ProductSku;
use App\Models\Store;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OrderDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Order::with(['address'])->orderBy('id', 'desc');
            if (Auth::user()->hasRole('Moderator')) {
                $model->where('created_by', Auth::user()->id);
            }
            $model->where(function ($query) {
                $query->whereIn('status', ['Pending', 'Confirmed', 'Processing']);
                if (Auth::user()->hasRole('Store Keeper')) {
                    $query->orWhereIn('status', ['On Route', 'Forward']);
                }
            });
            if (Auth::user()->hasRole('Store Keeper')) {
                $model->whereIn('store_id', Auth::user()->stores);
            }
            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('order_date', function ($row) {
                    return date('d M Y', strtotime($row->date));
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == 'Cancelled') {
                        $status = '<span class="btn btn-xs text-white px-2 bg-danger" style="min-width: 80px;">Cancelled</span>';
                    } elseif ($row->status == 'Successed') {
                        $status = '<span class="btn btn-xs text-white px-2 bg-success" style="min-width: 80px;">Successed</span>';
                    } else {
                        $status = '<a class="btn btn-xs text-white px-2 ';
                        if ($row->status == 'Pending') {
                            $status .= 'bg-primary';
                        } elseif ($row->status == 'Confirmed') {
                            $status .= 'bg-info';
                        } elseif ($row->status == 'Forward') {
                            $status .= 'bg-warning';
                        } elseif ($row->status == 'On Route') {
                            $status .= 'bg-route';
                        } elseif ($row->status == 'Delivered') {
                            $status .= 'bg-delivered';
                        } elseif ($row->status == 'Returned') {
                            $status .= 'bg-danger';
                        }
                        $status .= '" style="min-width: 80px;" href="' . (!Auth::user()->hasRole('Moderator') ? Route('admin.order-dashboard.edit', $row->id) : '') . '">' . $row->status . '</a>';
                    }
                    return $status;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if (Auth::user()->hasRole('Moderator')) {
            $total_orders = Order::where('created_by', Auth::user()->id)->count();
            $success_orders = Order::where('created_by', Auth::user()->id)->where('status', 'Delivered')->count();
            $ranked_products = OrderProduct::with(['order', 'product'])->whereHas('order', function ($query) {
                $query->whereNotIn('status', ['Cancelled']);
            })->groupBy('product_id')->select(['product_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal - discount - return_amount) as total_amount')])->orderBy('total_amount', 'desc')->limit(12)->get();
            return view('admin.order_dashboard.index', compact('total_orders', 'success_orders', 'ranked_products'));
        } else {
            $total_orders = Order::count();
            $success_orders = Order::where('status', 'Delivered')->count();
            $ranked_products = OrderProduct::with(['order', 'product'])->whereHas('order', function ($query) {
                $query->whereNotIn('status', ['Cancelled']);
            })->groupBy('product_id')->select(['product_id', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal - discount - return_amount) as total_amount')])->orderBy('total_amount', 'desc')->limit(12)->get();
            $orders = Order::get();

            $start_date = request('month') ? date('Y-m-01', strtotime(request('month'))) : date('Y-m-01');
            $end_date = request('month') ? date('Y-m-t', strtotime(request('month'))) : date('Y-m-t');
            $product_ids = DB::table('view_liftings')->groupBy('product_id')->pluck('product_id')->toArray();

            $total_purchases = 0;

            foreach ($product_ids as $product_id) {
                $lifting_amount = DB::table('view_liftings')->where('product_id', $product_id)->sum('amount') - DB::table('view_lifting_returns')->where('product_id', $product_id)->sum('amount');
                $lifting_qty = DB::table('view_liftings')->where('product_id', $product_id)->sum('qty') - DB::table('view_lifting_returns')->where('product_id', $product_id)->sum('qty');

                $avarage_rate = $lifting_amount / $lifting_qty;

                $sales_qty = DB::table('view_sales')->where('product_id', $product_id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('qty');
                $sales_returns_qty = DB::table('view_sales_returns')->where('product_id', $product_id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('qty');
                $online_sales_qty = DB::table('view_online_sales')->where('product_id', $product_id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('qty');
                $total_sales_qty = $sales_qty - $sales_returns_qty + $online_sales_qty;

                $total_purchases += $total_sales_qty * $avarage_rate;
            }

            $sales_amount = DB::table('view_sales')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
            $sales_returns_amount = DB::table('view_sales_returns')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
            $online_sales_amount = DB::table('view_online_sales')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
            $total_sales = $sales_amount - $sales_returns_amount + $online_sales_amount;

            $expense_heads = CoaSetup::where('head_code', 'like', '401%')->where('head_code', '!=', '401')->get();
            return view('admin.order_dashboard.index', compact('total_orders', 'success_orders', 'ranked_products', 'orders', 'total_sales', 'total_purchases', 'expense_heads'));
        }
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
    public function show(Request $request, string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if ($request->ajax()) {
            $delivery_men = DeliveryMan::where('store_id', $request->store_id)->where('status', 1)->orderBy('name', 'asc')->get();
            return response()->json(['status' => 'success', 'delivery_men' => $delivery_men]);
        }

        $previousUrl = url()->previous();
        $order = Order::findOrFail($id);
        if (!Auth::user()->hasRole('Moderator') && !Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Admin') && !in_array($order->status, ['Delivered'])) {
            $stores = Store::where('status', 1)->get();
            return view('admin.order_dashboard.change_status', compact('order', 'stores', 'previousUrl'));
        }
        return redirect()->back();
    }

    public static function stock($product_id, $store_id, $product_type = 'Consumer')
    {
        if ($product_type == 'Consumer') {
            $liftings = DB::table('view_liftings')->where('product_type', $product_type ?? 'Consumer')->where('store_id', $store_id)->where('product_id', $product_id)->sum('qty');
            $lifting_returns = DB::table('view_lifting_returns')->where('product_type', $product_type ?? 'Consumer')->where('store_id', $store_id)->where('product_id', $product_id)->sum('qty');
            $sales = DB::table('view_sales')->where('product_type', $product_type ?? 'Consumer')->where('store_id', $store_id)->where('product_id', $product_id)->sum('qty');
            $sales_returns = DB::table('view_sales_returns')->where('product_type', $product_type ?? 'Consumer')->where('store_id', $store_id)->where('product_id', $product_id)->sum('qty');
            $online_sales = DB::table('view_online_sales')->where('product_type', $product_type ?? 'Consumer')->where('store_id', $store_id)->whereIn('status', ['On Route', 'Delivered', 'Collected'])->where('product_id', $product_id)->sum('qty');
            $transfers = DB::table('view_transfers')->where('product_type', $product_type)->where('product_id', $product_id)->where('host_id', $store_id)->sum('qty');
            $receives = DB::table('view_transfers')->where('product_type', $product_type)->where('product_id', $product_id)->where('destination_id', $store_id)->sum('qty');
        }
        if ($product_type == 'Fashion') {
            $liftings = DB::table('view_liftings')->where('product_type', $product_type)->where('store_id', $store_id)->where('sku_id', $product_id)->sum('qty');
            $lifting_returns = DB::table('view_lifting_returns')->where('product_type', $product_type)->where('store_id', $store_id)->where('sku_id', $product_id)->sum('qty');
            $sales = DB::table('view_sales')->where('product_type', $product_type)->where('store_id', $store_id)->where('sku_id', $product_id)->sum('qty');
            $sales_returns = DB::table('view_sales_returns')->where('product_type', $product_type)->where('store_id', $store_id)->where('sku_id', $product_id)->sum('qty');
            $online_sales = DB::table('view_online_sales')->where('product_type', $product_type)->where('store_id', $store_id)->whereIn('status', ['On Route', 'Delivered', 'Collected'])->where('sku_id', $product_id)->sum('qty');
            $transfers = DB::table('view_transfers')->where('product_type', $product_type)->where('sku_id', $product_id)->where('host_id', $store_id)->sum('qty');
            $receives = DB::table('view_transfers')->where('product_type', $product_type)->where('sku_id', $product_id)->where('destination_id', $store_id)->sum('qty');
        }

        return $liftings + $sales_returns + $receives - $lifting_returns - $sales - $online_sales - $transfers;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Order::findOrFail($id);
        if ($request->status == 'Forward') {
            $request->validate([
                'store_id' => 'required',
            ]);
            $data->update(['status' => $request->status, 'store_id' => $request->store_id]);
        }

        if ($request->store_id) {
            $data->update(['store_id' => $request->store_id]);
        }

        if ($request->status == 'Pending') {
            $trim = str_replace("STOS", '', $data->invoice);
            $invoice = "STOC" . $trim;
            AccountTransactionAuto::withTrashed()->where('voucher_no', $invoice)->where('voucher_type', 'Retail Collection')->forceDelete();
            $data->update(['store_id' => NULL, 'status' => $request->status, 'delivery_man_id' => NULL]);
        }

        if ($request->status == 'On Route') {
            $request->validate([
                'delivery_man_id' => 'required',
            ]);

            try {
                DB::transaction(function () use ($request, $data) {
                    foreach ($data->products as $product) {
                        $store_id = $data->store_id;
                        $product_id = $product->variant_id ?? $product->product_id;
                        $stock = $this->stock($product_id, $store_id, $product->product->product_type);
                        $productInfo = Product::find($product->product_id);
                        $variant = ProductSku::find($product->variant_id);
                        if ($product->quantity > $stock) {
                            throw new Exception('stock not available for ' . @$productInfo->name . ' - ' . (@$variant->sku ?? @$productInfo->code));
                        }
                    }
                    $data->update(['status' => $request->status, 'delivery_man_id' => $request->delivery_man_id]);
                });
            } catch (Throwable $caught) {
                if ($caught) {
                    return redirect()->back()->withErrors($caught->getMessage());
                }
            }
        }

        if ($request->delivery_man_id && is_null($request->status)) {
            $data->update(['delivery_man_id' => $request->delivery_man_id]);
        }

        if ($request->status == 'Delivered') {
            $data->update(['status' => $request->status, 'delivered_at' => date('Y-m-d H:i:s')]);
        }

        if ($request->status == 'Cancelled') {
            $data->update(['status' => $request->status, 'canceled_at' => date('Y-m-d H:i:s')]);
        }

        if ($request->collected) {
            DB::transaction(function () use ($request, $data) {
                $admin_setting = AdminSetting::first();
                $client_head = CoaSetup::where('head_type', 'A')->where('head_name', 'Retail Client')->first();
                $cash_head = CoaSetup::where('head_type', 'A')->where('head_code', '1010201')->first();

                if (@$admin_setting->accounting == 1) {
                    $headCode = collect([
                        '0' => $cash_head->head_code,
                        '1' => $client_head->head_code
                    ]);

                    $debit_amount = collect([
                        '0' => $data->due,
                        '1' => 0.00
                    ]);

                    $credit_amount = collect([
                        '0' => 0.00,
                        '1' => $data->due,
                    ]);

                    $trim = str_replace("STOS", '', $data->invoice);
                    $invoice = "STOC" . $trim;

                    $countHead = count($headCode);
                    $postData = [];
                    for ($i = 0; $i < $countHead; $i++) {
                        $coa = CoaSetup::where('company_id', Auth::user()->company_id ?? 1)->where('head_code', $headCode[$i])->first();
                        $postData[] = [
                            'company_id' => Auth::user()->company_id ?? 1,
                            'voucher_no' => $invoice,
                            'voucher_type' => "Retail Collection",
                            'voucher_date' => date('Y-m-d', strtotime($data->date)),
                            'coa_setup_id' => $coa->id,
                            'coa_head_code' => $headCode[$i],
                            'narration' => 'Retail Collection Against PAYMENT NO - ' . $invoice,
                            'debit_amount' => $debit_amount[$i],
                            'credit_amount' => $credit_amount[$i],
                            'created_by' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    AccountTransactionAuto::insert($postData);
                }

                $data->update(['collected' => $request->collected, 'status' => 'Collected', 'collected_at' => date('Y-m-d', strtotime($request->collected_at))]);
            });
        }

        $sales_voucher = AccountTransactionAuto::where('voucher_no', $data->invoice)->where('voucher_type', 'Retail Sales')->first();

        $admin_setting = AdminSetting::first();
        if (@$admin_setting->accounting == 1 && is_null($sales_voucher)) {
            $client_head = CoaSetup::where('head_type', 'A')->where('head_name', 'Retail Client')->first();
            $income_head = CoaSetup::where('head_type', 'I')->where('head_name', 'Retail Sale')->first();
            $headCode = collect([
                '0' => $client_head->head_code,
                '1' => $income_head->head_code,
            ]);

            $debit_amount = collect([
                '0' => $data->total - $data->discount,
                '1' => 0.00
            ]);

            $credit_amount = collect([
                '0' => 0.00,
                '1' => $data->total - $data->discount,
            ]);

            $countHead = count($headCode);
            $postData = [];
            for ($i = 0; $i < $countHead; $i++) {
                $coa = CoaSetup::where('company_id', (Auth::user()->company_id ?? 1))->where('head_code', $headCode[$i])->first();
                $postData[] = [
                    'company_id' => Auth::user()->company_id ?? 1,
                    'voucher_no' => $data->invoice,
                    'voucher_type' => "Retail Sales",
                    'voucher_date' => date('Y-m-d', strtotime($data->date)),
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

        if ($request->prev_url) {
            return redirect($request->prev_url)->withSuccessMessage('Status Updated Successfully!');
        }
        return redirect()->route('admin.dashboard')->withSuccessMessage('Status Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
