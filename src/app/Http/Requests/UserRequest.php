<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->segment(2).',id',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:6',
        ];

        if ($this->segment(2)) {
            $rules = [
                'name' => 'required',
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
            'email.required' => 'O campo Email é obrigatório',
            'email.email' => 'Formato inválido para o campo Email',
            'email.unique' => 'Já existe um cadastrado com esse Email',
            'password.required' => 'O campo Senha é obrigatório',
            'password.min'  => 'O campo Senha deve ter no mínimo 4 carateres',
            'password.confirmed' => 'As senhas não conferem',
            'password_confirmation.required' => 'O campo Confirmar Senha é obrigatório',
            'password_confirmation.min'  => 'O campo Confirmar Senha deve ter no mínimo 4 carateres',
        ];
    }
}
