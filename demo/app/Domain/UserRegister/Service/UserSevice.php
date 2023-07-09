<?php

namespace App\Domain\UserRegister\Service;

use App\Domain\UserRegister\Entity\Interface\UserContract;
use App\Infrastructure\UserRegister\Repository\UserRegisterRepository;
use App\Domain\UserRegister\Infrastructure\Repository\InterfaceUserRegisterRepository;

class UserSevice
{
    private InterfaceUserRegisterRepository $userRegisterRepository;

    public function __construct(
        UserRegisterRepository $userRegisterRepository
    ) {
        $this->userRegisterRepository = $userRegisterRepository;
    }

    public function getUserById(int $id): UserContract
    {
        return $this->userRegisterRepository->getUserById($id);
    }
}
