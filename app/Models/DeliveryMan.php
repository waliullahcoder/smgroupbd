<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryMan extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'store_id', 'code', 'name', 'phone', 'address', 'email', 'national_id', 'status', 'created_by', 'updated_by', 'deleted_by'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
