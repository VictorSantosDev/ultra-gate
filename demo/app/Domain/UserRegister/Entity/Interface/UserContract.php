<?php

namespace App\Domain\UserRegister\Entity\Interface;

use App\Data\Cpf\CPF;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\DeletedAt;
use App\Data\DateTime\UpdatedAt;

interface UserContract
{
    public function getId(): ?int;

    public function getName(): string;

    public function getEmail(): string;

    public function getCpf(): CPF;

    public function getBirthData(): string;

    public function getPassword(): string;

    public function getCreatedAt(): ?CreatedAt;

    public function getUpdatedAt(): ?UpdatedAt;

    public function getDeletedAt(): ?DeletedAt;

    /** @return array<string, mixed> */
    public function jsonSerialize(): array;
}
