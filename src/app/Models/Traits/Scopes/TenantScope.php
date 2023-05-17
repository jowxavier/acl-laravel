<?php

namespace App\Models\Traits\Scopes;

use App\Tenant\Manager;

trait TenantScope {
    /**
     * Scope a query to only users by tenant.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyTenant($query)
    {
        $manager = app(Manager::class)->isManager();
        if (!$manager) {
            return $query->where('id', auth()->user()->tenant_id);
        }
    }
}
