<?php

namespace App\Repositories\Contracts;

interface TenantRepositoryInterface
{
    public function paginate(int $per_page);
    public function findUuid(string $uuid);
}