<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RetailSale extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'product_type', 'payment_type', 'coa_setup_id', 'retail_return_id', 'store_id', 'invoice', 'date', 'client_name', 'client_phone', 'total_amount', 'product_discount', 'discount', 'net_amount', 'return_deduction', 'receive_amount', 'change_amount', 'status', 'staff_id', 'created_by', 'updated_by', 'deleted_by'];

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
        return $this->belongsTo(Staff::class, 'staff_id')->withTrashed();
    }

    public function return()
    {
        return $this->belongsTo(RetailReturn::class, 'retail_return_id');
    }

    public function list()
    {
        return $this->hasMany(RetailSaleList::class, 'retail_sale_id');
    }
}
