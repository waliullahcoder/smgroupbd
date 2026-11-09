<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['role', 'name', 'company_id', 'user_name', 'email', 'phone', 'image', 'area_id', 'branch_id', 'store_id', 'status', 'is_staff', 'staff_id', 'otp', 'otp_expire', 'password', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function address()
    {
        return $this->hasMany(ShippingAddress::class, 'user_id');
    }

    public function sales()
    {
        return $this->hasMany(Sales::class, 'created_by');
    }

    public function getstoresAttribute()
    {
        if ($this->store_id) {
            return Store::whereIn('id', json_decode($this->store_id))->pluck('id')->toArray();
        }
    }

    protected $appends = ['stores'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id', 'user_id');
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'id', 'user_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}
