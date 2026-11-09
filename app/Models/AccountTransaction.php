<?php

namespace App\Models;

use App\Models\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountTransaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['company_id', 'account_transaction_auto_id', 'voucher_no', 'voucher_type', 'voucher_date', 'coa_setup_id', 'coa_head_code', 'narration', 'debit_amount', 'credit_amount', 'posted', 'approve', 'approve_by', 'created_by', 'updated_by', 'deleted_by'];

    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }

    public function coa()
    {
        return $this->belongsTo(CoaSetup::class, 'coa_setup_id')->with('parent')->withTrashed();
    }
}
