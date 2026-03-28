<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Http;

final class Signer
{
    public static function sign(string $payload, string $secret): string
    {
        return base64_encode(hash_hmac('sha256', $payload, $secret, true));
    }

    public static function signPassphrase(string $passphrase, string $secret): string
    {
        return self::sign($passphrase, $secret);
    }
}
