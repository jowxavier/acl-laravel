<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    protected $model = Product::class;

    public function byCategories(int $tenant_id, array $categories, int $per_page)
    {
        return DB::table('products')
                    ->join('category_product', 'category_product.product_id', '=', 'products.id')
                    ->join('categories', 'category_product.category_id', '=', 'categories.id')
                    ->where('products.tenant_id', $tenant_id)
                    ->where('categories.tenant_id', $tenant_id)
                    ->where(function ($query) use ($categories) {
                        if ($categories)
                            $query->whereIn('categories.url', $categories);
                    })
                    ->select('products.*')
                    ->paginate($per_page);
    }
}
