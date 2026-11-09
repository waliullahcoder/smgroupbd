<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'variant', 'lifting_price', 'price', 'discount', 'discount_tk', 'sku', 'image'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
