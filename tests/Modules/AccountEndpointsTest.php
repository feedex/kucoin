<?php

declare(strict_types=1);

namespace Feedex\Tests\Modules;

use Feedex\Kucoin\v1\Modules\Account;
use Feedex\Tests\Support\SpyHttpClient;
use PHPUnit\Framework\TestCase;

final class AccountEndpointsTest extends TestCase
{
    public function testGetAccountInfoUsesAccountsEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new Account($spy);

        $module->getAccountInfo();

        self::assertSame('GET', $spy->lastCall()['method']);
        self::assertSame('/api/v1/accounts', $spy->lastCall()['path']);
        self::assertTrue($spy->lastCall()['authenticated']);
    }

    public function testGetTradeFeeRateUsesBaseFeeEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new Account($spy);

        $module->getTradeFeeRate(['symbols' => 'BTC-USDT']);

        self::assertSame('/api/v1/base-fee', $spy->lastCall()['path']);
        self::assertSame(['symbols' => 'BTC-USDT'], $spy->lastCall()['query']);
        self::assertTrue($spy->lastCall()['authenticated']);
    }
}
