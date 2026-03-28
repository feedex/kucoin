<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap.php';

$kucoin = kucoin_client();
$accounts = $kucoin->asset()->getSpotBalance();
$fees = $kucoin->account()->getTradeFeeRate();

echo "Spot balances:\n";
echo json_encode($accounts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), "\n\n";

echo "Trade fee rate:\n";
echo json_encode($fees, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), "\n";
