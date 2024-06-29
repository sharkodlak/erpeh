<?php

declare(strict_types=1);

namespace App\Dto;

class MetaDto
{
    public function __construct(
        private string $code,
        private string $message,
        private int $duration,
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
}
