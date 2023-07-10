<?php

namespace App\Domain\UserRegister\Service;

use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\UserRegister\Factory\UserFactory;
use App\Infrastructure\UserRegister\Entity\UserRegisterEntity;
use App\Domain\UserRegister\Infrastructure\Entity\InterfaceUserRegisterEntity;
use App\Models\BankAccount;

class UserRegisterService
{
    private InterfaceUserRegisterEntity $userRegisterEntity;

    public function __construct(
        UserRegisterEntity $userRegisterEntity
    ) {
        $this->userRegisterEntity = $userRegisterEntity;
    }

    /** 
     * @param array $data
     * @return array<mixed>
     */
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

        BankAccount::create([
            'user_id' => $user->getId(),
            'value_by_count' => 0,
            'status' => 1,
        ]);

        return $user->jsonSerialize();
    }

    private function generatePassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function getUserById()
    {
        
    }
}
