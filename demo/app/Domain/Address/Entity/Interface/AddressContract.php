<?php

namespace App\Domain\Address\Entity\Interface;

use App\Data\Cep\CEP;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\DeletedAt;
use App\Data\DateTime\UpdatedAt;

interface AddressContract
{
    public function getId(): ?int;

    public function getUserId():?int;

    public function getCep(): CEP;

    public function getStreet(): ?string;

    public function getComplement(): ?string;

    public function getNeighborhood(): ?string;

    public function getNumber(): ?string;

    public function getLocality(): ?string;

    public function getUf(): ?string;

    public function getIbge(): ?string;

    public function getGia(): ?string;

    public function getDdd(): ?string;

    public function getSiafi(): ?string;

    public function getCreatedAt(): ?CreatedAt;

    public function getUpdatedAt(): ?UpdatedAt;

    public function getDeletedAt(): ?DeletedAt;

    public function jsonSerialize(): mixed;
}
