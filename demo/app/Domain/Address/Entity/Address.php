<?php

namespace App\Domain\Address\Entity;

use App\Data\Cep\CEP;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\DeletedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\Address\Entity\Interface\AddressContract;

class Address implements AddressContract, \JsonSerializable
{
    public function __construct(
        private ?int $id,
        private ?int $userId,
        private CEP $cep,
        private ?string $street,
        private ?string $complement,
        private ?string $neighborhood,
        private ?string $number,
        private ?string $locality,
        private ?string $uf,
        private ?string $ibge,
        private ?string $gia,
        private ?string $ddd,
        private ?string $siafi,
        private ?CreatedAt $createdAt,
        private ?UpdatedAt $updatedAt,
        private ?DeletedAt $deletedAt
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId():?int
    {
        return $this->userId;
    }

    public function getCep(): CEP
    {
        return $this->cep;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
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

    public function getCreatedAt(): ?CreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?UpdatedAt
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?DeletedAt
    {
        return $this->deletedAt;
    }


    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->getId(),
            'userId' => $this->getUserId(),
            'cep' => $this->getCep(),
            'street' => $this->getStreet(),
            'complement' => $this->getComplement(),
            'neighborhood' => $this->getNeighborhood(),
            'neighborhood' => $this->getNumber(),
            'locality' => $this->getLocality(),
            'uf' => $this->getUf(),
            'ibge' => $this->getIbge(),
            'gia' => $this->getGia(),
            'ddd' => $this->getDdd(),
            'siafi' => $this->getSiafi(),
            'createdAt' => $this->getCreatedAt()?->jsonSerialize(),
            'updatedAt' => $this->getUpdatedAt()?->jsonSerialize()
        ];
    }
}
