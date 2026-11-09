<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'position', 'status'];

    public function rootItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->whereNull('parent_id')->with(['children', 'page', 'category']);
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->with(['page', 'category']);
    }
}
