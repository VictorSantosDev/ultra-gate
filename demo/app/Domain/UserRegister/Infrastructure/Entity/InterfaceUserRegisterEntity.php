<?php

namespace App\Domain\UserRegister\Infrastructure\Entity;

use App\Domain\UserRegister\Entity\Interface\UserContract;

interface InterfaceUserRegisterEntity
{
    public function save(UserContract $user): UserContract;
}
