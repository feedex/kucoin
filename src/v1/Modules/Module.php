<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Modules;

use Feedex\Kucoin\v1\Contracts\HttpClientInterface;

abstract class Module
{
    public function __construct(protected readonly HttpClientInterface $httpClient)
    {
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    protected function publicGet(string $path, array $query = []): array
    {
        return $this->httpClient->request('GET', $path, $query, [], false);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    protected function privateGet(string $path, array $query = []): array
    {
        return $this->httpClient->request('GET', $path, $query);
    }

    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    protected function privatePost(string $path, array $payload): array
    {
        return $this->httpClient->request('POST', $path, [], $payload);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    protected function privateDelete(string $path, array $query = []): array
    {
        return $this->httpClient->request('DELETE', $path, $query);
    }
}
