<?php

namespace App\Infrastructure\UserRegister\Entity;

use App\Models\User;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\UserRegister\Factory\UserFactory;
use App\Domain\UserRegister\Entity\Interface\UserContract;
use App\Domain\UserRegister\Infrastructure\Entity\InterfaceUserRegisterEntity;

class UserRegisterEntity implements InterfaceUserRegisterEntity
{
    private User $qb;

    public function __construct()
    {
        $this->qb = new User;
    }

    public function save(UserContract $user): UserContract
    {
        $entity = $this->qb::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'cpf' => $user->getCpf()->__toString(),
            'birth_data' => $user->getBirthData(),
            'password' => $user->getPassword(),
        ]);

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
