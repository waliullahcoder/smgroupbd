<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'banner', 'banner_link', 'order', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_categories()
    {
        return $this->hasMany(HomeSectionSubCategory::class, 'home_section_id');
    }
}
