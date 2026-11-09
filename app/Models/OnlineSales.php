<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OnlineSales extends Model
{
    protected $table = 'view_online_all_sales';

    protected static function booted()
    { 
        static::addGlobalScope(function ($query) {
            if(is_array(Auth::user()->stores) && count(Auth::user()->stores)){
                $query->whereIn('store_id', Auth::user()->stores);
            }            
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
