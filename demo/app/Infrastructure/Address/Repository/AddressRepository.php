<?php

namespace App\Infrastructure\Address\Repository;

use App\Models\Address;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\Address\Factory\AddressFactory;
use App\Domain\Address\Entity\Interface\AddressContract;
use App\Domain\Address\Infrastructure\Repostiory\InterfaceAddressRepository;

class AddressRepository implements InterfaceAddressRepository
{
    private Address $qb;

    public function __construct()
    {
        $this->qb = new Address;
    }

    public function getAddressByUserId(int $userId): ?AddressContract
    {
        $entity = $this->qb::where('user_id', $userId)->first();

        if(!$entity){
            return null;
        }

        return AddressFactory::createAddress(
            $entity['id'],
            $entity['user_id'],
            $entity['cep'],
            $entity['street'],
            $entity['complement'],
            $entity['neighborhood'],
            $entity['number'],
            $entity['locality'],
            $entity['uf'],
            $entity['ibge'],
            $entity['gia'],
            $entity['ddd'],
            $entity['siafi'],
            $entity['created_at'] ? new CreatedAt($entity['created_at']) : null,
            $entity['updated_at'] ? new UpdatedAt($entity['updated_at']) : null,
            null
        );
    }
}
