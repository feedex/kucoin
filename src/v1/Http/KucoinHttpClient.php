<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Http;

use Feedex\Kucoin\v1\Contracts\HttpClientInterface;
use Feedex\Kucoin\v1\Exceptions\KucoinRequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

final class KucoinHttpClient implements HttpClientInterface
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $apiSecret,
        private readonly string $apiPassphrase,
        private readonly string $baseUrl = 'https://api.kucoin.com',
        private readonly int $timeout = 60,
        private readonly ?Client $client = null,
        private readonly ?\Closure $timestampProvider = null
    ) {
    }

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
    ): array {
        $method = strtoupper($method);
        $queryString = http_build_query($query, '', '&', PHP_QUERY_RFC3986);
        $signaturePath = $path . ($queryString !== '' ? '?' . $queryString : '');
        $bodyJson = $body === []
            ? ''
            : json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);

        $options = [
            'timeout' => $this->timeout,
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];

        if ($query !== []) {
            $options['query'] = $query;
        }

        if ($bodyJson !== '') {
            $options['body'] = $bodyJson;
            $options['headers']['Content-Type'] = 'application/json';
        }

        if ($authenticated) {
            $timestamp = $this->timestamp();
            $payload = $timestamp . $method . $signaturePath . $bodyJson;

            $options['headers']['KC-API-KEY'] = $this->apiKey;
            $options['headers']['KC-API-SIGN'] = Signer::sign($payload, $this->apiSecret);
            $options['headers']['KC-API-TIMESTAMP'] = (string) $timestamp;
            $options['headers']['KC-API-PASSPHRASE'] = Signer::signPassphrase($this->apiPassphrase, $this->apiSecret);
            $options['headers']['KC-API-KEY-VERSION'] = '2';
        }

        try {
            $client = $this->client ?? new Client(['base_uri' => $this->baseUrl]);
            $response = $client->request($method, $path, $options);
            $status = $response->getStatusCode();
            $rawBody = $response->getBody()->getContents();

            /** @var array<string, mixed> $decoded */
            $decoded = json_decode($rawBody, true, 512, JSON_THROW_ON_ERROR);

            if ($status >= 400) {
                throw new KucoinRequestException('HTTP request failed.', $status, $decoded);
            }

            $code = (string) ($decoded['code'] ?? '');
            if ($code !== '200000') {
                $message = (string) ($decoded['msg'] ?? 'KuCoin API error.');
                throw new KucoinRequestException($message, $status, $decoded);
            }

            return $decoded;
        } catch (GuzzleException|JsonException $exception) {
            throw new KucoinRequestException($exception->getMessage(), 0, [], $exception);
        }
    }

    private function timestamp(): int
    {
        if ($this->timestampProvider instanceof \Closure) {
            return (int) ($this->timestampProvider)();
        }

        return (int) round(microtime(true) * 1000);
    }
}
