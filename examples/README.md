# Examples

## Setup

```bash
composer install
export KUCOIN_API_KEY="your-key"
export KUCOIN_API_SECRET="your-secret"
export KUCOIN_API_PASSPHRASE="your-passphrase"
```

Optional:

```bash
export KUCOIN_BASE_URL="https://api.kucoin.com"
export KUCOIN_TIMEOUT=60
```

Order examples are dry-run by default. To execute real order requests:

```bash
export KUCOIN_EXECUTE=1
```

## Run

```bash
php examples/balances.php
php examples/spot_order.php
php examples/spot_deals.php
```
