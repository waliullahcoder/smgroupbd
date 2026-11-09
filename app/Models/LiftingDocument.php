<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiftingDocument extends Model
{
    use HasFactory;
    protected $fillable = ['lifting_id', 'document'];
}
