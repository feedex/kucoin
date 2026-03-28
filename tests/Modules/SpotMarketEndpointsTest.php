<?php

declare(strict_types=1);

namespace Feedex\Tests\Modules;

use Feedex\Kucoin\v1\Modules\SpotMarket;
use Feedex\Tests\Support\SpyHttpClient;
use PHPUnit\Framework\TestCase;

final class SpotMarketEndpointsTest extends TestCase
{
    public function testListMarketsUsesSymbolsEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new SpotMarket($spy);

        $module->listMarkets();

        self::assertSame('GET', $spy->lastCall()['method']);
        self::assertSame('/api/v2/symbols', $spy->lastCall()['path']);
        self::assertFalse($spy->lastCall()['authenticated']);
    }

    public function testListMarketDepthUsesOrderbookEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new SpotMarket($spy);

        $module->listMarketDepth(['symbol' => 'BTC-USDT']);

        self::assertSame('/api/v1/market/orderbook/level2_20', $spy->lastCall()['path']);
        self::assertSame(['symbol' => 'BTC-USDT'], $spy->lastCall()['query']);
        self::assertFalse($spy->lastCall()['authenticated']);
    }
}
