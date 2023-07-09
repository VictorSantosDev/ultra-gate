<?php

namespace App\Data\Cep;

class ValidatorCep
{
    private const REMOVE_CARACTER_CEP_REGEX = '/[^0-9]/';

    protected string $cep = '';

    public function validatorCep(string $cep): bool
    {
        $cep = preg_replace(self::REMOVE_CARACTER_CEP_REGEX, '', $cep);

        if(mb_strlen($cep) < 8 || mb_strlen($cep) > 8){
            return false;
        }

        return true;
    }

    protected function getCep(string $value): string
    {
        self::validatorCep($value);
        return $this->cep;
    }
}
