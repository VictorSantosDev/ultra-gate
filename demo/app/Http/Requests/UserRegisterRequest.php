<?php

namespace App\Http\Requests;

use App\Data\Cpf\CPF;
use Carbon\Carbon;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    private const VALIDATOR_PASSWORD_REGEX = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/';

    public function authorize(): bool
    {
        return true;
    }

    /** @return array */
    public function rules(): array
    {
        return [
            'name' => 'required|min:4|max:150',
            'birthData' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $this->validateBirthDate( $value, $fail);
                }
            ],
            'cpf' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $this->validateCpf( $value, $fail);
                }
            ],
            'email' => 'required|email|unique:users,email|max:255',
            'emailConfirmation' => 'required|email|max:255|same:email',
            'password' => 'required|max:255|regex:'.self::VALIDATOR_PASSWORD_REGEX,
            'password_confirmation' => 'required|max:255|same:password',
        ];
    }

    /** @return array */
    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'O e-mail informado é inválido.',
            'email.unique' => 'O e-mail informado já está cadastrado.',
            'emailConfirmation.same' => 'O e-mail informado deve ser igual ao e-mail informado anteriormente.',
            'max' => 'O campo :attribute deve conter no mínimo :max caracteres.',
            'min' => 'O campo :attribute deve conter no mínimo :min caracteres.',
            'password.regex' => '
                O campo :attribute deve ter as seguintes regras, deve conter ao menos um dígito, 
                deve conter ao menos uma letra minúscula,
                deve conter ao menos uma letra maiúscula,
                deve conter ao menos um caractere especial,
                deve conter ao menos 8 caracteres.
            ',
            'password_confirmation.same' => 'O campo :attribute deve ser igual ao campo password anterior.',
        ];
    }

    private function validateBirthDate(
        mixed $value,
        Closure $fail
    ): void {
        $carbon = new Carbon();
        $currentDate = $carbon->now();
        $minimumDate = $currentDate->subYears(18);

        if ($carbon::parse($value)->greaterThan($minimumDate)) {
            $fail('Você deve ter pelo menos 18 anos de idade.');
        }
    }

    private function validateCpf(
        mixed $value,
        Closure $fail
    ): void {
        if(!(new CPF)->validatorCpf($value)){
            $fail('O Cpf informado é inválido.');
        }
    }
}
