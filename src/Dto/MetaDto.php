<?php

declare(strict_types=1);

namespace App\Dto;

class MetaDto
{
    public function __construct(
        private string $code,
        private string $message,
        private int $duration,
        private ?int $entriesFrom,
        private ?int $entriesTo,
        private ?int $entriesTotal,
        private ?int $entriesSum,
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getEntriesFrom(): ?int
    {
        return $this->entriesFrom;
    }

    public function getEntriesTo(): ?int
    {
        return $this->entriesTo;
    }

    public function getEntriesTotal(): ?int
    {
        return $this->entriesTotal;
    }

    public function getEntriesSum(): ?int
    {
        return $this->entriesSum;
    }
}
