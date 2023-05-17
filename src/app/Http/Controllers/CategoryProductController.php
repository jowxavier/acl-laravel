<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exceptions\CustomFindException;
use App\Http\Requests\CategoryProductRequest;

class CategoryProductController extends Controller
{
    /**
     * @var \App\Models\Product
     */
    protected $product;

    /**
     * @var \App\Models\Category
     */
    protected $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Lista as Categorias do Produto.
     *
     * @param int $productId
     * @return \Illuminate\Http\Response
     */
    public function index($productId)
    {
        try {
            $product = $this->product->findOrFail($productId);
            $categories = $product->categories()->paginate();
            return view('products.categories.index', compact('product', 'categories'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Exibe as Categorias disponíveis no Produto.
     * Filtro de busca de Categorias relacionadas ao Produto.
     *
     * @param int $productId
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $productId)
    {
        try {
            $product = $this->product->findOrFail($productId);

            $filters = $request->except('_token');
            $categories = $product->categoriesAvailable($request->filter);
            return view('products.categories.create', compact('product', 'categories', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Cria o relacionamento das Categorias com o Produto.
     *
     * @param int $productId
     * @param \App\Http\Requests\CategoryProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryProductRequest $request, $productId)
    {
        try {
            $product = $this->product->findOrFail($productId);
            $product->categories()->attach($request->categories);

            return redirect()->route('admin.products.categories.index', $product->id)->with('success', "Categorias vinculadas ao Produto {$product->name} com sucesso");
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Remove o relacionamento das Categorias com o Produto.
     *
     * @param int $productId
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId, $id)
    {
        try {
            $product = $this->product->find($productId);
            $category = $this->category->find($id);
            $product->categories()->detach($category);
            return redirect()->route('admin.products.categories.index', $product->id)->with('success', "Categorias desvinculadas do Produto {$product->name} com sucesso");
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }

    /**
     * Filtro de busca de Categorias relacionadas ao Produto.
     *
     * @param int $productId
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function search($productId, Request $request)
    {
        try {
            $filters = $request->except('_token');
            $filter = $request->filter;

            $product = $this->product->findOrFail($productId);
            $categories = $this->category
                ->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', $filter)
                ->paginate();

            return view('products.categories.index', compact('product', 'categories', 'filters'));
        } catch (\Exception $e) {
            throw new CustomFindException($e->getMessage());
        }
    }
}
