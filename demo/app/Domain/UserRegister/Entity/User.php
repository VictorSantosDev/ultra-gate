<?php

namespace App\Domain\UserRegister\Entity;

use App\Data\Cpf\CPF;
use App\Data\DateTime\CreatedAt;
use App\Data\DateTime\DeletedAt;
use App\Data\DateTime\UpdatedAt;
use App\Domain\UserRegister\Entity\Interface\UserContract;

class User implements UserContract, \JsonSerializable
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $email,
        private CPF $cpf,
        private string $birthData,
        private string $password,
        private ?CreatedAt $createdAt,
        private ?UpdatedAt $updatedAt,
        private ?DeletedAt $deletedAt
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCpf(): CPF
    {
        return $this->cpf;
    }

    public function getBirthData(): string
    {
        return $this->birthData;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): ?CreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?UpdatedAt
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?DeletedAt
    {
        return $this->deletedAt;
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->email,
            'cpf' => $this->getCpf()->__toString(),
            'birthData' => $this->getBirthData(),
            'createdAt' => $this->getCreatedAt()?->jsonSerialize(),
            'updatedAt' => $this->getUpdatedAt()?->jsonSerialize(),
        ];
    }
}
