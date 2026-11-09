<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesReturn extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'company_id', 'product_type', 'client_id', 'store_id', 'return_no', 'date', 'amount', 'remarks', 'approve', 'approve_by', 'accounts_approve', 'accounts_approve_by', 'collection_id', 'reject', 'reject_by', 'created_by', 'updated_by', 'deleted_by'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->withoutGlobalScope(CompanyScope::class)->withTrashed();
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

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id')->withTrashed();
    }

    public function list()
    {
        return $this->hasMany(SalesReturnList::class, 'sales_return_id');
    }
}
