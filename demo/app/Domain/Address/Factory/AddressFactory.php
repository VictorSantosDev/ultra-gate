<?php

namespace App\Domain\Address\Factory;

use App\Data\Cep\CEP;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\DeletedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\Address\Entity\Address;
use App\Domain\Address\Entity\Interface\AddressContract;

class AddressFactory
{
    public static function createAddress(
        ?int $id,
        ?int $userId,
        ?string $cep,
        ?string $street,
        ?string $complement,
        ?string $neighborhood,
        ?string $number,
        ?string $locality,
        ?string $uf,
        ?string $ibge,
        ?string $gia,
        ?string $ddd,
        ?string $siafi,
        ?CreatedAt $createdAt,
        ?UpdatedAt $updatedAt,
        ?DeletedAt $deletedAt
    ): AddressContract {
        return new Address(
            $id,
            $userId,
            new CEP($cep),
            $street,
            $complement,
            $neighborhood,
            $number,
            $locality,
            $uf,
            $ibge,
            $gia,
            $ddd,
            $siafi,
            $createdAt,
            $updatedAt,
            $deletedAt
        );
    }
}
