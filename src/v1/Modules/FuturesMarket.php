<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Modules;

use Feedex\Contracts\Modules\FuturesMarketCoreModuleInterface;

final class FuturesMarket extends Module implements FuturesMarketCoreModuleInterface
{
    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarkets(array $query = []): array
    {
        return $this->publicGet('/api/v1/contracts/active', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarketTicker(array $query = []): array
    {
        return $this->publicGet('/api/v1/ticker', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarketDepth(array $query): array
    {
        return $this->publicGet('/api/v1/level2/depth20', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarketDeals(array $query): array
    {
        return $this->publicGet('/api/v1/trade/history', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarketKline(array $query): array
    {
        return $this->publicGet('/api/v1/kline/query', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listMarketIndex(array $query = []): array
    {
        return $this->publicGet('/api/v1/index/query', $query);
    }
}
