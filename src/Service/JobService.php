<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\JobsResponseDto;
use App\Dto\ParamsDto;
use GuzzleHttp\ClientInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class JobService
{
    private const SLUG_JOBS = 'jobs';

    public function __construct(
        private ClientInterface $recruitisApiClient,
        private SerializerInterface&DenormalizerInterface $serializer,
    ) {
    }

    public function getJobs(?ParamsDto $params = null): JobsResponseDto
    {
        $options = [
            'query' => $params?->toArray() ?? [],
        ];
        $response = $this->recruitisApiClient->request('GET', self::SLUG_JOBS, $options);
        $content = $response->getBody()->getContents();
        $jobs = $this->serializer->deserialize($content, JobsResponseDto::class, 'json');

        return $jobs;
    }
}