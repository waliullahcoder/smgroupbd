<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiftingProduct extends Model
{
    use HasFactory;
    protected $fillable = ['lifting_id', 'company_id', 'store_id', 'vendor_id', 'product_id', 'variant_id', 'product_type', 'lifting_price', 'expiry_date', 'qty', 'total_amount', 'discount', 'net_amount', 'total_paid', 'return_qty', 'return_amount', 'status', 'created_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductSku::class, 'variant_id');
    }

    public function lifting()
    {
        return $this->belongsTo(Lifting::class, 'lifting_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function returns()
    {
        return $this->hasMany(LiftingReturnList::class, 'lifting_product_id');
    }
}
