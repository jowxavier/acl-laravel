<?php

namespace App\Models\Traits\Relationships;

use App\Models\Tenant;
use App\Models\Category;

trait ProductRelationship {

    /**
     * Retorna as categorias do produto.
     *
     * @return string
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Retorna o inquilino do produto.
     *
     * @return string
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
