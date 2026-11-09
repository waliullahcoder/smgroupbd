<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'store_id', 'product_id', 'qty', 'unit_price', 'type', 'reference', 'note'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
