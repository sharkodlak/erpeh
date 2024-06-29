<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\JobService;
use App\Tests\DataProvider;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class JobServiceTest extends TestCase
{
    private StreamInterface&MockObject $body;

    private ClientInterface&MockObject $httpClient;

    private JobService $jobService;

    private ResponseInterface&MockObject $response;

    protected function setUp(): void
    {
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

        $this->jobService = new JobService($this->httpClient);
    }

    public function testGetJobs(): void
    {
        $json = DataProvider::getJson('jobs.json');
        $this->body
            ->expects($this->once())
            ->method('getContents')
            ->willReturn($json);
        
        $expected = json_decode($json, true, flags: JSON_THROW_ON_ERROR);
        $actual = $this->jobService->getJobs();
        self::assertSame($expected, $actual);
    }
}
