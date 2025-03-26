<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|size:11|unique:users,cpf',
            'birthdate' => 'required|date|before:today',
        ];
    }

    public function messages()
{
    return [
        'cpf.unique' => 'O CPF informado já está em uso.',
        'cpf.required' => 'O CPF é obrigatório.',
        'birthdate.required' => 'A data de nascimento é obrigatória.',
        'birthdate.date' => 'A data de nascimento deve ser uma data válida.',
        'name.required' => 'O nome é obrigatório.'
    ];
}

}
