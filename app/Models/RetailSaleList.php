<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailSaleList extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'product_type', 'retail_sale_id', 'product_id', 'variant_id', 'rate', 'qty', 'product_discount', 'discount', 'amount', 'returned_qty', 'returned_amount'];

    public function sales()
    {
        return $this->belongsTo(RetailSale::class, 'retail_sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
