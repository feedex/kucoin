<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1;

use Feedex\Contracts\ExchangeFactoryInterface;
use Feedex\Contracts\ExchangeInterface;
use InvalidArgumentException;

final class KucoinFactory implements ExchangeFactoryInterface
{
    public function exchangeId(): string
    {
        return 'kucoin';
    }

    /**
     * @param array<string, mixed> $config
     */
    public function create(array $config): ExchangeInterface
    {
        $apiKey = $config['api_key'] ?? null;
        $apiSecret = $config['api_secret'] ?? null;
        $apiPassphrase = $config['api_passphrase'] ?? null;

        if (!is_string($apiKey) || $apiKey === '') {
            throw new InvalidArgumentException('Missing required config key: api_key');
        }

        if (!is_string($apiSecret) || $apiSecret === '') {
            throw new InvalidArgumentException('Missing required config key: api_secret');
        }

        if (!is_string($apiPassphrase) || $apiPassphrase === '') {
            throw new InvalidArgumentException('Missing required config key: api_passphrase');
        }

        $baseUrl = isset($config['base_url']) && is_string($config['base_url'])
            ? $config['base_url']
            : 'https://api.kucoin.com';

        $futuresBaseUrl = isset($config['futures_base_url']) && is_string($config['futures_base_url'])
            ? $config['futures_base_url']
            : 'https://api-futures.kucoin.com';

        $timeout = isset($config['timeout']) && is_int($config['timeout'])
            ? $config['timeout']
            : 60;

        return new Kucoin($apiKey, $apiSecret, $apiPassphrase, $baseUrl, $futuresBaseUrl, $timeout);
    }
}
