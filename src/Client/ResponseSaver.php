<?php

declare(strict_types=1);

namespace App\Client;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class ResponseSaver
{
    /**
     * @return array<string, mixed>
     */
    public static function serialize(ResponseInterface $response): array
    {
        return [
            'status' => $response->getStatusCode(),
            'headers' => $response->getHeaders(),
            'body' => (string) $response->getBody(),
            'protocolVersion' => $response->getProtocolVersion(),
            'reasonPhrase' => $response->getReasonPhrase(),
        ];
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function unserialize(array $data): ResponseInterface
    {
        return new Response(
            $data['status'],
            $data['headers'],
            $data['body'],
            $data['protocolVersion'],
            $data['reasonPhrase']
        );
    }
}