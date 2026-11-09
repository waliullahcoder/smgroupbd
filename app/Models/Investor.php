<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'user_id', 'name', 'image', 'email', 'phone', 'address', 'nid', 'document', 'bkash', 'rocket', 'nagad', 'bank', 'branch', 'account_name', 'account_no', 'coa_setup_id', 'status', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function coa()
    {
        return $this->belongsTo(CoaSetup::class, 'coa_setup_id');
    }

    public function invests()
    {
        return $this->hasMany(Invest::class, 'investor_id');
    }
}
