<?php

declare(strict_types=1);

namespace Feedex\Tests;

use Feedex\Kucoin\v1\Kucoin;
use Feedex\Kucoin\v1\KucoinFactory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class KucoinFactoryTest extends TestCase
{
    public function testCreateReturnsKucoinInstance(): void
    {
        $factory = new KucoinFactory();

        $exchange = $factory->create([
            'api_key' => 'key',
            'api_secret' => 'secret',
            'api_passphrase' => 'pass',
        ]);

        self::assertInstanceOf(Kucoin::class, $exchange);
    }

    public function testCreateThrowsWhenApiKeyMissing(): void
    {
        $factory = new KucoinFactory();

        $this->expectException(InvalidArgumentException::class);
        $factory->create([
            'api_secret' => 'secret',
            'api_passphrase' => 'pass',
        ]);
    }
}
