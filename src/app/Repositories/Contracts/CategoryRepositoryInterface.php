<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function paginate(int $tenant_id, int $per_page);
    public function findUuid(string $uuid);
}