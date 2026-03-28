# feedex/kucoin

KuCoin adapter package for the Feedex ecosystem.

This package currently provides a focused first vertical slice:
- Common module
- Spot market (core)
- Spot order (core)

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
```

## Implemented capabilities

- `HasCommonModuleInterface`
- `HasSpotMarketCoreModuleInterface`
- `HasSpotOrderCoreModuleInterface`

## Implemented module methods

### Common (public)
- `ping()`
- `time()`
- `maintainInfo()`

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

## Notes

This adapter intentionally starts with core spot capabilities. Advanced spot/futures/account modules can be added incrementally in future releases.

## License

MIT
