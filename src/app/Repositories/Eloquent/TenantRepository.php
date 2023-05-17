<?php

namespace App\Repositories\Eloquent;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface
{
    public function __construct(Tenant $tenant)
    {
        $this->model = $tenant;
    }

    public function paginate($per_page)
    {
        return $this->model->paginate($per_page);
    }

    public function findUuid(string $uuid)
    {
        return $this->model->where('uuid', $uuid)->firstOrFail();
    }
}
