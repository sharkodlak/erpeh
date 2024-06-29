<?php

declare(strict_types=1);

namespace App\Dto;

use DateTimeInterface;

class JobDto
{
    /**
     * @param array{value: float, active: bool} $fte
     * @param array{id: int, name: string}[] $workfields
     * @param array{id: int, name: string, group: string, group_id: int}[]|null $filterList
     * @param array{id: int, name: string}[] $education
     * @param array<string, mixed> $details
     * @param array<string, mixed> $personalist
     * @param array<string, mixed> $contact
     * @param array<string, mixed>[]|null $sharing
     * @param array<string, mixed>[] $addresses
     * @param array<string, mixed>[] $employment
     * @param array<string, mixed> $stats
     * @param array<string, mixed> $salary
     * @param array<string, mixed> $channels
     * @param array<string, mixed>[] $referrals
     * @param array<string, mixed>[] $automations
     */
    public function __construct(
        private int $jobId,
        private string $securedId,
        private ?string $publicId,
        private int $accessState,
        private bool $draft,
        private bool $active,
        private string $title,
        private string $description,
        // private string $internalNote, // TODO: Update according to API fixed specification
        private ?DateTimeInterface $dateEnd,
        private ?DateTimeInterface $dateClosed,
        private ?int $closedDuration,
        private DateTimeInterface $lastUpdate,
        private DateTimeInterface $dateCreated,
        private string $textLanguage,
        private ?array $fte,
        private array $workfields,
        private ?array $filterList,
        private array $education,
        private ?bool $disability,
        private array $details,
        private array $personalist,
        private array $contact,
        private ?array $sharing,
        private array $addresses,
        private array $employment,
        private ?array $stats,
        private array $salary,
        private array $channels,
        private string $editLink,
        private string $publicLink,
        private array $referrals,
        private ?array $automations,
    ) {
    }

    public function getJobId(): int
    {
        return $this->jobId;
    }

    public function getSecuredId(): string
    {
        return $this->securedId;
    }

    public function getPublicId(): ?string
    {
        return $this->publicId;
    }

    public function getAccessState(): int
    {
        return $this->accessState;
    }

    public function isDraft(): bool
    {
        return $this->draft;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDateEnd(): ?DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function getDateClosed(): ?DateTimeInterface
    {
        return $this->dateClosed;
    }

    public function getClosedDuration(): ?int
    {
        return $this->closedDuration;
    }

    public function getLastUpdate(): DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function getDateCreated(): DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function getTextLanguage(): string
    {
        return $this->textLanguage;
    }

    /**
     * @return array{value: float, active: bool}
     */
    public function getFte(): array
    {
        return $this->fte;
    }

    /**
     * @return array{id: int, name: string}[]
     */
    public function getWorkfields(): array
    {
        return $this->workfields;
    }

    /**
     * @return array{id: int, name: string, group: string, group_id: int}[]|null
     */
    public function getFilterList(): ?array
    {
        return $this->filterList;
    }

    /**
     * @return array{id: int, name: string}[]
     */
    public function getEducation(): array
    {
        return $this->education;
    }

    public function getDisability(): ?bool
    {
        return $this->disability;
    }

    /**
     * @return array<string, mixed>
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @return array<string, mixed>
     */
    public function getPersonalist(): array
    {
        return $this->personalist;
    }

    /**
     * @return array<string, mixed>
     */
    public function getContact(): array
    {
        return $this->contact;
    }

    /**
     * @return array<string, mixed>[]|null
     */
    public function getSharing(): ?array
    {
        return $this->sharing;
    }

    /**
     * @return array<string, mixed>[]
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /**
     * @return array<string, mixed>[]
     */
    public function getEmployment(): array
    {
        return $this->employment;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getStats(): ?array
    {
        return $this->stats;
    }

    /**
     * @return array<string, mixed>
     */
    public function getSalary(): array
    {
        return $this->salary;
    }

    /**
     * @return array<string, mixed>
     */
    public function getChannels(): array
    {
        return $this->channels;
    }

    public function getEditLink(): string
    {
        return $this->editLink;
    }

    public function getPublicLink(): string
    {
        return $this->publicLink;
    }

    /**
     * @return array<string, mixed>[]
     */
    public function getReferrals(): array
    {
        return $this->referrals;
    }

    /**
     * @return array<string, mixed>[]|null
     */
    public function getAutomations(): ?array
    {
        return $this->automations;
    }
}