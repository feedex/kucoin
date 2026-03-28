# Changelog

All notable changes to `feedex/kucoin` are documented in this file.

## [Unreleased]

### Added
- Futures market core module support (`FuturesMarket`) with dedicated futures base URL config.
- `HasFuturesMarketCoreModuleInterface` capability exposure from `Kucoin` client.

## [0.1.2]

### Added
- Account module support (`getAccountInfo`, `getTradeFeeRate`).
- Asset spot-balance capability support (`getSpotBalance`).
- Examples folder with balances, spot order, and spot deals scripts.

## [0.1.1]

### Docs
- Added changelog and linked it from README.

## [0.1.0]

### Added
- Initial KuCoin adapter bootstrap.
- `Kucoin` exchange client and `KucoinFactory`.
- HTTP transport/signing layer (`KucoinHttpClient`, `Signer`, `KucoinRequestException`).
- Capabilities:
  - `HasCommonModuleInterface`
  - `HasSpotMarketCoreModuleInterface`
  - `HasSpotOrderCoreModuleInterface`
  - `HasSpotDealModuleInterface`
- Modules:
  - `Common`
  - `SpotMarket` (core)
  - `SpotOrder` (core)
  - `SpotDeal`
- CI workflow (`lint`, `test`, `phpstan`) and initial README.
