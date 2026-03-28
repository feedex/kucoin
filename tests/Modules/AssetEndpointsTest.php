<?php

declare(strict_types=1);

namespace Feedex\Tests\Modules;

use Feedex\Kucoin\v1\Modules\Asset;
use Feedex\Tests\Support\SpyHttpClient;
use PHPUnit\Framework\TestCase;

final class AssetEndpointsTest extends TestCase
{
    public function testGetSpotBalanceUsesAccountsTradeEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new Asset($spy);

        $module->getSpotBalance(['currency' => 'USDT']);

        self::assertSame('GET', $spy->lastCall()['method']);
        self::assertSame('/api/v1/accounts', $spy->lastCall()['path']);
        self::assertSame(['type' => 'trade', 'currency' => 'USDT'], $spy->lastCall()['query']);
        self::assertTrue($spy->lastCall()['authenticated']);
    }
}
