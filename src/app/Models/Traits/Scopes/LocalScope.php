<?php

namespace App\Models\Traits\Scopes;

use App\Tenant\Scopes\TenantScope;

trait LocalScope {
    /**
     * Scope a query to only include of a given colunm and parameter.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $colunm
     * @param  mixed  $parameter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfRemoveScopeTenantByFind($query, $colunm, $parameter)
    {
        return $query->withoutGlobalScope(new TenantScope)
                ->where($colunm, $parameter);
    }
}