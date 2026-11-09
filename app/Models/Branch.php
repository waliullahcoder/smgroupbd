<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'prefix', 'name', 'contact_person', 'email', 'phone', 'fax', 'website', 'vat', 'tin', 'trade_license', 'address', 'status', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function stores()
    {
        return $this->hasMany(Store::class, 'branch_id')->withTrashed();
    }
}
