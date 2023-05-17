<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function byCategories(int $tenant_id, array $categories, int $per_page);
    public function paginate(int $tenant_id, int $per_page);
    public function findUuid(string $uuid);
}