<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['heading', 'title', 'address', 'work_time', 'primary_mobile', 'primary_email', 'secondary_mobile', 'secondary_email', 'map_url'];
}
