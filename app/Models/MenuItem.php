<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'menu_id', 'parent_id', 'category_id', 'page_id', 'custom_page', 'order', 'status'];

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
