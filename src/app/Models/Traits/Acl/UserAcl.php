<?php

namespace App\Models\Traits\Acl;

use App\Tenant\Manager;

trait UserAcl {

    /**
     * Retorna todas as permissões do usuário.
     *
     * @return array
     */
    private function permissions(): Array
    {
        $permissionsRole = $this->permissionsRole();

        $permissions = [];
        foreach ($permissionsRole as $role) {
            array_push($permissions, $role);
        }

        return $permissions;
    }

    /**
     * Retorna todas as permissões do cargo usuário.
     *
     * @return array
     */
    private function permissionsRole(): Array
    {
        $roles = $this->roles()->with('permissions')->get();

        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }

    /**
     * Retorna se a permissão existe.
     *
     * @param String $permission
     * @return boolean
     */
    public function hasPermissions(String $permission): bool
    {
        return in_array($permission, $this->permissions());
    }

    /**
     * Retorna é administrador.
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return app(Manager::class)->isManager();
    }
}
