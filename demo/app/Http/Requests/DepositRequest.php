<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string> */
    public function rules(): array
    {
        return [
            'userId' => 'required|integer',
            'value' => 'required|integer|min:1|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O :attribute é um campo obrigatório.',
            'integer' => 'Esse campo deve ser do tipo inteiro.',
            'value.min' => 'O valor mínimo é R$ 1.',
            'value.max' => 'O valor máximo é R$ 1000.'
        ];
    }
}
