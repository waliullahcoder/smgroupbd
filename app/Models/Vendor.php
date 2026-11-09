<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'coa_setup_id', 'code', 'name', 'contact_person', 'email', 'phone', 'address', 'status', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function liftings()
    {
        return $this->hasMany(Lifting::class, 'vendor_id');
    }

    public function payments()
    {
        return $this->hasMany(VendorPayment::class, 'vendor_id');
    }

    public function coa()
    {
        return $this->belongsTo(CoaSetup::class, 'coa_setup_id')->withTrashed();
    }
}
