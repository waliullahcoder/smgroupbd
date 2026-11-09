<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreOrderSetup extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['slug', 'image', 'product_id', 'status', 'created_by', 'updated_by', 'deleted_by'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function sections()
    {
        return $this->hasMany(PreOrderSection::class, 'pre_order_setup_id');
    }
}
