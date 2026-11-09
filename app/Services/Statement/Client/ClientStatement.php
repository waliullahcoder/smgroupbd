<?php

namespace App\Services\Statement\Client;

use App\Models\Collection;
use App\Models\Sales;
use App\Models\SalesReturn;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class ClientStatement
{
    public static function previousBalance($client_id, $fromDate)
    {
        $salesAmount = Sales::whereIn('client_id', $client_id)->where('date', '<', $fromDate)->sum(DB::raw('sales.total_amount - sales.discount'));
        $paymentAmount = Collection::whereIn('client_id', $client_id)->where('payment_date', '<', $fromDate)->where('collection_type', '!=', 'adjust')->sum('amount');
        $returnAmount = SalesReturn::whereIn('client_id', $client_id)->where('date', '<', $fromDate)->sum('amount');
        return $salesAmount - ($returnAmount + $paymentAmount);
    }

    public static function Statement($client_id, $fromDate, $toDate, $previousBalance)
    {
        $balance = $previousBalance;
        $dateRange = CarbonPeriod::create($fromDate, $toDate);
        $statements = [];
        foreach ($dateRange as $date) {
            $lineData = [
                'date' => $date->format('Y-m-d'),
            ];
            $d = $date->format('Y-m-d');
            $sales = Sales::whereIn('client_id', $client_id)->where('date', $d)->latest('id')->get();
            foreach ($sales as $sale) {
                $balance += $sale->total_amount - $sale->discount;
                $ld = $lineData;
                $ld['invoice'] = $sale->invoice;
                $ld['particulars'] = 'Product Sale';
                $ld['sales'] = $sale->total_amount - $sale->discount;
                $ld['collection'] = 0.00;
                $ld['return'] = 0.00;
                $ld['balance'] = $balance;
                array_push($statements, $ld);
            }

            $returns = SalesReturn::whereIn('client_id', $client_id)->where('date', $d)->where('approve', 1)->latest('id')->get();
            foreach ($returns as $return) {
                $invoices = '';
                foreach ($return->list as $key => $item) {
                    $invoices .= $key > 0 ? ', ' : '' . $item->sales_list->sales->invoice;
                }
                $balance -= $return->amount;
                $ld = $lineData;
                $ld['invoice'] = $return->return_no;
                $ld['particulars'] = 'Sales Return on ' . $return->return_no . ' against on invoice no ' . $invoices;
                $ld['sales'] = 0.00;
                $ld['collection'] = 0.00;
                $ld['return'] = $return->amount;
                $ld['balance'] = $balance;
                array_push($statements, $ld);
            }

            $collections = Collection::whereIn('client_id', $client_id)->where('payment_date', $d)->where('collection_type', '!=', 'adjust')->where('on_return', 0)->latest('id')->get();
            foreach ($collections as $collection) {
                $balance -= $collection->amount;
                $ld = $lineData;
                $ld['invoice'] = $collection->payment_no;
                $ld['particulars'] = $collection->collection_type == 'advance' ? 'Advance Collection' : 'Invoice Collection';
                $ld['sales'] = 0.00;
                $ld['collection'] = $collection->amount;
                $ld['return'] = 0.00;
                $ld['balance'] = $balance;
                array_push($statements, $ld);
            }
        }
        return $statements;
    }
}
