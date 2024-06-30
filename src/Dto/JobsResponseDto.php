<?php

declare(strict_types=1);

namespace App\Dto;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

/**
 * @implements IteratorAggregate<JobDto>
 */
class JobsResponseDto implements IteratorAggregate
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

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->payload);
    }
}