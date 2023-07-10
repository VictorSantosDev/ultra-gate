<?php

namespace App\Domain\Address\Infrastructure\Repostiory;

use App\Domain\Address\Entity\Interface\AddressContract;

interface InterfaceAddressRepository
{
    public function getAddressByUserId(int $userId): ?AddressContract;
}
