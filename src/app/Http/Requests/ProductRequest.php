<?php

namespace App\Http\Requests;

use App\Tenant\Rules\UniqueTenant;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => [
                'required',
                'min:3',
                'max:50',
                new UniqueTenant('products', $this->segment(2), 'id')
            ],
            'price' => 'required',
            'path' => 'required',
        ];

        if ($this->segment(2)) {
            $rules = [
                'name' => [
                    'required',
                    'min:3',
                    'max:50',
                    new UniqueTenant('products', $this->segment(2), 'id', 'Nome')
                ],
                'price' => 'required',
            ];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'name.unique' => 'Já existe um Produto cadastrado com esse Nome',
            'name.min'  => 'O campo Nome deve ter no mínimo 3 carateres',
            'name.max'  => 'O campo Nome deve ter no máximo 50 carateres',
            'price.required'  => 'O campo Preço é obrigatório',
            'path.required'  => 'O campo Imagem é obrigatório',
        ];
    }
}
