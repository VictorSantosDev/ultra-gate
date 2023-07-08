<?php

namespace App\Domain\UserRegister\Factory;

use App\Data\Cpf\CPF;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\DeletedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\UserRegister\Entity\Interface\UserContract;
use App\Domain\UserRegister\Entity\User;

class UserFactory
{
    public static function userCreate(
        ?int $id,
        string $name,
        string $email,
        string $cpf,
        string $birthData,
        string $password,
        ?CreatedAt $createdAt,
        ?UpdatedAt $updatedAt,
        ?DeletedAt $deletedAt
    ) : UserContract {
        return new User(
            $id,
            $name,
            $email,
            new CPF($cpf),
            $birthData,
            $password,
            $createdAt,
            $updatedAt,
            $deletedAt
        );
    }
}
