<?php

declare(strict_types=1);

namespace App\Dto;

class FilterDto extends NamedDto
{
    public function __construct(
        int $id,
        string $name,
        private string $group,
        private int $groupId,
    ) {
        parent::__construct($id, $name);
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }
}
