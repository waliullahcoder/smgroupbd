<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'client_id', 'customer_id', 'order_code', 'store_id', 'date', 'potential_delivery_date', 'invoice', 'user_name', 'user_phone', 'shipping_address_id', 'shipping_address', 'area_id', 'shipping_charge', 'sub_total', 'discount', 'total', 'paid', 'due', 'receive', 'total_return', 'payment_method', 'coupon_id', 'delivery_man_id', 'collected', 'status', 'cancel_approve', 'gate_pass', 'order_type', 'pre_order', 'pending_at', 'confirmed_at', 'processing_at', 'delivered_at', 'collected_at', 'canceled_at', 'return_at', 'order_note', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(function ($query) {
            if(is_array(Auth::user()->stores) && count(Auth::user()->stores)){
                $query->whereIn('store_id', Auth::user()->stores);
            }
        });
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id')->with(['product']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function address()
    {
        return $this->belongsTo(ShippingAddress::class, 'shipping_address_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function getFormattedDateAttribute()
    {
        return date('d-m-Y', strtotime($this->date));
    }

    protected $appends = ['formattedDate'];
}
