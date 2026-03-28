# feedex/kucoin

KuCoin adapter package for the Feedex ecosystem.

This package currently provides a focused incremental slice:
- Common module
- Account module
- Asset spot balance capability
- Spot market (core)
- Spot order (core)
- Spot deal
- Futures market (core)

## Installation

```bash
composer require feedex/feedex feedex/kucoin
```

## Compatibility

- `feedex/kucoin ^1.0` requires `feedex/feedex ^1.0`

## Usage (via Feedex registry)

```php
use Feedex\Feedex;
use Feedex\Kucoin\v1\KucoinFactory;

$feedex = (new Feedex())
    ->register(new KucoinFactory());

$kucoin = $feedex->exchange('kucoin', [
    'api_key' => getenv('KUCOIN_API_KEY'),
    'api_secret' => getenv('KUCOIN_API_SECRET'),
    'api_passphrase' => getenv('KUCOIN_API_PASSPHRASE'),
    // optional:
    // 'base_url' => 'https://api.kucoin.com',
    // 'futures_base_url' => 'https://api-futures.kucoin.com',
]);

$time = $kucoin->common()->time();
$markets = $kucoin->spotMarket()->listMarkets();
$futures = $kucoin->futuresMarket()->listMarkets();
$balances = $kucoin->asset()->getSpotBalance();
```

## Examples

See runnable scripts in [`examples/`](examples):
- [`examples/balances.php`](examples/balances.php)
- [`examples/spot_order.php`](examples/spot_order.php)
- [`examples/spot_deals.php`](examples/spot_deals.php)

## Implemented capabilities

- `HasCommonModuleInterface`
- `HasAccountModuleInterface`
- `HasAssetSpotBalanceModuleInterface`
- `HasSpotMarketCoreModuleInterface`
- `HasSpotOrderCoreModuleInterface`
- `HasSpotDealModuleInterface`
- `HasFuturesMarketCoreModuleInterface`

## Implemented module methods

### Common (public)
- `ping()`
- `time()`
- `maintainInfo()`

### Account (private)
- `getAccountInfo()`
- `getTradeFeeRate()`

### Asset Spot Balance (private)
- `getSpotBalance()`

### Spot Market Core (public)
- `listMarkets()`
- `listMarketTicker()`
- `listMarketDepth()`
- `listMarketDeals()`
- `listMarketKline()`

### Spot Order Core (private)
- `putOrder()`
- `cancelOrder()`
- `cancelAllOrder()`
- `getOrderStatus()`
- `listPendingOrder()`
- `listFinishedOrder()`

### Spot Deal (private)
- `listUserDeals()`
- `listUserOrderDeals()`

### Futures Market Core (public)
- `listMarkets()`
- `listMarketTicker()`
- `listMarketDepth()`
- `listMarketDeals()`
- `listMarketKline()`
- `listMarketIndex()`

## Notes

This adapter intentionally expands in small, safe slices. Spot and futures APIs use different base hosts, so this adapter supports separate configuration via `base_url` and `futures_base_url`.
Spot market index capability is not added yet because KuCoin spot APIs do not expose a direct index endpoint equivalent in this slice.
Advanced spot/futures/account modules can be added incrementally in future releases.

## v1.0.0 scope freeze (kucoin)

For the first stable adapter release, v1 scope is frozen to:

- current spot core modules (`SpotMarketCore`, `SpotOrderCore`, `SpotDeal`)
- current account and asset-spot-balance modules
- current futures market core module
- dual-host configuration model (`base_url`, `futures_base_url`)

Out of scope for kucoin v1.0.0:

- futures order/deal/position modules
- websocket feeds
- breaking renames of public module methods

## Changelog

See [`CHANGELOG.md`](CHANGELOG.md) for release history.

## License

MIT
