<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferProduct extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'product_type', 'transfer_id', 'product_id', 'variant_id', 'qty', 'is_back'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function transfer()
    {
        return $this->belongsTo(Transfer::class, 'transfer_id')->with(['host', 'destination'])->withTrashed();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function variant()
    {
        return $this->belongsTo(ProductSku::class, 'variant_id');
    }
}
