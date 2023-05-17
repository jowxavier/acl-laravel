<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Exceptions\CustomFindException;
use App\Exceptions\CustomStoreException;

class CategoryController extends Controller
{
    /**
     * @var \App\Models\Category
     */
    protected $model;

    public function __construct(Category $model)
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
            $categories = $this->model->paginate();
            return view('categories.index', compact('categories'));
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
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $this->model->create($request->all());
            return redirect()->route('admin.categories.index')->with('success', 'Categoria inserida com sucesso');
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
            $category = $this->model->findOrFail($id);
            return view('categories.show', compact('category'));
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
            $category = $this->model->findOrFail($id);
            return view('categories.edit', compact('category'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $this->model->findOrFail($id)->update($request->all());
            return redirect()->route('admin.categories.index')->with('success', 'Categoria alterada com sucesso');
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
            return redirect()->route('admin.categories.index')->with('success', 'Categoria removida com sucesso');
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $filters = $request->except('_token');
            $filter = $request->filter;

            $categories = $this->model
                ->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', $filter)
                ->paginate();

            return view('categories.index', compact('categories', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }
}
