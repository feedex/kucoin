# feedex/kucoin

KuCoin adapter package for the Feedex ecosystem.

This package currently provides a focused first vertical slice:
- Common module
- Account module
- Asset spot balance capability
- Spot market (core)
- Spot order (core)
- Spot deal

## Installation

```bash
composer require feedex/feedex feedex/kucoin
```

## Compatibility

- `feedex/kucoin ^0.1` requires `feedex/feedex ^0.1.6`

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
]);

$time = $kucoin->common()->time();
$markets = $kucoin->spotMarket()->listMarkets();
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

## Notes

This adapter intentionally starts with core spot capabilities plus spot deal history. Spot market index capability is not added yet because KuCoin spot APIs do not expose a direct index endpoint equivalent in this slice.
Advanced spot/futures/account modules can be added incrementally in future releases.

## Changelog

See [`CHANGELOG.md`](CHANGELOG.md) for release history.

## License

MIT
