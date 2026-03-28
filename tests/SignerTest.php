<?php

declare(strict_types=1);

namespace Feedex\Tests;

use Feedex\Kucoin\v1\Http\Signer;
use PHPUnit\Framework\TestCase;

final class SignerTest extends TestCase
{
    public function testSignBuildsExpectedBase64HmacSha256Signature(): void
    {
        $payload = '1700000000000GET/api/v1/timestamp';
        $secret = 'test-secret';

        $expected = base64_encode(hash_hmac('sha256', $payload, $secret, true));

        self::assertSame($expected, Signer::sign($payload, $secret));
    }

    public function testSignPassphraseUsesSameSigningRule(): void
    {
        $passphrase = 'my-passphrase';
        $secret = 'test-secret';

        $expected = base64_encode(hash_hmac('sha256', $passphrase, $secret, true));

        self::assertSame($expected, Signer::signPassphrase($passphrase, $secret));
    }
}
