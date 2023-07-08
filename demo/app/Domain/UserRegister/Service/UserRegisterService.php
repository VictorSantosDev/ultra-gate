<?php

namespace App\Domain\UserRegister\Service;

use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\UserRegister\Factory\UserFactory;
use App\Infrastructure\UserRegister\Entity\UserRegisterEntity;
use App\Domain\UserRegister\Infrastructure\Entity\InterfaceUserRegisterEntity;

class UserRegisterService
{
    private InterfaceUserRegisterEntity $userRegisterEntity;

    public function __construct(
        UserRegisterEntity $userRegisterEntity
    ) {
        $this->userRegisterEntity = $userRegisterEntity;
    }

    /** @return array<mixed> */
    public function register(array $data): array
    {
        $createdUser = UserFactory::userCreate(
            null,
            $data['name'],
            $data['email'],
            $data['cpf'],
            $data['birthData'],
            $this->generatePassword($data['password']),
            new CreatedAt(),
            new UpdatedAt(),
            null
        );

        $user = $this->userRegisterEntity->save($createdUser);
        return $user->jsonSerialize();
    }

    private function generatePassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
