<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreArea extends Model
{
    use HasFactory;
    protected $fillable = ['store_id', 'area_id'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
