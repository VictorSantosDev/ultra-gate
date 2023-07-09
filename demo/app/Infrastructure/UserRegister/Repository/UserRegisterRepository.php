<?php

namespace App\Infrastructure\UserRegister\Repository;

use Exception;
use App\Models\User;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\UserRegister\Factory\UserFactory;
use App\Domain\UserRegister\Entity\Interface\UserContract;
use App\Domain\UserRegister\Infrastructure\Repository\InterfaceUserRegisterRepository;

class UserRegisterRepository implements InterfaceUserRegisterRepository
{
    private User $qb;

    public function __construct()
    {
        $this->qb = new User;
    }

    public function getUserById(int $id): UserContract
    {
        $entity = $this->qb::where('id', $id)->first();

        if(!$entity){
            throw new Exception('Usuário não encontrado.');
        }

        return UserFactory::userCreate(
            $entity['id'],
            $entity['name'],
            $entity['email'],
            $entity['cpf'],
            $entity['birth_data'],
            $entity['password'],
            $entity['created_at'] ? new CreatedAt($entity['created_at']) : null,
            $entity['updated_at'] ? new UpdatedAt($entity['updated_at']) : null,
            null
        );
    }
}
