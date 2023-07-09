<?php

namespace App\Domain\Address\Integration\VieCep\Entity;

class AddressViaCep implements AddressViaCepContract, \JsonSerializable
{
    public function __construct(
        private ?string $cep,
        private ?string $logradouro,
        private ?string $complemento,
        private ?string $bairro,
        private ?string $localidade,
        private ?string $uf,
        private ?string $ibge,
        private ?string $gia,
        private ?string $ddd,
        private ?string $siafi
    ) {
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function getLogradouro(): ?string
    {
        return $this->logradouro;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function getLocalidade(): ?string
    {
        return $this->localidade;
    }

    public function getUf(): ?string
    {
        return $this->uf;
    }

    public function getIbge(): ?string
    {
        return $this->ibge;
    }

    public function getGia(): ?string
    {
        return $this->gia;
    }

    public function getDdd(): ?string
    {
        return $this->ddd;
    }

    public function getSiafi(): ?string
    {
        return $this->siafi;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'cep' => $this->getCep(),
            'logradouro' => $this->getLogradouro(),
            'complemento' => $this->getComplemento(),
            'bairro' => $this->getBairro(),
            'localidade' => $this->getLocalidade(),
            'uf' => $this->getUf(),
            'ibge' => $this->getIbge(),
            'gia' => $this->getGia(),
            'ddd' => $this->getDdd(),
            'siafi' => $this->getSiafi()
        ];
    }
}
