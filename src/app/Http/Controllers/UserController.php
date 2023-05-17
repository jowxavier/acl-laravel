<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\CustomFindException;
use App\Exceptions\CustomStoreException;
use App\Tenant\Manager;

class UserController extends Controller
{
    /**
     * @var \App\Models\User
     */
    protected $model;

    /**
     * @var \App\Models\Tenant
     */
    protected $tenant;

    public function __construct(User $model, Tenant $tenant)
    {
        $this->model = $model;
        $this->tenant = $tenant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = $this->model->latest()->tenantUser()->paginate();
            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tenants = $this->tenant->all();
        return view('users.create', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, Manager $manager)
    {
        try {
            $data = $request->except('password_confirmation');
            $data['tenant_id'] = $manager->isManager() ? $request->tenant_id : auth()->user()->tenant_id;
            $data['password'] = Hash::make($request->password);

            $this->model->create($data);
            return redirect()->route('admin.users.index')->with('success', 'Usuário inserido com sucesso');
        } catch (\Exception $e) {
            throw new CustomStoreException($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->model->tenantUser()->findOrFail($id);
            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = $this->model->tenantUser()->findOrFail($id);
            $tenants = $this->tenant->all();

            return view('users.edit', compact('user', 'tenants'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $data = $request->only(['name', 'email']);

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $this->model->tenantUser()->findOrFail($id)->update($data);
            return redirect()->route('admin.users.index')->with('success', 'Usuário alterado com sucesso');
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->model->tenantUser()->findOrFail($id)->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuário removido com sucesso');
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $filters = $request->except('_token');
            $filter = $request->filter;

            $users = $this->model
                ->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('email', $filter)
                ->latest()
                ->tenantUser()
                ->paginate();

            return view('users.index', compact('users', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }
}
