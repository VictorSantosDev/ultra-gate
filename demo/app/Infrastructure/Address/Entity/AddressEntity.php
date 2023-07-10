<?php

namespace App\Infrastructure\Address\Entity;

use App\Models\Address;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\Address\Factory\AddressFactory;
use App\Domain\Address\Entity\Interface\AddressContract;
use App\Domain\Address\Infrastructure\Entity\InterfaceAddressEntity;

class AddressEntity implements InterfaceAddressEntity
{
    private Address $qb;

    public function __construct()
    {
        $this->qb = new Address;
    }

    public function save(AddressContract $address): AddressContract
    {
        $entity = $this->qb::create([
            'user_id' => $address->getUserId(),
            'cep' => $address->getCep(),
            'street' => $address->getStreet(),
            'complement' => $address->getComplement(),
            'neighborhood' => $address->getNeighborhood(),
            'number' => $address->getNumber(),
            'locality' => $address->getLocality(),
            'uf' => $address->getUF(),
            'ibge' => $address->getIbge(),
            'gia' => $address->getGia(),
            'ddd' => $address->getDdd(),
            'siafi' => $address->getSiafi()
        ]);
 
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
