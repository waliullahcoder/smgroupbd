<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'star', 'title', 'description', 'images'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
