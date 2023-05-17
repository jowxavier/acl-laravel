<?php

namespace App\Models\Traits\Relationships;

use App\Models\User;
use App\Models\Permission;

trait RoleRelationship {

    /**
     * Retorna as permissões da regra.
     *
     * @return string
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Retorna os usuários da regra.
     *
     * @return string
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}