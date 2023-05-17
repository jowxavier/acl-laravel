<?php

namespace App\Models\Traits\Relationships;

use App\Models\Role;

trait PermissionRelationship {

    /**
     * Retorna as regras da permissão.
     *
     * @return string
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
