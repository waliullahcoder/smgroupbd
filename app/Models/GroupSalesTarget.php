<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupSalesTarget extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'group_id', 'year', 'month', 'date', 'total_target', 'total_target_amount', 'target_type', 'status', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id')->withTrashed();
    }

    public function target_categories()
    {
        return $this->hasMany(GroupSalesTargetCategory::class, 'group_sales_target_id')->with(['category']);
    }
}
