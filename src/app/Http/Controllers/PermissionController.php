<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Exceptions\CustomFindException;
use App\Exceptions\CustomStoreException;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    /**
     * @var \App\Models\Permission
     */
    protected $model;

    public function __construct(Permission $model)
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
            $permissions = $this->model->paginate();
            return view('permissions.index', compact('permissions'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }
}
