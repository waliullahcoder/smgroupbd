<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'client_id', 'staff_id', 'payment_no', 'payment_date', 'collection_type', 'payment_type', 'amount', 'remarks', 'sales_id', 'on_return', 'approved', 'approved_by', 'created_by', 'updated_by', 'deleted_by'];

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
        return $this->belongsTo(Client::class, 'client_id')->withTrashed();
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function collection_data()
    {
        return $this->hasMany(CollectionData::class, 'collection_id');
    }
}
