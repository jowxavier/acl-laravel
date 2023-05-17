<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Exceptions\CustomFindException;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\CustomStoreException;

class ProductController extends Controller
{
    /**
     * @var \App\Models\Product
     */
    protected $model;

    public function __construct(Product $model)
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
            $products = $this->model->paginate();

            $products->getCollection()->transform(function ($product) {
                $product->path = (strpos($product->path, 'http') !== false) ? $product->path : url("storage/{$product->path}");
                return $product;
            });

            return view('products.index', compact('products'));
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
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $data = $request->all();
            $tenant = auth()->user()->tenant;

            if ($request->hasFile('path') && $request->path->isValid()) {
                $data['path'] = $request->path->store("tenants/{$tenant->uuid}/products");
            }

            $this->model->create($data);
            return redirect()->route('admin.products.index')->with('success', 'Produto inserido com sucesso');
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
            $product = $this->model->findOrFail($id);
            $product->path = (strpos($product->path, 'http') !== false) ? $product->path : url("storage/{$product->path}");

            return view('products.show', compact('product'));
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
            $product = $this->model->findOrFail($id);
            $product->path = (strpos($product->path, 'http') !== false) ? $product->path : url("storage/{$product->path}");

            return view('products.edit', compact('product'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $data = $request->all();

            $product = $this->model->findOrFail($id);
            $tenant = auth()->user()->tenant;

            if ($request->hasFile('path') && $request->path->isValid()) {

                if (Storage::exists($product->path)) {
                    Storage::delete($product->path);
                }

                $data['path'] = $request->path->store("tenants/{$tenant->uuid}/products");
            }

            $product->update($data);
            return redirect()->route('admin.products.index')->with('success', 'Produto alterado com sucesso');
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
            $product = $this->model->findOrFail($id);

            if (Storage::exists($product->path)) {
                Storage::delete($product->path);
            }

            $product->delete();

            return redirect()->route('admin.products.index')->with('success', 'Produto removido com sucesso');
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $filters = $request->except('_token');
            $filter = $request->filter;

            $products = $this->model
                ->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('url', $filter)
                ->orWhere('price', 'LIKE', "%{$filter}%")
                ->orWhere('description', $filter)
                ->paginate();

            return view('products.index', compact('products', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }
}
