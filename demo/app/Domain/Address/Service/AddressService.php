<?php

namespace App\Domain\Address\Service;

use Exception;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\Address\Factory\AddressFactory;
use App\Domain\UserRegister\Service\UserSevice;
use App\Domain\Address\Integration\VieCep\ViaCepApi;
use App\Infrastructure\Address\Entity\AddressEntity;
use App\Infrastructure\Address\Repository\AddressRepository;
use App\Domain\Address\Infrastructure\Entity\InterfaceAddressEntity;
use App\Domain\Address\Infrastructure\Repostiory\InterfaceAddressRepository;

class AddressService
{
    private UserSevice $userSevice;
    
    private InterfaceAddressEntity $addressEntity;

    private InterfaceAddressRepository $addressRepository;
    
    public function __construct(
        AddressEntity $addressEntity,
        AddressRepository $addressRepository
    ) {
        $this->addressEntity = $addressEntity;
        $this->addressRepository = $addressRepository;
        $this->userSevice = resolve(UserSevice::class);
    }

    /** 
     * @todo implement validation and save address
     * @param array $data
     */
    public function create(array $data)
    {
        $user = $this->userSevice->getUserById($data['userId']);

        $this->checkAddressExist($user->getId());

        $viaCep = (new ViaCepApi)->getAddress($data['cep']);

        $createAddress = AddressFactory::createAddress(
            null,
            $user->getId(),
            $data['cep'],
            $viaCep->getLogradouro(),
            $data['complement'],
            $viaCep->getBairro(),
            $data['number'],
            $viaCep->getLocalidade(),
            $viaCep->getUf(),
            $viaCep->getIbge(),
            $viaCep->getGia(),
            $viaCep->getDdd(),
            $viaCep->getSiafi(),
            new CreatedAt(),
            new UpdatedAt(),
            null
        );

        return $this->addressEntity->save($createAddress)->jsonSerialize();
    }

    private function checkAddressExist(int $userId): void
    {
        if ($this->addressRepository->getAddressByUserId($userId)) {
            throw new Exception(
                'O usuário já tem um endereço cadastrado, caso necessário atualize.'
            );
        }
    }
}
