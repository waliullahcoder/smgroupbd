<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestorProfit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['serial_no', 'year', 'month', 'date', 'total_profit', 'investor_percentage', 'total_share', 'amount', 'created_by', 'updated_by', 'deleted_by'];

    public function list()
    {
        return $this->hasMany(InvestorProfitList::class, 'investor_profit_id');
    }
}
