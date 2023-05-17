<?php

namespace App\Models\Traits\Scopes;

use App\Tenant\Manager;

trait UserScope {
    /**
     * Scope a query to only users by tenant.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser($query)
    {
        $manager = app(Manager::class)->isManager();
        if (!$manager) {
            return $query->where('tenant_id', auth()->user()->tenant_id);
        }

        return $query;
    }
}
