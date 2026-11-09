<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LiftingReturn extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'product_type', 'vendor_id', 'store_id', 'return_no', 'date', 'amount', 'remarks', 'created_by', 'updated_by', 'deleted_by'];

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

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id')->withTrashed();
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function list()
    {
        return $this->hasMany(LiftingReturnList::class, 'lifting_return_id');
    }

    public function payments()
    {
        return $this->hasMany(LiftingReturnPayment::class, 'lifting_return_id');
    }
}
