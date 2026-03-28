<?php

declare(strict_types=1);

namespace Feedex\Tests\Modules;

use Feedex\Kucoin\v1\Modules\SpotOrder;
use Feedex\Tests\Support\SpyHttpClient;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class SpotOrderEndpointsTest extends TestCase
{
    public function testPutOrderUsesPrivatePostOrdersEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new SpotOrder($spy);

        $module->putOrder(['symbol' => 'BTC-USDT', 'side' => 'buy', 'type' => 'limit']);

        self::assertSame('POST', $spy->lastCall()['method']);
        self::assertSame('/api/v1/orders', $spy->lastCall()['path']);
        self::assertTrue($spy->lastCall()['authenticated']);
    }

    public function testCancelOrderUsesOrderIdEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new SpotOrder($spy);

        $module->cancelOrder(['order_id' => '123']);

        self::assertSame('DELETE', $spy->lastCall()['method']);
        self::assertSame('/api/v1/orders/123', $spy->lastCall()['path']);
    }

    public function testCancelOrderThrowsWhenIdentifiersMissing(): void
    {
        $spy = new SpyHttpClient();
        $module = new SpotOrder($spy);

        $this->expectException(InvalidArgumentException::class);
        $module->cancelOrder([]);
    }

    public function testListPendingOrderAddsActiveStatus(): void
    {
        $spy = new SpyHttpClient();
        $module = new SpotOrder($spy);

        $module->listPendingOrder(['symbol' => 'BTC-USDT']);

        self::assertSame('/api/v1/orders', $spy->lastCall()['path']);
        self::assertSame(['symbol' => 'BTC-USDT', 'status' => 'active'], $spy->lastCall()['query']);
    }
}
