<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'address_type', 'name', 'email', 'phone', 'street', 'address', 'division_id', 'district_id', 'upozila_id'];
}
