<?php

namespace App\Data\Cpf;

class CPF extends ValidatorCpf
{
    public function __construct(
        private $value = ''
    ) {  
    }

    public function __toString(): string
    {
        return $this->getCpf($this->value);
    }
}
