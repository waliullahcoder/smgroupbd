<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorProfitList extends Model
{
    use HasFactory;
    protected $fillable = ['investor_profit_id', 'investor_id', 'share_qty', 'amount', 'deposited_amount', 'deposited', 'deposit_date'];

    public function parent()
    {
        return $this->belongsTo(InvestorProfit::class, 'investor_profit_id');
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }
}
