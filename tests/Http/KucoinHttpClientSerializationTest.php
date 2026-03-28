<?php

declare(strict_types=1);

namespace Feedex\Tests\Http;

use Feedex\Kucoin\v1\Http\KucoinHttpClient;
use Feedex\Kucoin\v1\Http\Signer;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class KucoinHttpClientSerializationTest extends TestCase
{
    public function testAuthenticatedRequestSerializesQueryBodyAndSignature(): void
    {
        $history = [];
        $handler = HandlerStack::create(new MockHandler([
            new Response(200, [], json_encode(['code' => '200000', 'data' => ['ok' => true]], JSON_THROW_ON_ERROR)),
        ]));
        $handler->push(Middleware::history($history));

        $client = new Client([
            'base_uri' => 'https://api.kucoin.com',
            'handler' => $handler,
        ]);

        $timestamp = 1700000000123;
        $http = new KucoinHttpClient(
            'my-key',
            'my-secret',
            'my-passphrase',
            'https://api.kucoin.com',
            60,
            $client,
            static fn (): int => $timestamp
        );

        $query = ['symbol' => 'BTC-USDT', 'clientOid' => 'abc 123'];
        $body = ['remark' => 'a/b', 'size' => '1'];

        $http->request('POST', '/api/v1/orders', $query, $body, true);

        self::assertTrue(isset($history[0]));
        $request = $history[0]['request'];

        $expectedQuery = 'symbol=BTC-USDT&clientOid=abc%20123';
        $expectedBody = '{"remark":"a/b","size":"1"}';
        $expectedPayload = $timestamp . 'POST' . '/api/v1/orders?' . $expectedQuery . $expectedBody;

        self::assertSame('/api/v1/orders', $request->getUri()->getPath());
        self::assertSame($expectedQuery, $request->getUri()->getQuery());
        self::assertSame($expectedBody, (string) $request->getBody());
        self::assertSame(Signer::sign($expectedPayload, 'my-secret'), $request->getHeaderLine('KC-API-SIGN'));
        self::assertSame(Signer::signPassphrase('my-passphrase', 'my-secret'), $request->getHeaderLine('KC-API-PASSPHRASE'));
    }
}
