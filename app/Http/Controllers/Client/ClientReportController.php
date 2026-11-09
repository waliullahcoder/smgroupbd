<?php

namespace App\Http\Controllers\Client;

use App\DataTables\PaymentLogDataTable;
use App\DataTables\PurchaseLogDataTable;
use App\DataTables\ReturnLogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Collection;
use App\Models\Company;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesReturn;
use App\Models\SalesReturnList;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientReportController extends Controller
{
    public function purchaseLog(Request $request, PurchaseLogDataTable $dataTable)
    {
        if ($request->ajax() && $request->has('get_products')) {
            $category_id = $request->category_id;
            $query = Product::where('status', 1);
            if ($category_id) {
                $query->whereIn('category_id', $category_id);
            }
            $products = $query->orderBy('name', 'asc')->get();
            return response()->json(['status' => 'success', 'products' => $products]);
        }

        if ($request->has('print')) {
            if (Auth::user()->company_id) {
                $company = Company::find(Auth::user()->company_id);
                $title = $company->name;
                $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
            } else {
                $title = 'Company Name Goes Here.';
                $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
            }

            $query = Sales::with(['list', 'list.product']);
            $client_id = Auth::user()->client->id;
            $query->where('client_id', $client_id);

            $date_range = explode('to', $request->date_range);
            $start_date = isset($date_range[0]) ? date('Y-m-d', strtotime($date_range[0])) : NULL;
            $end_date = isset($date_range[1]) ? date('Y-m-d', strtotime($date_range[1])) : NULL;
            $product_id = $request->product_id;
            $category_id = $request->category_id;
            if (!is_null($request->product_id)) {
                $query->whereHas('list', function ($squery) use ($product_id) {
                    $squery->whereIn('product_id', $product_id);
                });
            }
            if (!is_null($request->category_id)) {
                $query->whereHas('list.product', function ($squery) use ($category_id) {
                    $squery->whereIn('category_id', $category_id);
                });
            }
            if (!is_null($start_date) && !is_null($end_date)) {
                $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
            } else {
                $start_date = date('Y-m-01');
                $end_date = date('Y-m-t');
                $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
            }
            $data = $query->get();

            $report_title = 'Purchase Log On ' . date('d-m-Y', strtotime($start_date)) . ' To ' . date('d-m-Y', strtotime($end_date));
            // return view('client.reports.purchase_log.print', compact('title', 'informations', 'report_title', 'data', 'start_date', 'end_date'));
            $pdf = Pdf::loadView('client.reports.purchase_log.print', compact('title', 'informations', 'report_title', 'data', 'start_date', 'end_date'));
            return $pdf->stream('purchase_log_' . date('d_m_Y_H_i_s') . '.pdf');
        }

        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        $title = 'Purchase Log';
        return $dataTable->render('client.reports.purchase_log.index', compact('title', 'categories', 'products'));
    }

    public function returnLog(Request $request, ReturnLogDataTable $dataTable)
    {
        if ($request->ajax() && $request->has('get_products')) {
            $category_id = $request->category_id;
            $query = Product::where('status', 1);
            if ($category_id) {
                $query->whereIn('category_id', $category_id);
            }
            $products = $query->orderBy('name', 'asc')->get();
            return response()->json(['status' => 'success', 'products' => $products]);
        }

        if ($request->has('print')) {
            if (Auth::user()->company_id) {
                $company = Company::find(Auth::user()->company_id);
                $title = $company->name;
                $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
            } else {
                $title = 'Company Name Goes Here.';
                $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
            }

            $query = SalesReturnList::with(['return', 'product']);
            $client_id = Auth::user()->client->id;
            $query->where('client_id', $client_id);

            $category_id = request('category_id');
            $product_id = request('product_id');
            $date_range = explode('to', request('date_range'));
            $start_date = isset($date_range[0]) ? date('Y-m-d', strtotime($date_range[0])) : NULL;
            $end_date = isset($date_range[1]) ? date('Y-m-d', strtotime($date_range[1])) : NULL;
            if (!is_null($request->category_id)) {
                $query->whereHas('product', function ($squery) use ($category_id) {
                    $squery->whereIn('category_id', $category_id);
                });
            }
            if (!is_null($request->product_id)) {
                $query->whereIn('product_id', $product_id);
            }
            if (!is_null($start_date) && !is_null($end_date)) {
                $query->whereHas('return', function ($q) use ($start_date, $end_date) {
                    $q->where('approve', 1)->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                });
            } else {
                $start_date = date('Y-m-01');
                $end_date = date('Y-m-t');
                $query->whereHas('return', function ($q) use ($start_date, $end_date) {
                    $q->where('approve', 1)->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                });
            }
            $data = $query->get();

            $report_title = 'Return Log On ' . date('d-m-Y', strtotime($start_date)) . ' To ' . date('d-m-Y', strtotime($end_date));
            return view('client.reports.return_log.print', compact('title', 'informations', 'report_title', 'data', 'start_date', 'end_date'));
            $pdf = Pdf::loadView('client.reports.return_log.print', compact('title', 'informations', 'report_title', 'data', 'start_date', 'end_date'));
            return $pdf->stream('return_log_' . date('d_m_Y_H_i_s') . '.pdf');
        }

        $categories = Category::where('status', 1)->orderBy('name', 'asc')->get();
        $products = Product::where('status', 1)->orderBy('name', 'asc')->get();
        $title = 'Return Log';
        return $dataTable->render('client.reports.return_log.index', compact('title', 'categories', 'products'));
    }

    public function paymentLog(Request $request, PaymentLogDataTable $dataTable)
    {
        if ($request->has('print')) {
            if (Auth::user()->company_id) {
                $company = Company::find(Auth::user()->company_id);
                $title = $company->name;
                $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
            } else {
                $title = 'Company Name Goes Here.';
                $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
            }

            $client_id = Auth::user()->client->id;
            $query = Collection::where('client_id', $client_id);

            $collection_type = request('collection_type');
            $date_range = explode('to', request('date_range'));
            $start_date = isset($date_range[0]) ? date('Y-m-d', strtotime($date_range[0])) : NULL;
            $end_date = isset($date_range[1]) ? date('Y-m-d', strtotime($date_range[1])) : NULL;

            if (!empty($collection_type)) {
                $query->where('collection_type', $collection_type);
            }
            if (!is_null($start_date) && !is_null($end_date)) {
                $query->where('payment_date', '>=', $start_date)->where('payment_date', '<=', $end_date);
            } else {
                $start_date = date('Y-m-01');
                $end_date = date('Y-m-t');
                $query->where('payment_date', '>=', $start_date)->where('payment_date', '<=', $end_date);
            }
            $data = $query->orderBy('payment_date', 'desc');

            $report_title = 'Payment Log On ' . date('d-m-Y', strtotime($start_date)) . ' To ' . date('d-m-Y', strtotime($end_date));
            return view('client.reports.payment_log.print', compact('title', 'informations', 'report_title', 'data', 'start_date', 'end_date'));
            $pdf = Pdf::loadView('client.reports.payment_log.print', compact('title', 'informations', 'report_title', 'data', 'start_date', 'end_date'));
            return $pdf->stream('payment_log_' . date('d_m_Y_H_i_s') . '.pdf');
        }

        $title = 'Payment Log';
        return $dataTable->render('client.reports.payment_log.index', compact('title'));
    }

    public function statement(Request $request)
    {
        $date_range = explode('to', $request->date_range);
        $start_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[0])) : date('Y-m-d');
        $end_date = !is_null($request->date_range) ? date('Y-m-d', strtotime($date_range[1])) : date('Y-m-d');
        $client_id = Auth::user()->client->id;

        $data = [];
        if ($request->has('filter')) {
            $previousBalance = $this->previousBalance($client_id, $start_date);
            $statements = $this->clientStatement($client_id, $start_date, $end_date, $previousBalance);
            $data = [
                'previousBalance' => $previousBalance,
                'statements' => $statements,
            ];
        }

        if ($request->has('print')) {
            if (Auth::user()->company_id) {
                $company = Company::find(Auth::user()->company_id);
                $title = $company->name;
                $informations = $company->address . '</br>' . $company->phone . ', ' . $company->email . ', ' . $company->website;
            } else {
                $title = 'Company Name Goes Here.';
                $informations = 'Company address will goes here </br> Mobile: 0967XXXXXX, Email: youremail@gmail.com, www.website.com';
            }

            $report_title = 'Statement On ' . $start_date . ' To ' . $end_date;
            $client = Client::find($client_id);
            // return view('client.reports.statement.print', compact('title', 'informations', 'report_title', 'data', 'client'));
            $pdf = Pdf::loadView('client.reports.statement.print', compact('title', 'informations', 'report_title', 'data', 'client'));
            return $pdf->stream('statement_' . date('d_m_Y_H_i_s') . '.pdf');
        }

        $title = 'Statement';
        $custom = Route('client.statement.index');
        $filter_form = '
        <form action="' . Route('client.statement.index') . '" method="GET" class="d-flex gap-2">
            <input type="hidden" name="filter" value="1">
            <input type="text" class="form-control date-range py-5px px-2" name="date_range" id="date_range"
                placeholder="Select Date Range" data-time-picker="true" data-format="DD-MM-Y"
                data-separator=" to " autocomplete="off" required
                value="' . (!is_null($start_date) && !is_null($end_date) ? date('d-m-Y', strtotime($start_date)) . ' to ' . date('d-m-Y', strtotime($end_date)) : date('d-m-Y') . ' to ' . date('d-m-Y')) . '">
                <button type="submit" class="btn btn-primary btn-xs">Filter</button>
        </form>';
        return view('client.reports.statement.index', compact('title', 'filter_form', 'data', 'start_date', 'end_date'));
    }

    public static function previousBalance($client_id, $fromDate)
    {
        $salesAmount = Sales::where('client_id', $client_id)->where('date', '<', $fromDate)->sum(DB::raw('sales.total_amount - sales.discount'));
        $paymentAmount = Collection::where('client_id', $client_id)->where('payment_date', '<', $fromDate)->where('collection_type', '!=', 'adjust')->sum('amount');
        $returnAmount = SalesReturn::where('client_id', $client_id)->where('date', '<', $fromDate)->sum('amount');
        return ($returnAmount + $paymentAmount) - $salesAmount;
    }

    public static function clientStatement($client_id, $fromDate, $toDate, $previousBalance)
    {
        $balance = $previousBalance;
        $dateRange = CarbonPeriod::create($fromDate, $toDate);
        $statements = [];
        foreach ($dateRange as $date) {
            $lineData = [
                'date' => $date->format('Y-m-d'),
            ];
            $d = $date->format('Y-m-d');
            $sales = Sales::where('client_id', $client_id)->where('date', $d)->latest('id')->get();
            foreach ($sales as $sale) {
                $balance -= $sale->total_amount - $sale->discount;
                $ld = $lineData;
                $ld['invoice'] = $sale->invoice;
                $ld['particulars'] = 'Purchase';
                $ld['sales'] = number_format($sale->total_amount - $sale->discount, 2, '.', '');
                $ld['collection'] = 0.00;
                $ld['return'] = 0.00;
                $ld['balance'] = number_format($balance, 2, '.', '');
                array_push($statements, $ld);
            }

            $returns = SalesReturn::where('client_id', $client_id)->where('date', $d)->where('approve', 1)->latest('id')->get();
            foreach ($returns as $return) {
                $invoices = '';
                foreach ($return->list as $key => $item) {
                    $invoices .= $key > 0 ? ', ' : '' . $item->sales_list->sales->invoice;
                }
                $balance += $return->amount;
                $ld = $lineData;
                $ld['invoice'] = $return->return_no;
                $ld['particulars'] = 'Return on ' . $return->return_no . ' against on invoice no ' . $invoices;
                $ld['sales'] = 0.00;
                $ld['collection'] = 0.00;
                $ld['return'] = $return->amount;
                $ld['balance'] = number_format($balance, 2, '.', '');
                array_push($statements, $ld);
            }

            $collections = Collection::where('client_id', $client_id)->where('payment_date', $d)->where('collection_type', '!=', 'adjust')->where('on_return', 0)->latest('id')->get();
            foreach ($collections as $collection) {
                $balance += $collection->amount;
                $ld = $lineData;
                $ld['invoice'] = $collection->payment_no;
                $ld['particulars'] = $collection->collection_type == 'advance' ? 'Advance Payment' : 'Invoice Payment';
                $ld['sales'] = 0.00;
                $ld['collection'] = $collection->amount;
                $ld['return'] = 0.00;
                $ld['balance'] = number_format($balance, 2, '.', '');
                array_push($statements, $ld);
            }
        }
        return $statements;
    }
}
