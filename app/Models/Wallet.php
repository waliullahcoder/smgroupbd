<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['investor_id', 'invest_id', 'investor_profit_id', 'investor_payment_id', 'sattlement_id', 'product_id', 'date', 'amount_in', 'amount_out', 'type', 'approved', 'created_by', 'updated_by', 'deleted_by'];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }
}
