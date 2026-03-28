<?php

declare(strict_types=1);

namespace Feedex\Tests;

use Feedex\Kucoin\v1\Kucoin;
use Feedex\Kucoin\v1\Modules\Common;
use Feedex\Kucoin\v1\Modules\SpotMarket;
use Feedex\Kucoin\v1\Modules\SpotOrder;
use PHPUnit\Framework\TestCase;

final class KucoinTest extends TestCase
{
    public function testFactoryMethodsReturnExpectedModules(): void
    {
        $client = new Kucoin('key', 'secret', 'passphrase');

        self::assertSame('kucoin', $client->id());
        self::assertInstanceOf(Common::class, $client->common());
        self::assertInstanceOf(SpotMarket::class, $client->spotMarket());
        self::assertInstanceOf(SpotOrder::class, $client->spotOrder());
    }
}
