<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array */
    public function rules(): array
    {
        return [
            'name' => 'required|min:4|max:255',
            'birthData' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $this->validateBirthDate( $value, $fail);
                }
            ],
            // 'cpf' => 'required',
            // 'email' => 'required',
            // 'emailConfirmed' => 'required',
            // 'password' => 'required',
            // 'password_confirmation' => '<PASSWORD>',
        ];
    }

    /** @return array */
    public function messages(): array
    {
        return [

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
}
