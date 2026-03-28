<?php

declare(strict_types=1);

namespace Feedex\Tests\Modules;

use Feedex\Kucoin\v1\Modules\FuturesMarket;
use Feedex\Tests\Support\SpyHttpClient;
use PHPUnit\Framework\TestCase;

final class FuturesMarketEndpointsTest extends TestCase
{
    public function testListMarketsUsesContractsActiveEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new FuturesMarket($spy);

        $module->listMarkets();

        self::assertSame('GET', $spy->lastCall()['method']);
        self::assertSame('/api/v1/contracts/active', $spy->lastCall()['path']);
        self::assertFalse($spy->lastCall()['authenticated']);
    }

    public function testListMarketDepthUsesDepthEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new FuturesMarket($spy);

        $module->listMarketDepth(['symbol' => 'XBTUSDTM']);

        self::assertSame('/api/v1/level2/depth20', $spy->lastCall()['path']);
        self::assertSame(['symbol' => 'XBTUSDTM'], $spy->lastCall()['query']);
        self::assertFalse($spy->lastCall()['authenticated']);
    }

    public function testListMarketIndexUsesIndexEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new FuturesMarket($spy);

        $module->listMarketIndex(['symbol' => 'XBTUSDTM']);

        self::assertSame('/api/v1/index/query', $spy->lastCall()['path']);
        self::assertSame(['symbol' => 'XBTUSDTM'], $spy->lastCall()['query']);
        self::assertFalse($spy->lastCall()['authenticated']);
    }
}
