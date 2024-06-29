<?php

declare(strict_types=1);

namespace App\Dto;

class JobsResponseDto
{
    /**
     * @param JobDto[] $payload
     */
    public function __construct(
        private array $payload,
        private MetaDto $meta,
    ) {
    }

    /**
     * @return JobDto[]
     */
    public function getJobs(): array
    {
        return $this->payload;
    }

    public function getMeta(): MetaDto
    {
        return $this->meta;
    }
}