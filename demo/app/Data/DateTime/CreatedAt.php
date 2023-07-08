<?php

namespace App\Data\DateTime;

class CreatedAt extends DateTimeAbstract implements \JsonSerializable
{
    public function now(string $format = 'Y-m-d'): string
    {
        return $this->dateTime()->format($format);
    }

    public function jsonSerialize(): array
    {
        return $this->json();
    }
}
