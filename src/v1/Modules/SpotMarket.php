<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Modules;

use Feedex\Contracts\Modules\SpotMarketCoreModuleInterface;

final class SpotMarket extends Module implements SpotMarketCoreModuleInterface
{
    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarkets(array $query = []): array
    {
        return $this->publicGet('/api/v2/symbols', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarketTicker(array $query = []): array
    {
        return $this->publicGet('/api/v1/market/allTickers', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarketDepth(array $query): array
    {
        return $this->publicGet('/api/v1/market/orderbook/level2_20', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarketDeals(array $query): array
    {
        return $this->publicGet('/api/v1/market/histories', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarketKline(array $query): array
    {
        return $this->publicGet('/api/v1/market/candles', $query);
    }
}
