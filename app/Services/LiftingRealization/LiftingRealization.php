<?php

namespace App\Services\LiftingRealization;

use Carbon\Carbon;
use App\Models\Lifting;
use App\Models\LiftingReturn;
use App\Models\VendorPayment;

class LiftingRealization
{
    public $vendor_id;
    public $year;
    public $month;

    public function __construct($vendor_id, $year, $month)
    {
        $this->vendor_id = $vendor_id;
        $this->year     = $year;
        $this->month    = $month;
    }

    public function getMonthlyInfo()
    {
        $firstDateOfMonth = Carbon::create($this->year, $this->month)->firstOfMonth()->format('Y-m-d');
        $lastDateOfMonth = Carbon::create($this->year, $this->month)->lastOfMonth()->format('Y-m-d');

        $liftingAmount = Lifting::where('vendor_id', $this->vendor_id)
            ->where('lifting_date', '>=', $firstDateOfMonth)
            ->where('lifting_date', '<=', $lastDateOfMonth)
            ->sum('net_amount');

        $paymentAmount = VendorPayment::where('vendor_id', $this->vendor_id)
            ->whereIn('type', ['payment', 'advance'])
            ->where('payment_date', '>=', $firstDateOfMonth)
            ->where('payment_date', '<=', $lastDateOfMonth)
            ->sum('amount');

        $returnAmount = LiftingReturn::where('vendor_id', $this->vendor_id)
            ->where('date', '>=', $firstDateOfMonth)
            ->where('date', '<=', $lastDateOfMonth)
            ->sum('amount');

        return [
            'lifting' => $liftingAmount,
            'payment' => $paymentAmount,
            'return' => $returnAmount,
            'balance' => $liftingAmount - $paymentAmount - $returnAmount,
        ];
    }

    public function getYearlyInfo()
    {
        $firstDateOfYear = Carbon::create($this->year)->firstOfYear()->format('Y-m-d');
        $lastDateOfYear = Carbon::create($this->year)->lastofYear()->format('Y-m-d');

        $liftingAmount = Lifting::where('vendor_id', $this->vendor_id)
            ->where('lifting_date', '>=', $firstDateOfYear)
            ->where('lifting_date', '<=', $lastDateOfYear)
            ->sum('net_amount');

        $paymentAmount = VendorPayment::where('vendor_id', $this->vendor_id)
            ->whereIn('type', ['payment', 'advance'])
            ->where('payment_date', '>=', $firstDateOfYear)
            ->where('payment_date', '<=', $lastDateOfYear)
            ->sum('amount');

        $returnAmount = LiftingReturn::where('vendor_id', $this->vendor_id)
            ->where('date', '>=', $firstDateOfYear)
            ->where('date', '<=', $lastDateOfYear)
            ->sum('amount');

        return [
            'lifting' => $liftingAmount,
            'payment' => $paymentAmount,
            'return' => $returnAmount,
            'balance' => $liftingAmount - $paymentAmount - $returnAmount,
        ];
    }

    public function getPreviousBalance()
    {
        $firstDateOfYear = Carbon::create($this->year)->firstOfYear()->format('Y-m-d');
        $liftingAmount = Lifting::where('vendor_id', $this->vendor_id)
            ->where('lifting_date', '<', $firstDateOfYear)
            ->sum('net_amount');
        $paymentAmount = VendorPayment::where('vendor_id', $this->vendor_id)
            ->where('payment_date', '<', $firstDateOfYear)
            ->whereIn('type', ['payment', 'advance'])
            ->sum('amount');
        $returnAmount = LiftingReturn::where('vendor_id', $this->vendor_id)
            ->where('date', '<', $firstDateOfYear)
            ->sum('amount');
        return $liftingAmount - $paymentAmount - $returnAmount;
    }
}
