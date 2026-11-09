<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesList extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'product_type', 'sales_id', 'store_id', 'client_id', 'product_id', 'variant_id', 'order_product_id', 'rate', 'qty', 'amount', 'discount', 'returned_qty', 'returned_amount', 'is_return', 'delivery_status'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->with('area')->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with(['category', 'vendors', 'attribute'])->withTrashed();
    }

    public function variant()
    {
        return $this->belongsTo(ProductSku::class, 'variant_id');
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id', 'id')->withTrashed();
    }

    public function return()
    {
        return $this->hasMany(SalesReturnList::class, 'sales_list_id');
    }
}
