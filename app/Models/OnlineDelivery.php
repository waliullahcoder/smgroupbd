<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineDelivery extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'vehicle_id', 'driver_id', 'delivery_man_id', 'serial_no', 'date', 'remarks', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }

    public function driver()
    {
        return $this->belongsTo(Staff::class, 'driver_id')->withTrashed();
    }

    public function delivery_man()
    {
        return $this->belongsTo(Staff::class, 'delivery_man_id')->withTrashed();
    }

    public function list()
    {
        return $this->hasMany(OnlineDeliveryList::class, 'online_delivery_id')->with(['order']);
    }
}
