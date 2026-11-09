<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturnList extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'product_type', 'sales_return_id', 'client_id', 'sales_list_id', 'product_id', 'variant_id', 'store_id', 'price', 'qty', 'amount', 'sales_discount', 'remarks'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function return()
    {
        return $this->belongsTo(SalesReturn::class, 'sales_return_id')->withTrashed();
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->withTrashed();
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id')->withTrashed();
    }

    public function sales_list()
    {
        return $this->belongsTo(SalesList::class, 'sales_list_id')->with(['sales']);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with(['category', 'vendor', 'attribute'])->withTrashed();
    }

    public function variant()
    {
        return $this->belongsTo(ProductSku::class, 'variant_id');
    }

    public function approve()
    {
        return $this->belongsTo(User::class, 'approved_by')->withTrashed();
    }
}
