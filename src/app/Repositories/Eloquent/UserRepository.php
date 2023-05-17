<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function findEmail(string $email)
    {
        return $this->model->where('email', $email)->firstOrFail();
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->model->firstOrCreate($data);
    }
}
