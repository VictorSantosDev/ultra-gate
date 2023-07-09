<?php

namespace App\Data\Cep;

class CEP extends ValidatorCep
{
    public function __construct(
        private $value = ''
    ) {  
    }

    public function __toString(): string
    {
        return $this->getCep($this->value);
    }
}