<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Contracts;

use Feedex\Kucoin\v1\Exceptions\KucoinRequestException;

interface HttpClientInterface
{
    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed> $body
     * @return array<string, mixed>
     *
     * @throws KucoinRequestException
     */
    public function request(
        string $method,
        string $path,
        array $query = [],
        array $body = [],
        bool $authenticated = true
    ): array;
}
