<?php

namespace App\Services\Statement\Vendor;

use App\Models\Lifting;
use App\Models\LiftingReturn;
use App\Models\Vendor;
use App\Models\VendorPayment;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class Statement
{
    public static function previousBalance($vendor_id, $fromDate)
    {
        $liftingAmount = Lifting::where('vendor_id', $vendor_id)->where('lifting_date', '<', $fromDate)->sum(DB::raw('total_cost - discount'));
        $paymentAmount = VendorPayment::where('vendor_id', $vendor_id)->where('payment_date', '<', $fromDate)->whereIn('type', ['payment', 'advance'])->sum('amount');
        $returnAmount = LiftingReturn::where('vendor_id', $vendor_id)->where('date', '<', $fromDate)->sum('amount');
        return round($liftingAmount - ($returnAmount + $paymentAmount), 2);
    }

    public static function Statement($vendor_id, $fromDate, $toDate, $previousBalance)
    {
        $balance = $previousBalance;
        $vendorInfo = Vendor::find($vendor_id);
        $dateRange = CarbonPeriod::create($fromDate, $toDate);
        $statements = [];
        foreach ($dateRange as $date) {
            $d = $date->format('Y-m-d');

            $liftingAmount = Lifting::where('vendor_id', $vendor_id)
                ->where('lifting_date',  $d)
                ->get();

            foreach ($liftingAmount as $liftingAmount) {
                $balance += round($liftingAmount->total_cost - $liftingAmount->discount, 2);
                $row = [
                    'vendor_name' => $vendorInfo->name,
                    'date' => $date->format('d-m-Y'),
                    'lifting' => round($liftingAmount->total_cost - $liftingAmount->discount, 2),
                    'payment' => 0.00,
                    'return' => 0.00,
                    'balance' => round($balance, 2),
                    'remarks' => $liftingAmount->payment_type . ' purchase on ' . $liftingAmount->lifting_no . ' which manual voucher no ' . $liftingAmount->voucher_no,
                ];
                array_push($statements, $row);
            }

            $payments = VendorPayment::where('vendor_id', $vendor_id)
                ->where('payment_date', $d)->whereIn('type', ['payment', 'advance'])
                ->get();

            foreach ($payments as $item) {
                $balance -= $item->amount;
                if ($item->type == 'adjust') {
                    $balance += $item->amount;
                }
                $row = [
                    'vendor_name' => $vendorInfo->name,
                    'date' => $date->format('d-m-Y'),
                    'lifting' => 0.00,
                    'payment' => round($item->amount, 2),
                    'return' => 0.00,
                    'balance' => round($balance, 2),
                    'remarks' => $item->payment_type . ' Payment on ' . $item->payment_no . ' which Payment Mode ' . $item->type,
                ];
                array_push($statements, $row);
            }

            $returnAmount = LiftingReturn::where('vendor_id', $vendor_id)
                ->where('date', $d)
                ->get();

            foreach ($returnAmount as $item) {
                $invoices = '';
                foreach ($item->list as $key => $item) {
                    $invoices .= $key > 0 ? ', ' : '' . $item->lifting_product->lifting->lifting_no;
                }
                $balance -= round($item->amount, 2);
                $row = [
                    'vendor_name' => $vendorInfo->name,
                    'date' => $date->format('d-m-Y'),
                    'lifting' => 0.00,
                    'payment' => 0.00,
                    'return' => round($item->amount, 2),
                    'balance' => round($balance, 2),
                    'remarks' => 'Return No ' . $item->return_no . ' against on invoice no ' . $invoices,
                ];
                array_push($statements, $row);
            }
        }
        return $statements;
    }
}
