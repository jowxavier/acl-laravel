<?php

namespace App\Models\Traits\Mutators;

trait ProductMutator {

    /**
     * Exibe o Preço com o valor formatado.
     *
     * @param  string  $value
     * @return string
     */
    public function getPriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    /**
     * Seta o Preço com valor.
     *
     * @param  string  $value
     * @return string
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',', '.', $value);
    }
}