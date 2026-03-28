<?php

declare(strict_types=1);

namespace Feedex\Tests\Http;

use Feedex\Kucoin\v1\Http\Signer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SignerGoldenPayloadTest extends TestCase
{
    /**
     * @return iterable<string, array{payload: string, secret: string, expected: string}>
     */
    public static function vectors(): iterable
    {
        yield 'timestamp' => [
            'payload' => '1700000000000GET/api/v1/timestamp',
            'secret' => 'secret-1',
            'expected' => 'mprvTm1BGx8ooXdxn8RDmVVIPdgl8SjpIssZMKCssMw=',
        ];

        yield 'query-and-body' => [
            'payload' => '1700000000123POST/api/v1/orders?symbol=BTC-USDT&clientOid=abc%20123{"remark":"a/b","size":"1"}',
            'secret' => 'secret-2',
            'expected' => 'iZsWamWnhHkNmv87Fq1OzSlxRq/8tdrUX2OBjZ5y+2s=',
        ];
    }

    #[DataProvider('vectors')]
    public function testGoldenSignatures(string $payload, string $secret, string $expected): void
    {
        self::assertSame($expected, Signer::sign($payload, $secret));
    }
}
