<?php

declare(strict_types=1);

namespace Feedex\Tests\Modules;

use Feedex\Kucoin\v1\Modules\SpotDeal;
use Feedex\Tests\Support\SpyHttpClient;
use PHPUnit\Framework\TestCase;

final class SpotDealEndpointsTest extends TestCase
{
    public function testListUserDealsUsesPrivateFillsEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new SpotDeal($spy);

        $module->listUserDeals(['symbol' => 'BTC-USDT']);

        self::assertSame('GET', $spy->lastCall()['method']);
        self::assertSame('/api/v1/fills', $spy->lastCall()['path']);
        self::assertSame(['symbol' => 'BTC-USDT'], $spy->lastCall()['query']);
        self::assertTrue($spy->lastCall()['authenticated']);
    }

    public function testListUserOrderDealsUsesPrivateFillsEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new SpotDeal($spy);

        $module->listUserOrderDeals(['orderId' => '123']);

        self::assertSame('/api/v1/fills', $spy->lastCall()['path']);
        self::assertSame(['orderId' => '123'], $spy->lastCall()['query']);
        self::assertTrue($spy->lastCall()['authenticated']);
    }
}
