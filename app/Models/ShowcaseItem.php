<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowcaseItem extends Model
{
    use HasFactory;
    protected $fillable = [ 'title', 'thumbnail', 'short_description', 'slug', 'serial', 'link', 'status'];
}
