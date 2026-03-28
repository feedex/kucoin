# Changelog

All notable changes to `feedex/kucoin` are documented in this file.

## [Unreleased]

## [1.0.0]

### Stable release
- Promoted KuCoin adapter API surface to stable `1.0.0`.
- Updated core dependency to `feedex/feedex ^1.0`.
- Preserved current frozen v1 scope for spot/account/asset/futures-market core modules.

## [0.1.4]

### Docs
- Added explicit kucoin v1.0.0 scope freeze notes.
- Aligned changelog entries for pre-v1 release stream.

## [0.1.3]

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
