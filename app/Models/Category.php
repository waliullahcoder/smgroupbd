<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'company_id', 'parent_id', 'name', 'slug', 'image', 'meta_title', 'meta_keyword', 'meta_description', 'featured', 'order', 'status', 'show_frontend', 'created_by', 'updated_by', 'deleted_by'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function scopeRoot($query)
    {
        $query->whereNull('parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1)->orderBy('name');
    }

    public function limitChildren()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1)->inRandomOrder();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function vendors()
    {
        return $this->hasMany(CategoryVendor::class, 'category_id');
    }
}
