<?php

declare(strict_types=1);

namespace App\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CachingClient implements ClientInterface
{
    public function __construct(
        private ClientInterface $client,
        private CacheItemPoolInterface $cache,
        private int $ttl = 3600,
    ) {
    }

    /**
     * @param array<mixed> $options
     */
    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        $cacheKey = $method . $uri . md5(serialize($options));

        // Check if response is cached
        $cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            $item = $cacheItem->get();
            $response = ResponseSaver::unserialize($item);

            return $response;
        }

        // Call encapsulated client
        $response = $this->client->request($method, $uri, $options);
        $serialized = ResponseSaver::serialize($response);
        $cacheItem->set($serialized)
            ->expiresAfter($this->ttl);
        $this->cache->save($cacheItem);

        return $response;
    }

    /**
     * @param array<mixed> $options
     */
    public function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        $message = sprintf('Method %s has not implemented caching', __METHOD__);
        trigger_error($message, E_USER_WARNING);
        return $this->client->send($request, $options);
    }

    /**
     * @param array<mixed> $options
     */
    public function sendAsync(RequestInterface $request, array $options = []): PromiseInterface
    {
        $message = sprintf('Method %s has not implemented caching', __METHOD__);
        trigger_error($message, E_USER_WARNING);
        return $this->client->sendAsync($request, $options);
    }

    /**
     * @param array<mixed> $options
     */
    public function requestAsync(string $method, $uri, array $options = []): PromiseInterface
    {
        $message = sprintf('Method %s has not implemented caching', __METHOD__);
        trigger_error($message, E_USER_WARNING);
        return $this->client->requestAsync($method, $uri, $options);
    }

    public function getConfig(string $option = null)
    {
        return $this->client->getConfig($option);
    }
}