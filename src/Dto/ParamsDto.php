<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enum\Language;
use DateTimeInterface;

final class ParamsDto
{
    private const DATE_TIME_FORMAT = 'YYYY-mm-dd HH:mm:ss';

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
        private ?Language $textlanguage = null,
        private array $workfieldIds = [],
        private array $officeIds = [],
        private array $filterIds = [],
        private array $channelIds = [],
        private ?string $orderBy = null,
        private ?int $activityState = null,
        private ?int $accessState = null,
        private ?int $withRewards = null,
        private ?DateTimeInterface $updatedfrom = null,
        private ?DateTimeInterface $updatedto = null,
    ) {
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
            'text_language' => $this->textlanguage->value,
            'workfield_ids' => $this->workfieldIds,
            'office_ids' => $this->officeIds,
            'filter_ids' => $this->filterIds,
            'channel_ids' => $this->channelIds,
            'order_by' => $this->orderBy,
            'activity_state' => $this->activityState,
            'access_state' => $this->accessState,
            'with_rewards' => $this->withRewards,
            'updated_from' => $this->updatedfrom?->format(self::DATE_TIME_FORMAT),
            'updated_to' => $this->updatedto?->format(self::DATE_TIME_FORMAT),
        ];
        $notNullParams = array_filter($params, fn($param) => $param !== null && $param !== []);

        return $notNullParams;
    }
}