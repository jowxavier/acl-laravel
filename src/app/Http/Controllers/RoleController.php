<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Exceptions\CustomFindException;
use App\Exceptions\CustomStoreException;

class RoleController extends Controller
{
    /**
     * @var \App\Models\Role
     */
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $roles = $this->model->paginate();
            return view('roles.index', compact('roles'));
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
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $this->model->create($request->all());
            return redirect()->route('admin.roles.index')->with('success', 'Cargo inserido com sucesso');
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
            $role = $this->model->findOrFail($id);
            return view('roles.show', compact('role'));
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
            $role = $this->model->findOrFail($id);
            return view('roles.edit', compact('role'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\RoleRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $this->model->findOrFail($id)->update($request->all());
            return redirect()->route('admin.roles.index')->with('success', 'Cargo alterado com sucesso');
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->model->findOrFail($id)->delete();
            return redirect()->route('admin.roles.index')->with('success', 'Cargo removido com sucesso');
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $filters = $request->except('_token');
            $filter = $request->filter;

            $roles = $this->model
                ->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', $filter)
                ->paginate();

            return view('roles.index', compact('roles', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }
}
