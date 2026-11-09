<?php

namespace App\Services\Statement\Product;

use App\Models\Lifting;
use App\Models\LiftingProduct;
use App\Models\LiftingReturn;
use App\Models\LiftingReturnList;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\RetailReturn;
use App\Models\RetailSale;
use App\Models\Sales;
use App\Models\SalesList;
use App\Models\SalesReturn;
use App\Models\SalesReturnList;
use App\Models\Transfer;
use App\Models\TransferProduct;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class ProductStatement
{
    public static function previousBalance($start_date, $product_id, $store_id, $product_type)
    {
        if ($product_type == 'Consumer' || is_null($product_type)) {
            $liftings = LiftingProduct::with('lifting')->whereHas('lifting', function ($query) use ($start_date, $store_id) {
                $query->where('lifting_date', '<', $start_date)->whereIn('store_id', $store_id);
            })->where('product_id', $product_id)->sum('qty');

            $lifting_returns = LiftingReturnList::with('return')->whereHas('return', function ($query) use ($start_date, $store_id) {
                $query->where('date', '<', $start_date)->whereIn('store_id', $store_id);
            })->where('product_id', $product_id)->sum('qty');

            $sales = SalesList::with('sales')->whereHas('sales', function ($query) use ($start_date, $store_id) {
                $query->where('date', '<', $start_date)->whereIn('store_id', $store_id);
            })->where('product_id', $product_id)->sum('qty');

            $orders = OrderProduct::with('order')->whereHas('order', function ($query) use ($start_date, $store_id) {
                $query->where('date', '<', $start_date)->whereIn('store_id', $store_id)->whereIn('status', ['On Route', 'Delivered', 'Collected']);
            })->where('product_id', $product_id)->sum('quantity');

            $sales_returns = SalesReturnList::with('return')->whereHas('return', function ($query) use ($start_date, $store_id) {
                $query->where('date', '<', $start_date)->whereIn('store_id', $store_id);
            })->where('product_id', $product_id)->sum('qty');

            if (count($store_id) == 1) {
                $transfers = DB::table('view_transfers')->where('product_id', $product_id)->where('date', '<', $start_date)->whereIn('host_id', $store_id)->sum('qty');
                $receives = DB::table('view_transfers')->where('product_id', $product_id)->where('date', '<', $start_date)->whereIn('destination_id', $store_id)->sum('qty');
                return $liftings + $sales_returns + $receives - $lifting_returns - $sales - $orders - $transfers;
            }
            return $liftings + $sales_returns - $lifting_returns - $sales - $orders;
        } else {
            $liftings = LiftingProduct::with('lifting')->whereHas('lifting', function ($query) use ($start_date, $store_id) {
                $query->where('lifting_date', '<', $start_date)->whereIn('store_id', $store_id);
            })->where('variant_id', $product_id)->sum('qty');

            $lifting_returns = LiftingReturnList::with('return')->whereHas('return', function ($query) use ($start_date, $store_id) {
                $query->where('date', '<', $start_date)->whereIn('store_id', $store_id);
            })->where('variant_id', $product_id)->sum('qty');

            $sales = 0;
            $sales_returns = 0;

            if (count($store_id) == 1) {
                $transfers = TransferProduct::with('transfer')->whereHas('transfer', function ($query) use ($start_date, $store_id) {
                    $query->where('date', '<', $start_date)->whereIn('host_id', $store_id)->where('reject', 0);
                })->where('variant_id', $product_id)->sum('qty');

                $receives = TransferProduct::with('transfer')->whereHas('transfer', function ($query) use ($start_date, $store_id) {
                    $query->where('date', '<', $start_date)->whereIn('destination_id', $store_id)->where('reject', 0);
                })->where('variant_id', $product_id)->sum('qty');

                return $liftings + $sales_returns + $receives - $lifting_returns - $sales - $transfers;
            }
            return $liftings + $sales_returns - $lifting_returns - $sales;
        }
    }

    public static function Statement($start_date, $end_date, $product_id, $store_id, $previousBalance, $product_type)
    {
        $balance = $previousBalance;
        $dateRange = CarbonPeriod::create($start_date, $end_date);
        $statements = [];
        if ($product_type == 'Consumer' || is_null($product_type)) {
            foreach ($dateRange as $date) {
                $lineData = [
                    'date' => date('Y-m-d', strtotime($date)),
                ];
                $date = date('Y-m-d', strtotime($date));

                $liftings = Lifting::with('products')->whereHas('products', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('lifting_date', $date)->whereIn('store_id', $store_id)->get();
                foreach ($liftings as $lifting) {
                    $qty = $lifting->products->where('product_id', $product_id)->sum('qty');
                    $balance += $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $lifting->lifting_no . ' From Product Purchase';
                    $ld['stock_in'] = number_format($qty, 2, '.', '');
                    $ld['stock_out'] = 0.00;
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $lifting_returns = LiftingReturn::with('list')->whereHas('list', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->get();
                foreach ($lifting_returns as $lifting_return) {
                    $qty = $lifting_return->list->where('product_id', $product_id)->sum('qty');
                    $balance -= $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $lifting_return->return_no . ' From Purchase Return';
                    $ld['stock_in'] = 0.00;
                    $ld['stock_out'] = number_format($qty, 2, '.', '');
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $sales = Sales::with('list')->whereHas('list', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->get();
                foreach ($sales as $sale) {
                    $qty = $sale->list->where('product_id', $product_id)->sum('qty');
                    $balance -= $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $sale->invoice . ' From Daily Invoice';
                    $ld['stock_in'] = 0.00;
                    $ld['stock_out'] = number_format($qty, 2, '.', '');
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $orders = Order::with('products')->whereHas('products', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->whereIn('status', ['On Route', 'Delivered', 'Collected', 'Cancelled'])->get();
                foreach ($orders as $order) {
                    $qty = $order->products->where('product_id', $product_id)->sum('quantity');
                    $balance -= $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Order No - ' . $order->invoice . ' From Online Order, Customer Name ' . $order->user_name . ', Customer Phone ' . $order->user_phone;
                    $ld['stock_in'] = 0.00;
                    $ld['stock_out'] = number_format($qty, 2, '.', '');
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $cancelledOrders = Order::with('products')->whereHas('products', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->whereIn('status', ['Cancelled'])->get();
                foreach ($cancelledOrders as $order) {
                    $qty = $order->products->where('product_id', $product_id)->sum('quantity');
                    $balance += $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Cancel Order - ' . $order->invoice . ' From Online Order, Customer Name ' . $order->user_name . ', Customer Phone ' . $order->user_phone;
                    $ld['stock_in'] = number_format($qty, 2, '.', '');
                    $ld['stock_out'] = 0.00;
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $sales_returns = SalesReturn::with('list')->whereHas('list', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->where('approve', 1)->get();
                foreach ($sales_returns as $sales_return) {
                    $qty = $sales_return->list->where('product_id', $product_id)->sum('qty');
                    $balance += $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $sales_return->return_no . ' From Sales Return';
                    $ld['stock_in'] = number_format($qty, 2, '.', '');
                    $ld['stock_out'] = 0.00;
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $retailSales = RetailSale::with('list')->whereHas('list', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->get();
                foreach ($retailSales as $retailSale) {
                    $qty = $retailSale->list->where('product_id', $product_id)->sum('qty');
                    $balance -= $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $retailSale->invoice . ' From Retail Sales';
                    $ld['stock_in'] = 0.00;
                    $ld['stock_out'] = number_format($qty, 2, '.', '');
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $retailRetuns = RetailReturn::with('list')->whereHas('list', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->get();
                foreach ($retailRetuns as $retailReturn) {
                    $qty = $retailReturn->list->where('product_id', $product_id)->sum('qty');
                    $balance += $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $retailReturn->return_no . ' From Retail Return';
                    $ld['stock_in'] = number_format($qty, 2, '.', '');
                    $ld['stock_out'] = 0.00;
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                if (count($store_id) == 1) {
                    $transfers = Transfer::with('list')->whereHas('list', function ($query) use ($product_id) {
                        $query->where('product_id', $product_id);
                    })->where('date', $date)->whereIn('host_id', $store_id)->where('reject', 0)->get();
                    foreach ($transfers as $transfer) {
                        $qty = $transfer->list->where('product_id', $product_id)->sum('qty');
                        $balance -= $qty;
                        $ld = $lineData;
                        $ld['particulars'] = 'Voucher No - ' . $transfer->transfer_no . ' From Transfer Product';
                        $ld['stock_in'] = 0.00;
                        $ld['stock_out'] = number_format($qty, 2, '.', '');
                        $ld['balance'] = number_format($balance, 2, '.', '');
                        array_push($statements, $ld);
                    }

                    $receives = Transfer::with('list')->whereHas('list', function ($query) use ($product_id) {
                        $query->where('product_id', $product_id);
                    })->where('date', $date)->whereIn('destination_id', $store_id)->where('reject', 0)->get();
                    foreach ($receives as $receive) {
                        $qty = $receive->list->where('product_id', $product_id)->sum('qty');
                        $balance += $qty;
                        $ld = $lineData;
                        $ld['particulars'] = 'Voucher No - ' . $receive->transfer_no . ' From Recieve Product';
                        $ld['stock_in'] = number_format($qty, 2, '.', '');
                        $ld['stock_out'] = 0.00;
                        $ld['balance'] = number_format($balance, 2, '.', '');
                        array_push($statements, $ld);
                    }
                }
            }
        } else {
            foreach ($dateRange as $date) {
                $lineData = [
                    'date' => date('Y-m-d', strtotime($date)),
                ];
                $date = date('Y-m-d', strtotime($date));

                $liftings = Lifting::with('products')->whereHas('products', function ($query) use ($product_id) {
                    $query->where('variant_id', $product_id);
                })->where('lifting_date', $date)->whereIn('store_id', $store_id)->get();

                foreach ($liftings as $lifting) {
                    $qty = $lifting->products->where('variant_id', $product_id)->sum('qty');
                    $balance += $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $lifting->lifting_no . ' From Product Purchase';
                    $ld['stock_in'] = number_format($qty, 2, '.', '');
                    $ld['stock_out'] = 0.00;
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $lifting_returns = LiftingReturn::with('list')->whereHas('list', function ($query) use ($product_id) {
                    $query->where('variant_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->get();
                foreach ($lifting_returns as $lifting_return) {
                    $qty = $lifting_return->list->where('variant_id', $product_id)->sum('qty');
                    $balance -= $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $lifting_return->return_no . ' From Purchase Return';
                    $ld['stock_in'] = 0.00;
                    $ld['stock_out'] = number_format($qty, 2, '.', '');
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $retailSales = RetailSale::with('list')->whereHas('list', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->get();
                foreach ($retailSales as $retailSale) {
                    $qty = $retailSale->list->where('product_id', $product_id)->sum('qty');
                    $balance -= $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $retailSale->invoice . ' From Retail Sales';
                    $ld['stock_in'] = 0.00;
                    $ld['stock_out'] = number_format($qty, 2, '.', '');
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                $retailRetuns = RetailReturn::with('list')->whereHas('list', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })->where('date', $date)->whereIn('store_id', $store_id)->get();
                foreach ($retailRetuns as $retailReturn) {
                    $qty = $retailReturn->list->where('product_id', $product_id)->sum('qty');
                    $balance += $qty;
                    $ld = $lineData;
                    $ld['particulars'] = 'Voucher No - ' . $retailReturn->return_no . ' From Retail Return';
                    $ld['stock_in'] = number_format($qty, 2, '.', '');
                    $ld['stock_out'] = 0.00;
                    $ld['balance'] = number_format($balance, 2, '.', '');
                    array_push($statements, $ld);
                }

                // $sales = Sales::with('list')->whereHas('list', function ($query) use ($product_id) {
                //     $query->where('product_id', $product_id);
                // })->where('date', $date)->whereIn('store_id', $store_id)->get();
                // foreach ($sales as $sale) {
                //     $qty = $sale->list->where('product_id', $product_id)->sum('qty');
                //     $balance -= $qty;
                //     $ld = $lineData;
                //     $ld['particulars'] = 'Voucher No - ' . $sale->invoice . ' From Daily Invoice';
                //     $ld['stock_in'] = 0.00;
                //     $ld['stock_out'] = number_format($qty, 2, '.', '');
                //     $ld['balance'] = number_format($balance, 2, '.', '');
                //     array_push($statements, $ld);
                // }

                // $sales_returns = SalesReturn::with('list')->whereHas('list', function ($query) use ($product_id) {
                //     $query->where('product_id', $product_id);
                // })->where('date', $date)->whereIn('store_id', $store_id)->where('approve', 1)->get();
                // foreach ($sales_returns as $sales_return) {
                //     $qty = $sales_return->list->where('product_id', $product_id)->sum('qty');
                //     $balance += $qty;
                //     $ld = $lineData;
                //     $ld['particulars'] = 'Voucher No - ' . $sales_return->return_no . ' From Sales Return';
                //     $ld['stock_in'] = number_format($qty, 2, '.', '');
                //     $ld['stock_out'] = 0.00;
                //     $ld['balance'] = number_format($balance, 2, '.', '');
                //     array_push($statements, $ld);
                // }

                if (count($store_id) == 1) {
                    $transfers = Transfer::with('list')->whereHas('list', function ($query) use ($product_id) {
                        $query->where('variant_id', $product_id);
                    })->where('date', $date)->whereIn('host_id', $store_id)->where('reject', 0)->get();
                    foreach ($transfers as $transfer) {
                        $qty = $transfer->list->where('variant_id', $product_id)->sum('qty');
                        $balance -= $qty;
                        $ld = $lineData;
                        $ld['particulars'] = 'Voucher No - ' . $transfer->transfer_no . ' From Transfer Product';
                        $ld['stock_in'] = 0.00;
                        $ld['stock_out'] = number_format($qty, 2, '.', '');
                        $ld['balance'] = number_format($balance, 2, '.', '');
                        array_push($statements, $ld);
                    }

                    $receives = Transfer::with('list')->whereHas('list', function ($query) use ($product_id) {
                        $query->where('variant_id', $product_id);
                    })->where('date', $date)->whereIn('destination_id', $store_id)->where('reject', 0)->get();
                    foreach ($receives as $receive) {
                        $qty = $receive->list->where('variant_id', $product_id)->sum('qty');
                        $balance += $qty;
                        $ld = $lineData;
                        $ld['particulars'] = 'Voucher No - ' . $receive->transfer_no . ' From Recieve Product';
                        $ld['stock_in'] = number_format($qty, 2, '.', '');
                        $ld['stock_out'] = 0.00;
                        $ld['balance'] = number_format($balance, 2, '.', '');
                        array_push($statements, $ld);
                    }
                }
            }
        }
        return $statements;
    }
}
