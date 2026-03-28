<?php

declare(strict_types=1);

namespace Feedex\Tests\Modules;

use Feedex\Kucoin\v1\Modules\Common;
use Feedex\Tests\Support\SpyHttpClient;
use PHPUnit\Framework\TestCase;

final class CommonEndpointsTest extends TestCase
{
    public function testTimeUsesPublicEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new Common($spy);

        $module->time();

        self::assertSame('GET', $spy->lastCall()['method']);
        self::assertSame('/api/v1/timestamp', $spy->lastCall()['path']);
        self::assertFalse($spy->lastCall()['authenticated']);
    }

    public function testPingUsesPublicStatusEndpoint(): void
    {
        $spy = new SpyHttpClient();
        $module = new Common($spy);

        $module->ping();

        self::assertSame('/api/v1/status', $spy->lastCall()['path']);
        self::assertFalse($spy->lastCall()['authenticated']);
    }
}
