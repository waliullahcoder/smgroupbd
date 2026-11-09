<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorPayment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'lifting_id', 'lifting_return_id', 'vendor_id', 'payment_no', 'payment_date', 'payment_type', 'type', 'amount', 'remarks', 'approved', 'approved_by', 'created_by', 'updated_by', 'deleted_by'];

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

    public function staff()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function payment_data()
    {
        return $this->hasMany(VendorPaymentData::class, 'vendor_payment_id');
    }
}
