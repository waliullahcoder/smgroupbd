<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'name', 'team_leader', 'status', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function leader()
    {
        return $this->belongsTo(Staff::class, 'team_leader');
    }

    public function members()
    {
        return $this->hasMany(GroupMember::class, 'group_id')->with(['staff']);
    }

    public function targets()
    {
        return $this->hasMany(GroupSalesTarget::class, 'group_id')->withTrashed()->with(['target_categories']);
    }
}
