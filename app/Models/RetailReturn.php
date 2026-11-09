<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RetailReturn extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'retail_sale_id', 'product_type', 'store_id', 'return_no', 'client_name', 'client_phone', 'date', 'amount', 'remarks', 'approve', 'approve_by', 'reject', 'reject_by', 'accounts_approve', 'accounts_approve_by', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id')->withTrashed();
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function approveBy()
    {
        return $this->belongsTo(User::class, 'approve_by')->withTrashed();
    }

    public function sale()
    {
        return $this->belongsTo(RetailSale::class, 'retail_sale_id');
    }

    public function list()
    {
        return $this->hasMany(RetailReturnList::class, 'retail_return_id');
    }
}
