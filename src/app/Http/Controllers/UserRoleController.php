<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRoleRequest;
use App\Exceptions\CustomFindException;

class UserRoleController extends Controller
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * @var \App\Models\Role
     */
    protected $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Lista as Cargos do Usuário.
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        try {
            $user = $this->user->findOrFail($userId);
            $roles = $user->roles()->paginate();
            return view('users.roles.index', compact('user', 'roles'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Exibe os Cargos disponíveis no Usuário.
     * Filtro de busca de Cargos relacionadas ao Usuário.
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $userId)
    {
        try {
            $user = $this->user->findOrFail($userId);

            $filters = $request->except('_token');
            $roles = $user->rolesAvailable($request->filter);
            return view('users.roles.create', compact('user', 'roles', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Cria o relacionamento dos Cargos com o Usuário.
     *
     * @param int $userId
     * @param \App\Http\Requests\UserRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRoleRequest $request, $userId)
    {
        try {
            $user = $this->user->findOrFail($userId);
            $user->roles()->attach($request->roles);

            return redirect()->route('admin.users.roles.index', $user->id)->with('success', "Cargos vinculadas ao Usuário {$user->name} com sucesso");
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Remove o relacionamento dos Cargos com o Usuário.
     *
     * @param int $userId
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $id)
    {
        try {
            $user = $this->user->find($userId);
            $role = $this->role->find($id);

            if ($role->manager) {
                return view('errors.401');
            }

            $user->roles()->detach($role);
            return redirect()->route('admin.users.roles.index', $user->id)->with('success', "Cargos desvinculadas do Usuário {$user->name} com sucesso");
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Filtro de busca de Cargos relacionados ao Usuário.
     *
     * @param int $userId
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function search($userId, Request $request)
    {
        try {
            $filters = $request->except('_token');
            $filter = $request->filter;

            $user = $this->user->findOrFail($userId);
            $roles = $this->role
                ->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', $filter)
                ->paginate();

            return view('users.roles.index', compact('user', 'roles', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }
}
