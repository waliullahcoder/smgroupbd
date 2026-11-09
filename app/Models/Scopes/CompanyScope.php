<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CompanyScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */

    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check()) {
            $company_id = Auth::user()->company_id;
            $area_id = Auth::user()->area_id;
            $branch_id = Auth::user()->branch_id;
            $store_id = Auth::user()->store_id;
            if ($company_id) {
                $tableName = $builder->getModel()->getTable();
                if ($tableName == 'companies') {
                    $builder->where('id', $company_id);
                } else {
                    if (Schema::hasColumn($tableName, 'company_id')) {
                        $builder->where('company_id', $company_id);
                    }

                    if (!is_null($area_id)) {
                        if ($tableName == 'areas') {
                            $builder->whereIn('id', json_decode($area_id));
                        } elseif (Schema::hasColumn($tableName, 'area_id')) {
                            $builder->whereIn('area_id', json_decode($area_id));
                            if ($tableName == 'clients' && \Route::is('admin.sales.create') || $tableName == 'clients' && \Route::is('admin.sales.edit')) {
                                $builder->orWhere('is_chain', 1);
                            }
                        }
                    }

                    if (!is_null($branch_id) && $tableName == 'staffs') {
                        if ($tableName == 'branches') {
                            $builder->whereIn('id', json_decode($branch_id));
                        } elseif (Schema::hasColumn($tableName, 'branch_id')) {
                            $builder->whereIn('branch_id', json_decode($branch_id));
                        }
                    }

                    if (!is_null($store_id)) {
                        if ($tableName == 'stores') {
                            $builder->whereIn('id', json_decode($store_id));
                        } elseif (Schema::hasColumn($tableName, 'store_id')) {
                            $builder->whereIn('store_id', json_decode($store_id));
                        }
                    }
                }
            }
        }
    }
}
