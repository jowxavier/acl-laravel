<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
            'cnpj' => 'required|unique:tenants,cnpj,'.$this->segment(2).',id|min:3|max:50',
            'company' => 'required|min:3|max:50',
            'email' => 'required',
            'logo' => 'required',
        ];

        if ($this->segment(2)) {
            $rules = [
                'cnpj' => 'required|unique:tenants,cnpj,'.$this->segment(2).',id|min:3|max:50',
                'company' => 'required|min:3|max:50',
                'email' => 'required',
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
            'company.required' => 'O campo Empresa é obrigatório',
            'company.unique' => 'Já existe uma Empresa cadastrada com esse CNPJ',
            'company.min'  => 'O campo Empresa deve ter no mínimo 3 carateres',
            'company.max'  => 'O campo Empresa deve ter no máximo 50 carateres',
            'email.required'  => 'O campo Email é obrigatório',
            'logo.required'  => 'O campo Logo é obrigatório',
        ];
    }
}
