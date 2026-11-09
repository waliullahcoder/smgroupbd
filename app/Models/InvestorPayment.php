<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestorPayment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['investor_id', 'payment_no', 'date', 'deposit_type', 'amount', 'bkash', 'rocket', 'nagad', 'bank_account', 'remarks', 'data', 'approved', 'status', 'created_by', 'updated_by', 'deleted_by'];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }
}
