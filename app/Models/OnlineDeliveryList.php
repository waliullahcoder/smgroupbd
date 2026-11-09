<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineDeliveryList extends Model
{
    use HasFactory;
    protected $fillable = ['online_delivery_id', 'customer_id', 'order_id', 'amount', 'discount'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
