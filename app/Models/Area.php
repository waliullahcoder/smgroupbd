<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'region_id', 'code', 'name', 'incharge_name', 'phone', 'email', 'address', 'shipping_charge', 'status', 'created_by', 'updated_by', 'deleted_by'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id')->withTrashed();
    }

    public function territories()
    {
        return $this->hasMany(Territory::class, 'area_id')->withTrashed();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'area_id');
    }
}
