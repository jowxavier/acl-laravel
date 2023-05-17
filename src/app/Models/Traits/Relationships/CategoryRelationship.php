<?php

namespace App\Models\Traits\Relationships;

use App\Models\Tenant;
use App\Models\Product;

trait CategoryRelationship {

    /**
     * Retorna os produtos da categoria.
     *
     * @return string
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Retorna o inquilino de uma categoria.
     *
     * @return string
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}