<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'product_type', 'transfer_no', 'date', 'host_id', 'destination_id', 'total_amount', 'remarks', 'approve', 'approve_by', 'reject', 'reject_by', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function host()
    {
        return $this->belongsTo(Store::class, 'host_id')->withTrashed();
    }

    public function destination()
    {
        return $this->belongsTo(Store::class, 'destination_id')->withTrashed();
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function approveBy()
    {
        return $this->belongsTo(User::class, 'approve_by')->withTrashed();
    }

    public function list()
    {
        return $this->hasMany(TransferProduct::class, 'transfer_id')->with(['product']);
    }
}
