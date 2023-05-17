<?php

namespace App\Models\Traits\Relationships;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;

trait TenantRelationship {

    /**
     * Retorna o usuário de um inquilino.
     *
     * @return string
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Retorna a categoria de um inquilino.
     *
     * @return string
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Retorna o produto de um inquilino.
     *
     * @return string
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
