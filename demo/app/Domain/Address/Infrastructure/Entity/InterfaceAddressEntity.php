<?php

namespace App\Domain\Address\Infrastructure\Entity;

use App\Domain\Address\Entity\Interface\AddressContract;

interface InterfaceAddressEntity
{
    public function save(AddressContract $address): AddressContract;
}
