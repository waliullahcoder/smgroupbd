<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailReturnList extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'product_type', 'retail_return_id', 'retail_sale_list_id', 'product_id', 'variant_id', 'store_id', 'price', 'qty', 'amount', 'product_discount', 'sales_discount'];

    public function return()
    {
        return $this->belongsTo(RetailReturn::class, 'retail_return_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function sales_list()
    {
        return $this->belongsTo(RetailSaleList::class, 'retail_sale_list_id');
    }
}
