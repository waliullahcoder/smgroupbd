<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'variant_id', 'choose_options', 'sku', 'discount', 'sale_price', 'subtotal', 'return_amount', 'quantity', 'delivered'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id')->with(['customer']);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
