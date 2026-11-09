<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lifting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'store_id', 'vendor_id', 'coa_setup_id', 'lifting_no', 'product_type', 'payment_type', 'voucher_no', 'lifting_date', 'total_cost', 'discount', 'net_amount', 'total_paid', 'return_amount', 'return_paid', 'status', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }

    public function documents()
    {
        return $this->hasMany(LiftingDocument::class, 'lifting_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id')->withTrashed();
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function products()
    {
        return $this->hasMany(LiftingProduct::class, 'lifting_id');
    }
}
