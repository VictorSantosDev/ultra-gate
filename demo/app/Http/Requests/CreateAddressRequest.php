<?php

namespace App\Http\Requests;

use Closure;
use App\Data\Cep\CEP;
use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array */
    public function rules(): array
    {
        return [
            'userId' => 'required|integer',
            'cep' => [
                'required',
                'string',
                'min:9',
                'max:9',
                function (string $attribute, mixed $value, Closure $fail) {
                    $this->validateCep($value, $fail);
                }
            ],
            'complement' => 'required|max:150',
            'number' => 'required|string|min:1|max:15',
        ];
    }

    /** @return array */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo :attribute aceita no máximo :max.',
            'min' => 'O campo :attribute aceita no mínimo :min.',
        ];
    }

    private function validateCep(mixed $value, Closure $fail): void
    {
        if (!(new CEP)->validatorCep($value)) {
            $fail('O cep informado é inválio.');
        }
    }
}
