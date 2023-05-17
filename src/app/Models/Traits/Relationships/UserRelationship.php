<?php

namespace App\Models\Traits\Relationships;

use App\Models\Evaluation;
use App\Models\Order;
use App\Models\Role;
use App\Models\Tenant;

trait UserRelationship {

    /**
     * Retorna o inquilino de um usuário.
     *
     * @return string
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Retorna os cargos do usuário.
     *
     * @return string
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Retorna os pedidos de um usuário.
     *
     * @return string
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Retorna as avaliaçães de um usuário.
     *
     * @return string
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
