<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Invest;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Store;
use App\Models\Wallet;
use App\Services\Statement\Product\ProductStatement;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function ProductStatement(Request $request)
    {
        if ($request->ajax() && $request->has('get_variants')) {
            $variants = ProductSku::where('product_id', $request->product_id)->get();
            return response()->json(['status' => 'success', 'variants' => $variants]);
        }

        if ($request->ajax()) {
            $productIds = Invest::where('investor_id', Auth::user()->investor->id)->where('sattled', 0)->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $productIds)->where('status', 1)->where('product_type', $request->product_type)->orderBy('name', 'asc')->get();
            return response()->json(['status' => 'success', 'products' => $products]);
        }

        $product_id = $request->product_id;
        $variant_id = $request->variant_id;
        $date_range = explode('to', $request->date_range);
        $start_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');

        if ($request->store_id) {
            $store_id = [$request->store_id];
        } else {
            $store_id = Store::where('status', 1)->get(['id'])->pluck('id')->toArray();
        }

        $data = [
            'opening' => 0,
            'statements' => [],
        ];

        if ($request->has('filter')) {
            if ($request->product_type == 'Consumer' || is_null($request->product_type)) {
                $product = Product::findOrFail($product_id);
                $previousBalance = ProductStatement::previousBalance($start_date, $product_id, $store_id, $request->product_type);
                $statements = ProductStatement::Statement($start_date, $end_date, $product_id, $store_id, $previousBalance, $request->product_type);
                $data = [
                    'product' => $product,
                    'opening' => $previousBalance,
                    'statements' => $statements,
                ];
            } else {
                $variant = ProductSku::with('product')->findOrFail($variant_id);
                $previousBalance = ProductStatement::previousBalance($start_date, $variant_id, $store_id, $request->product_type);
                $statements = ProductStatement::Statement($start_date, $end_date, $variant_id, $store_id, $previousBalance, $request->product_type);
                $data = [
                    'variant' => $variant,
                    'opening' => $previousBalance,
                    'statements' => $statements,
                ];
            }
        }

        if (!is_null($request->print)) {
            if (Auth::user()->company_id) {
                $company = Company::find(Auth::user()->company_id);
                $title = $company->name;
                $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
            } else {
                $title = 'Company Name Goes Here.';
                $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
            }
            $report_title = 'Product Statement Report <br> <span class="text-sm">' . date('d-m-Y', strtotime($start_date)) . ' To ' . date('d-m-Y', strtotime($end_date)) . '</span>';
            // return view('investor.reports.product_statement.print', compact('title', 'informations', 'report_title', 'data'));
            $pdf = Pdf::loadView('investor.reports.product_statement.print', compact('title', 'informations', 'report_title', 'data'));
            return $pdf->stream('product_statement_' . date('d_m_Y_H_i_s') . '.pdf');
        }

        $title = 'Product Statement';
        $productIds = Invest::where('investor_id', Auth::user()->investor->id)->where('sattled', 0)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->where('status', 1)->where('product_type', $request->product_type ?? 'Consumer')->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $store_id = $request->store_id;
        $filter_link = Route('investor.product-statement.index');
        return view('investor.reports.product_statement.index', compact('title', 'filter_link', 'stores', 'products', 'data', 'store_id', 'product_id', 'start_date', 'end_date'));
    }

    public function productWiseProfit(Request $request)
    {
        $product_id = $request->product_id;
        $date_range = explode('to', $request->date_range);
        $start_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');

        $data = [];
        if ($request->has('filter')) {
            $productIds = Invest::where('investor_id', Auth::user()->investor->id)->where('sattled', 0)->pluck('product_id')->toArray();
            $query = DB::table('view_liftings')->whereNotNull('date')->whereIn('product_id', $productIds)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date);
            $company_id = Auth::user()->company_id;
            if ($company_id) {
                $query->where('company_id', $company_id);
            }
            if ($product_id) {
                $query->whereIn('product_id', $product_id);
            }
            $searched_products = $query->groupBy('product_id')->orderBy('name', 'asc')->get(['product_id', 'shared_profit', 'name', 'code', 'attribute_name', 'category_name']);
            $product_ids = $searched_products->pluck('product_id')->toArray();

            $liftings = DB::table('view_liftings')->whereNotNull('date')->whereIn('product_id', $product_ids)->orderBy('name', 'asc')->get();
            $lifting_returns = DB::table('view_lifting_returns')->whereNotNull('date')->whereIn('product_id', $product_ids)->get();
            $sales = DB::table('view_sales')->whereNotNull('date')->whereIn('product_id', $product_ids)->get();
            $online_sales = DB::table('view_online_sales')->whereNotNull('store_id')->whereIn('product_id', $product_ids)->get();
            $sales_returns = DB::table('view_sales_returns')->whereNotNull('date')->whereIn('product_id', $product_ids)->get();

            $data = [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'searched_products' => $searched_products,
                'liftings' => $liftings,
                'lifting_returns' => $lifting_returns,
                'sales' => $sales,
                'sales_returns' => $sales_returns,
                'online_sales' => $online_sales,
            ];
        }

        if (!is_null($request->print)) {
            if (Auth::user()->company_id) {
                $company = Company::find(Auth::user()->company_id);
                $title = $company->name;
                $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
            } else {
                $title = 'Company Name Goes Here.';
                $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
            }

            $report_title = 'Investment Profit';
            // return view('investor.reports.product_wise_profit.print', compact('title', 'informations', 'report_title', 'data'));
            $pdf = Pdf::loadView('investor.reports.product_wise_profit.print', compact('title', 'informations', 'report_title', 'data'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('product_wise_profit_' . date('d_m_Y_h_i_s') . '.pdf');
        }

        $title = 'Investment Profit';
        $filter_link = Route('investor.product-wise-profit.index');
        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();
        $productIds = Invest::where('investor_id', Auth::user()->investor->id)->where('sattled', 0)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)->where('status', 1)->where('product_type', $request->product_type ?? 'Consumer')->orderBy('name', 'asc')->get();
        return view('investor.reports.product_wise_profit.index', compact('title', 'filter_link', 'categories', 'products', 'product_id', 'data', 'start_date', 'end_date'));
    }

    public function statement(Request $request)
    {
        $previous_balance = 0;
        $data = [];
        if ($request->has('filter')) {
            $date_range = explode('to', $request->date_range);
            $start_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
            $end_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
            $previous_balance = Wallet::where('investor_id', Auth::user()->investor->id)->where('date', '<', $start_date)->sum(DB::raw('amount_in - amount_out'));
            $data = Wallet::where('investor_id', Auth::user()->investor->id)->where('date', '>=', $start_date)->where('date', '<=', $end_date)->get();
        }

        if (!is_null($request->print)) {
            if (Auth::user()->company_id) {
                $company = Company::find(Auth::user()->company_id);
                $title = $company->name;
                $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
            } else {
                $title = 'Company Name Goes Here.';
                $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
            }

            $report_title = 'Investment Register';
            $pdf = Pdf::loadView('investor.reports.statement.print', compact('title', 'informations', 'report_title', 'previous_balance', 'data'));
            return $pdf->stream('statement_' . date('d_m_Y_H_i_s') . '.pdf');
        }

        $title = 'Investor Statement';
        $filter_link = Route('investor.statement.index');
        return view('investor.reports.statement.index', compact('title', 'filter_link', 'previous_balance', 'data'));
    }

    public function productStatus(Request $request)
    {
        $category_id = $request->category_id;
        $product_id = $request->product_id;
        $date_range = explode('to', $request->date_range);
        $start_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        if ($request->store_id) {
            $store_id = $request->store_id;
            $selected_stores = Store::where('status', 1)->whereIn('id', $store_id)->get(['name']);
        } else {
            $store_id = Store::where('status', 1)->get(['id'])->pluck('id')->toArray();
            $selected_stores = [];
        }

        $data = [];
        if ($request->has('filter')) {
            $productIds = Invest::where('investor_id', Auth::user()->investor->id)->where('sattled', 0)->pluck('product_id')->toArray();
            $query = DB::table('view_liftings')->whereNotNull('date');
            $company_id = Auth::user()->company_id;
            if ($company_id) {
                $query->where('company_id', $company_id);
            }
            if ($product_id) {
                $query->whereIn('product_id', $product_id);
            } else {
                $query->whereIn('product_id', $productIds);
            }

            if ($request->product_type == 'Consumer' || is_null($request->product_type)) {
                $searched_products = $query->groupBy('product_id')->orderBy('name', 'asc')->get(['product_id', 'name', 'code', 'attribute_name']);
                $product_ids = $searched_products->pluck('product_id')->toArray();
                $liftings = DB::table('view_liftings')->where('product_type', $request->product_type ?? 'Consumer')->whereIn('store_id', $store_id)->whereIn('product_id', $product_ids)->get();
                $lifting_returns = DB::table('view_lifting_returns')->where('product_type', $request->product_type ?? 'Consumer')->whereIn('store_id', $store_id)->whereIn('product_id', $product_ids)->get();
                $sales = DB::table('view_sales')->where('product_type', $request->product_type ?? 'Consumer')->whereIn('store_id', $store_id)->whereIn('product_id', $product_ids)->get();
                $sales_returns = DB::table('view_sales_returns')->where('product_type', $request->product_type ?? 'Consumer')->whereIn('store_id', $store_id)->whereIn('product_id', $product_ids)->get();
                $online_sales = DB::table('view_online_sales')->where('product_type', $request->product_type ?? 'Consumer')->whereIn('store_id', $store_id)->whereIn('product_id', $product_ids)->get();
                $transfer_or_receives = DB::table('view_transfers')->where('product_type', $request->product_type ?? 'Consumer')->whereIn('product_id', $product_ids)->get();
            }
            if ($request->product_type == 'Fashion') {
                $searched_products = $query->whereNotNull('sku_id')->groupBy('sku_id')->orderBy('name', 'asc')->get(['product_id', 'sku_id', 'sku', 'name']);
                $sku_ids = $searched_products->pluck('sku_id')->toArray();

                $liftings = DB::table('view_liftings')->where('product_type', $request->product_type)->whereIn('store_id', $store_id)->whereIn('sku_id', $sku_ids)->get();
                $lifting_returns = DB::table('view_lifting_returns')->where('product_type', $request->product_type)->whereIn('store_id', $store_id)->whereIn('sku_id', $sku_ids)->get();
                $sales = DB::table('view_sales')->where('product_type', $request->product_type)->whereIn('store_id', $store_id)->whereIn('sku_id', $sku_ids)->get();
                $sales_returns = DB::table('view_sales_returns')->where('product_type', $request->product_type)->whereIn('store_id', $store_id)->whereIn('sku_id', $sku_ids)->get();
                $online_sales = DB::table('view_online_sales')->where('product_type', $request->product_type)->whereIn('store_id', $store_id)->whereIn('sku_id', $sku_ids)->get();
                $transfer_or_receives = DB::table('view_transfers')->where('product_type', $request->product_type)->whereIn('sku_id', $sku_ids)->get();
            }

            $data = [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'store_id' => $store_id,
                'searched_products' => $searched_products,
                'liftings' => $liftings,
                'lifting_returns' => $lifting_returns,
                'sales' => $sales,
                'sales_returns' => $sales_returns,
                'online_sales' => $online_sales,
                'transfer_or_receives' => $transfer_or_receives,
            ];
        }


        if (!is_null($request->print)) {
            if (Auth::user()->company_id) {
                $company = Company::find(Auth::user()->company_id);
                $title = $company->name;
                $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
            } else {
                $title = 'Company Name Goes Here.';
                $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
            }
            if (count($selected_stores) > 0) {
                $string = '';
                foreach ($selected_stores as $key => $store_item) {
                    $string .= $store_item->name;
                    if ($key > 0) {
                        $string .= ', ';
                    }
                }
                $report_title = 'Product Status (' . $string . ') <br> <span class="text-sm">' . date('d-m-Y', strtotime($start_date)) . ' To ' . date('d-m-Y', strtotime($end_date)) . '</span>';
            } else {
                $report_title = 'Product Status (ALL) <br> <span class="text-sm">' . date('d-m-Y', strtotime($start_date)) . ' To ' . date('d-m-Y', strtotime($end_date)) . '</span>';
            }
            // return view('investor.reports.product_status.print', compact('title', 'informations', 'report_title', 'data'));
            $pdf = Pdf::loadView('investor.reports.product_status.print', compact('title', 'informations', 'report_title', 'data'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('product_status_' . date('d_m_Y_H_i_s') . '.pdf');
        }

        $title = 'Product Status';
        $productIds = Invest::where('investor_id', Auth::user()->investor->id)->where('sattled', 0)->pluck('product_id')->toArray();
        $query = Product::whereIn('id', $productIds)->where('status', 1);
        $query->where('product_type', $request->product_type ?? 'Consumer');
        $products = $query->orderBy('name', 'asc')->get();
        $stores = Store::where('status', 1)->get();
        $filter_link = Route('investor.product-status.index');
        return view('investor.reports.product_status.index', compact('title', 'filter_link', 'stores', 'products', 'data', 'start_date', 'end_date'));
    }

    public function investmentProfit(Request $request)
    {
    }
}
