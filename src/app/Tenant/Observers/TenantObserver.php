<?php

namespace App\Tenant\Observers;

use App\Tenant\Manager;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    /**
     * Handle the tenant "creating" event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function creating(Model $model)
    {
        $manager = app(Manager::class)->isManager();
        if (!$manager) {
            $model->tenant_id = auth()->user()->tenant_id;
        }
    }
}
