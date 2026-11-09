<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrderSection extends Model
{
    use HasFactory;
    protected $fillable = ['pre_order_setup_id', 'type', 'title', 'list', 'description', 'image', 'video_link'];
}
