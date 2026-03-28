<?php

declare(strict_types=1);

use Feedex\Feedex;
use Feedex\Kucoin\v1\KucoinFactory;

require dirname(__DIR__) . '/vendor/autoload.php';

if (!function_exists('kucoin_config')) {
    /** @return array<string, mixed> */
    function kucoin_config(): array
    {
        $apiKey = getenv('KUCOIN_API_KEY');
        $apiSecret = getenv('KUCOIN_API_SECRET');
        $apiPassphrase = getenv('KUCOIN_API_PASSPHRASE');

        if (!is_string($apiKey) || $apiKey === '' || !is_string($apiSecret) || $apiSecret === '' || !is_string($apiPassphrase) || $apiPassphrase === '') {
            throw new RuntimeException('Set KUCOIN_API_KEY, KUCOIN_API_SECRET and KUCOIN_API_PASSPHRASE first.');
        }

        $config = [
            'api_key' => $apiKey,
            'api_secret' => $apiSecret,
            'api_passphrase' => $apiPassphrase,
        ];

        $baseUrl = getenv('KUCOIN_BASE_URL');
        if (is_string($baseUrl) && $baseUrl !== '') {
            $config['base_url'] = $baseUrl;
        }

        $timeout = getenv('KUCOIN_TIMEOUT');
        if (is_string($timeout) && ctype_digit($timeout)) {
            $config['timeout'] = (int) $timeout;
        }

        return $config;
    }
}

if (!function_exists('kucoin_client')) {
    function kucoin_client(): \Feedex\Kucoin\v1\Kucoin
    {
        $feedex = (new Feedex())->register(new KucoinFactory());

        /** @var \Feedex\Kucoin\v1\Kucoin $exchange */
        $exchange = $feedex->exchange('kucoin', kucoin_config());

        return $exchange;
    }
}

if (!function_exists('kucoin_execute_enabled')) {
    function kucoin_execute_enabled(): bool
    {
        return getenv('KUCOIN_EXECUTE') === '1';
    }
}
