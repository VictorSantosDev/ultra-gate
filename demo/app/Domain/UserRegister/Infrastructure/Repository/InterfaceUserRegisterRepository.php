<?php

namespace App\Domain\UserRegister\Infrastructure\Repository;

use App\Domain\UserRegister\Entity\Interface\UserContract;

interface InterfaceUserRegisterRepository
{
    public function getUserById(int $id): UserContract;
}
