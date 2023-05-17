<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Exceptions\CustomFindException;
use App\Http\Requests\RolePermissionRequest;

class RolePermissionController extends Controller
{
    /**
     * @var \App\Models\Role
     */
    protected $role;

    /**
     * @var \App\Models\Permission
     */
    protected $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Lista as Permissões do Cargo.
     *
     * @param int $roleId
     * @return \Illuminate\Http\Response
     */
    public function index($roleId)
    {
        try {
            $role = $this->role->findOrFail($roleId);
            $permissions = $role->permissions()->paginate();
            return view('roles.permissions.index', compact('role', 'permissions'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Exibe as Permissões disponíveis no Cargo.
     * Filtro de busca de Permissões relacionadas o Cargo.
     *
     * @param int $roleId
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $roleId)
    {
        try {
            $role = $this->role->findOrFail($roleId);

            $filters = $request->except('_token');
            $permissions = $role->permissionsAvailable($request->filter);
            return view('roles.permissions.create', compact('role', 'permissions', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Cria o relacionamento das Permissões com o Cargo.
     *
     * @param int $roleId
     * @param \App\Http\Requests\RolePermissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolePermissionRequest $request, $roleId)
    {
        try {
            $role = $this->role->findOrFail($roleId);
            $role->permissions()->attach($request->permissions);

            return redirect()->route('admin.roles.permissions.index', $role->id)->with('success', "Permissões vinculadas ao Cargo {$role->name} com sucesso");
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Remove o relacionamento das Permissões com o Cargo.
     *
     * @param int $roleId
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($roleId, $id)
    {
        try {
            $role = $this->role->find($roleId);
            $permission = $this->permission->find($id);
            $role->permissions()->detach($permission);
            return redirect()->route('admin.roles.permissions.index', $role->id)->with('success', "Permissões desvinculadas do Cargo {$role->name} com sucesso");
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Filtro de busca de Permissões relacionadas o Cargo.
     *
     * @param int $roleId
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function search($roleId, Request $request)
    {
        try {
            $filters = $request->except('_token');
            $filter = $request->filter;

            $role = $this->role->findOrFail($roleId);
            $permissions = $this->permission
                ->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', $filter)
                ->paginate();

            return view('roles.permissions.index', compact('role', 'permissions', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }
}
