<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Scopes\LocalScope;
use App\Models\Traits\Mutators\ProductMutator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\Relationships\ProductRelationship;

class Product extends Model
{
    use TenantTrait, LocalScope, ProductMutator, ProductRelationship, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'path',
        'description'
    ];

    /**
     * Retorna as categorias disponiveis para o produto
     */
    public function categoriesAvailable($filter = null)
    {
        $categories = Category::whereNotIn('id', function($query) {
            $query->select('category_id');
            $query->from('category_product');
            $query->where('product_id', $this->id);
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $categories;
    }
}
