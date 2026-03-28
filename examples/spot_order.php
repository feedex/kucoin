<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$payload = [
    'clientOid' => 'example-kucoin-spot-001',
    'side' => 'buy',
    'symbol' => 'BTC-USDT',
    'type' => 'limit',
    'price' => '10000',
    'size' => '0.0001',
];

if (!kucoin_execute_enabled()) {
    echo "DRY RUN: set KUCOIN_EXECUTE=1 to send the order.\n";
    echo json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), "\n";
    exit(0);
}

$kucoin = kucoin_client();
$result = $kucoin->spotOrder()->putOrder($payload);

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), "\n";
