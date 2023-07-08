<?php

namespace App\Data\DateTime;

use DateTime;

abstract class DateTimeAbstract extends \DateTimeImmutable implements \DateTimeInterface
{
    public function toDataBase(): string
    {
        return $this->dateTime()->format('Y-m-d H:i:s');
    }

    public function toData(): string
    {
        return $this->dateTime()->format('Y-m-d');
    }

    protected function json(): array
    {
        return [
            'pt-br' => $this->dateTime()->format('d/m/Y H:i:s'),
            'en-us' => $this->dateTime()->format('Y-m-d H:i:s'),
        ];
    }

    protected function dateTime(): DateTime
    {
        return new DateTime();
    }
}
