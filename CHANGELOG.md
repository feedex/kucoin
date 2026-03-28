# Changelog

All notable changes to `feedex/kucoin` are documented in this file.

## [Unreleased]

### Docs
- Add changelog to keep releases clear as the plugin evolves.

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
