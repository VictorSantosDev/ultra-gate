<?php

namespace App\Domain\Address\Service;

use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\Address\Factory\AddressFactory;
use App\Domain\UserRegister\Service\UserSevice;
use App\Domain\Address\Integration\VieCep\ViaCepApi;

class AddressService
{
    private UserSevice $userSevice;
    
    public function __construct()
    {
        $this->userSevice = resolve(UserSevice::class);
    }

    /** 
     * @todo implement validation and save address
     * @param array $data
     */
    public function create(array $data)
    {
        $user = $this->userSevice->getUserById($data['userId']);

        // check addresses already exist
        
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

        // save address
    }
}
