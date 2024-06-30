<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\JobsResponseDto;
use App\Dto\ParamsDto;
use App\Exception\RecruitisApiException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

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

        try {
            $response = $this->recruitisApiClient->request('GET', self::SLUG_JOBS, $options);
            $content = $response->getBody()->getContents();
            $jobs = $this->serializer->deserialize($content, JobsResponseDto::class, 'json');
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            throw new RecruitisApiException($data['meta']['code'], $exception->getCode(), $exception);
        } catch (Throwable $exception) {
            throw new RecruitisApiException('Failed to fetch jobs', $exception->getCode(), $exception);
        }

        return $jobs;
    }
}