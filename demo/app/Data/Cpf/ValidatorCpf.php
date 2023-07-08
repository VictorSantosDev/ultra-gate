<?php

namespace App\Data\Cpf;

abstract class ValidatorCpf
{
    private const EXTRACT_NUMBERS_REGEX = '/[^0-9]/is';

    private const REPEATED_NUMBERS_REGEX = '/(\d)\1{10}/';

    protected string $cpf = '';

    public function validatorCpf(string $cpf): bool
    {
        $cpf = preg_replace(self::EXTRACT_NUMBERS_REGEX, '', $cpf );

        if (mb_strlen($cpf) != 11) {
            return false;
        }

        if (preg_match(self::REPEATED_NUMBERS_REGEX, $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        $this->cpf = $cpf;
        return true;
    }

    protected function getCpf(string $value): string
    {
        self::validatorCpf($value);
        return $this->cpf;
    }
}
