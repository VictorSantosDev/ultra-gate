<?php

namespace App\Domain\Address\Integration\VieCep\Entity;

interface AddressViaCepContract
{
    public function getCep(): ?string;
    
    public function getLogradouro(): ?string;
    
    public function getComplemento(): ?string;
    
    public function getBairro(): ?string;
    
    public function getLocalidade(): ?string;
    
    public function getUf(): ?string;
    
    public function getIbge(): ?string;
    
    public function getGia(): ?string;
    
    public function getDdd(): ?string;
    
    public function getSiafi(): ?string;
    
    public function jsonSerialize(): mixed;
}
