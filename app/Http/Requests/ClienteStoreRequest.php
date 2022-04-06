<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteStoreRequest extends FormRequest
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
        return [
            'nome' => ['required','string','max:255'],
            'cpf' => ['required','string','max:14','cpf','unique:clientes,cpf'],
            'email' => ['required','string','email','max:255','unique:clientes,email'],
        ];
    }
}
