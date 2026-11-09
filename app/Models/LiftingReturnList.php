<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiftingReturnList extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'lifting_return_id', 'vendor_id', 'store_id', 'lifting_id', 'lifting_product_id', 'product_type', 'product_id', 'variant_id', 'lifting_price', 'qty', 'amount', 'lifting_discount', 'remarks'];

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
        return $this->belongsTo(LiftingReturn::class, 'lifting_return_id')->withTrashed();
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id')->withTrashed();
    }

    public function lifting_product()
    {
        return $this->belongsTo(LiftingProduct::class, 'lifting_product_id')->with(['lifting', 'product']);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with(['category', 'attribute'])->withTrashed();
    }

    public function variant()
    {
        return $this->belongsTo(ProductSku::class, 'variant_id');
    }
}
