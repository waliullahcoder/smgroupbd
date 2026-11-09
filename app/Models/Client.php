<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'user_id', 'coa_setup_id', 'reference_by', 'client_category_id', 'area_id', 'territory_id', 'code', 'name', 'contact_person', 'phone', 'email', 'address', 'credit_limit', 'bin_no', 'is_chain', 'is_vat', 'chain_client_id', 'discount', 'status', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function reference()
    {
        return $this->belongsTo(Staff::class, 'reference_by')->withTrashed();
    }

    public function client_category()
    {
        return $this->belongsTo(ClientCategory::class, 'client_category_id')->withTrashed();
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id')->orderBy('name', 'asc')->withTrashed()->with(['region']);
    }

    public function territory()
    {
        return $this->belongsTo(Territory::class, 'territory_id')->orderBy('name', 'asc')->withTrashed();
    }

    public function chain_client()
    {
        return $this->belongsTo(ChainClient::class, 'chain_client_id')->withTrashed();
    }

    public function sales()
    {
        return $this->hasMany(Sales::class, 'client_id')->withTrashed();
    }

    public function liveSales()
    {
        return $this->hasMany(Sales::class, 'client_id');
    }

    public function liveCollections()
    {
        return $this->hasMany(Collection::class, 'client_id');
    }

    public function coa()
    {
        return $this->belongsTo(CoaSetup::class, 'coa_setup_id');
    }
}
