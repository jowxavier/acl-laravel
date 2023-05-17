<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function findEmail(string $email);
    public function create(array $data);
}