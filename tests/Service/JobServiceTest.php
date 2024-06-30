<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Dto\JobDto;
use App\Dto\JobsResponseDto;
use App\Dto\MetaDto;
use App\Dto\NamedDto;
use App\Service\JobService;
use App\Tests\DataProvider;
use DateTimeImmutable;
use DG\BypassFinals;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\Serializer\Serializer;

class JobServiceTest extends TestCase
{
    private StreamInterface&MockObject $body;

    private ClientInterface&MockObject $httpClient;

    private JobService $jobService;

    private ResponseInterface&MockObject $response;

    private Serializer&MockObject $serializer;

    protected function setUp(): void
    {
        BypassFinals::enable();

        $this->body = $this->createMock(StreamInterface::class);

        $this->response = $this->createMock(ResponseInterface::class);
        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($this->body);

        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->httpClient
            ->expects($this->once())
            ->method('request')
            ->willReturn($this->response);

        $this->serializer = $this->createMock(Serializer::class);

        $this->jobService = new JobService($this->httpClient, $this->serializer);
    }

    public function testGetJobs(): void
    {
        $json = DataProvider::getJson('jobs.json');
        $this->body
            ->expects($this->once())
            ->method('getContents')
            ->willReturn($json);

        $data = json_decode($json, true, flags: JSON_THROW_ON_ERROR);
        $payload = array_map(
            fn (array $job) => new JobDto(
                $job['job_id'],
                $job['secured_id'],
                $job['public_id'],
                $job['access_state'],
                $job['draft'],
                $job['active'],
                $job['title'],
                $job['description'],
                // NOTE: Add upon update:  $job['internal_note'],
                $job['date_end'] !== null ? new DateTimeImmutable($job['date_end']) : null,
                $job['date_closed'] !== null ? new DateTimeImmutable($job['date_closed']) : null,
                $job['closed_duration'],
                new DateTimeImmutable($job['last_update']),
                new DateTimeImmutable($job['date_created']),
                $job['text_language'],
                $job['fte'] ?? null,
                array_map(static fn (array $item): NamedDto => new NamedDto(...$item), $job['workfields']),
                $job['filter_list'] ?? null,
                new NamedDto(...$job['education']),
                $job['disability'],
                $job['details'],
                $job['personalist'],
                $job['contact'],
                $job['sharing'],
                $job['addresses'],
                new NamedDto(...$job['employment']),
                $job['stats'] ?? null,
                $job['salary'],
                $job['channels'],
                $job['edit_link'],
                $job['public_link'],
                $job['referrals'],
                $job['automations'] ?? null,
            ),
            $data['payload'],
        );
        $meta = new MetaDto(
            $data['meta']['code'],
            $data['meta']['message'],
            $data['meta']['duration'],
            $data['meta']['entries_from'],
            $data['meta']['entries_to'],
            $data['meta']['entries_total'],
            $data['meta']['entries_sum'],
        );
        $jobsResponseDto = new JobsResponseDto($payload, $meta);
        $this->serializer
            ->expects($this->once())
            ->method('deserialize')
            ->willReturn($jobsResponseDto);
        
        $expectedData = json_decode($json, true, flags: JSON_THROW_ON_ERROR);
        $actual = $this->jobService->getJobs();

        self::assertIsArray($actual->getJobs());
        self::assertCount(count($expectedData['payload']), $actual->getJobs());
        self::assertContainsOnlyInstancesOf(JobDto::class, $actual->getJobs());

        self::assertSame($expectedData['meta']['code'], $actual->getMeta()->getCode());
        self::assertSame($expectedData['meta']['message'], $actual->getMeta()->getMessage());
        self::assertSame($expectedData['meta']['duration'], $actual->getMeta()->getDuration());
    }
}
