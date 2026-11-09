<?php

namespace App\Services\TargetAchievement;

use App\Models\SalesList;
use Carbon\Carbon;

class TargetAchievement
{
    public static function achievement($month, $year, $staff_id)
    {
        $start_date = Carbon::create($year, $month)->firstOfMonth()->format('Y-m-d');
        $end_date = Carbon::create($year, $month)->lastOfMonth()->format('Y-m-d');
        $sales = SalesList::with(['sales'])->whereHas('sales', function ($query) use ($start_date, $end_date, $staff_id) {
            $query->whereIn('staff_id', $staff_id)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date);
        })->sum('amount');
        return $sales;
    }
}
