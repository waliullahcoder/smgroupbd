<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupSalesTargetCategory extends Model
{
    use HasFactory;
    protected $fillable = ['group_sales_target_id', 'category_id', 'target', 'target_amount'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }
}
