<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$kucoin = kucoin_client();
$deals = $kucoin->spotDeal()->listUserDeals(['symbol' => 'BTC-USDT']);

echo json_encode($deals, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), "\n";
