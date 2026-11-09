<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'lifting_price', 'sale_price', 'online_price', 'discount', 'discount_tk'];
}
