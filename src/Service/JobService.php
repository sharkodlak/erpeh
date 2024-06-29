<?php

declare(strict_types=1);

namespace App\Service;

use GuzzleHttp\ClientInterface;

final class JobService
{
    private const SLUG_JOBS = 'jobs';

    public function __construct(
        private ClientInterface $recruitisApiClient,
    ) {
    }

    public function getJobs(): array
    {
        $response = $this->recruitisApiClient->request('GET', self::SLUG_JOBS);
        $content = $response->getBody()->getContents();
        $jobs = json_decode($content, true, flags: JSON_THROW_ON_ERROR);

        return $jobs;
    }
}