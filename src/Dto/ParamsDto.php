<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enum\Language;
use DateTimeImmutable;
use DateTimeInterface;

final class ParamsDto
{
    private const DATE_TIME_FORMAT = 'YYYY-mm-dd HH:mm:ss';

    private ?Language $textlanguage;
    private ?DateTimeInterface $updatedFrom;
    private ?DateTimeInterface $updatedTo;

    /**
     * @param int[] $workfieldIds
     * @param int[] $officeIds
     * @param int[] $filterIds
     * @param int[] $channelIds
     */
    public function __construct(
        private int $limit = 10,
        private int $page = 1,
        private bool $withAutomation = false,
        ?string $textlanguage = null,
        private array $workfieldIds = [],
        private array $officeIds = [],
        private array $filterIds = [],
        private array $channelIds = [],
        private ?string $orderBy = null,
        private ?int $activityState = null,
        private ?int $accessState = null,
        private ?int $withRewards = null,
        ?string $updatedFrom = null,
        ?string $updatedTo = null,
    ) {
        $this->textlanguage = $textlanguage !== null ? Language::from($textlanguage) : null;
        $this->updatedFrom = $updatedFrom !== null ? new DateTimeImmutable($updatedFrom) : null;
        $this->updatedTo = $updatedTo !== null ? new DateTimeImmutable($updatedTo) : null;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getWithAutomation(): bool
    {
        return $this->withAutomation;
    }

    public function getTextlanguage(): ?Language
    {
        return $this->textlanguage;
    }

    /**
     * @return int[]
     */
    public function getWorkfieldIds(): array
    {
        return $this->workfieldIds;
    }

    /**
     * @return int[]
     */
    public function getOfficeIds(): array
    {
        return $this->officeIds;
    }

    /**
     * @return int[]
     */
    public function getFilterIds(): array
    {
        return $this->filterIds;
    }

    /**
     * @return int[]
     */
    public function getChannelIds(): array
    {
        return $this->channelIds;
    }

    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    public function getActivityState(): ?int
    {
        return $this->activityState;
    }

    public function getAccessState(): ?int
    {
        return $this->accessState;
    }

    public function getWithRewards(): ?int
    {
        return $this->withRewards;
    }

    public function getUpdatedFrom(): ?DateTimeInterface
    {
        return $this->updatedFrom;
    }

    public function getUpdatedTo(): ?DateTimeInterface
    {
        return $this->updatedTo;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $params = [
            'limit' => $this->limit,
            'page' => $this->page,
            'with_automation' => (int) $this->withAutomation,
            'text_language' => $this->textlanguage?->value,
            'workfield_ids' => $this->workfieldIds,
            'office_ids' => $this->officeIds,
            'filter_ids' => $this->filterIds,
            'channel_ids' => $this->channelIds,
            'order_by' => $this->orderBy,
            'activity_state' => $this->activityState,
            'access_state' => $this->accessState,
            'with_rewards' => $this->withRewards,
            'updated_from' => $this->updatedFrom?->format(self::DATE_TIME_FORMAT),
            'updated_to' => $this->updatedTo?->format(self::DATE_TIME_FORMAT),
        ];
        $notNullParams = array_filter($params, fn($param) => $param !== null && $param !== []);

        return $notNullParams;
    }
}