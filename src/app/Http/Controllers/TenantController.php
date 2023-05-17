<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Requests\TenantRequest;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomFindException;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\CustomStoreException;

class TenantController extends Controller
{
    /**
     * @var \App\Models\Tenant
     */
    protected $model;

    public function __construct(Tenant $model)
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
            $tenants = $this->model->myTenant()->paginate();
            return view('tenants.index', compact('tenants'));
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
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TenantRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TenantRequest $request)
    {
        try {
            $this->model->myTenant()->create($request->all());
            return redirect()->route('admin.tenants.index')->with('success', 'Tenant inserido com sucesso');
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
            $tenant = $this->model->myTenant()->findOrFail($id);
            return view('tenants.show', compact('tenant'));
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
            $tenant = $this->model->myTenant()->findOrFail($id);
            return view('tenants.edit', compact('tenant'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TenantRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TenantRequest $request, $id)
    {
        try {
            $data = $request->all();
            $tenant = $this->model->myTenant()->findOrFail($id);

            if ($request->hasFile('logo') && $request->logo->isValid()) {

                if (Storage::exists($tenant->logo)) {
                    Storage::delete($tenant->logo);
                }

                $data['logo'] = $request->logo->store("tenants/{$tenant->uuid}/logos");
            }

            $tenant->update($data);
            return redirect()->route('admin.tenants.index')->with('success', 'Empresa alterada com sucesso');
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
            $tenant = $this->model->myTenant()->findOrFail($id);

            if (Storage::exists($tenant->logo)) {
                Storage::delete($tenant->logo);
            }

            $tenant->delete();

            return redirect()->route('admin.tenants.index')->with('success', 'Empresa removida com sucesso');
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $filters = $request->except('_token');
            $filter = $request->filter;

            $tenants = $this->model
                ->where('cnpj', 'LIKE', "%{$filter}%")
                ->orWhere('id', auth()->user()->tenant_id)
                ->orWhere('company', $filter)
                ->paginate();

            return view('tenants.index', compact('tenants', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    public function sigin($tenant_id, Request $request)
    {
        try {
            $currency_id = Auth::user()->tenant_id;
            $tenant = Tenant::with('users')->findOrFail($tenant_id);

            $auth = Auth::loginUsingId($tenant->users->first()->id);
            if ($auth) {
                $request->session()->put('currency_id', $currency_id);

                $request->session()->regenerate();

                return redirect()->route('admin.dashboard');
            }
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }
}
