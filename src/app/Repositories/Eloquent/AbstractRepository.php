<?php

namespace App\Repositories\Eloquent;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function paginate(int $tenant_id, int $per_page)
    {
        return $this->model->ofRemoveScopeTenantByFind('tenant_id', $tenant_id)
                ->paginate($per_page);
    }

    public function findUuid(string $uuid)
    {
        return $this->model->ofRemoveScopeTenantByFind('uuid', $uuid)->firstOrFail();
    }
}