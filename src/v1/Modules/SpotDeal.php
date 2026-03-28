<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Modules;

use Feedex\Contracts\Modules\SpotDealModuleInterface;

final class SpotDeal extends Module implements SpotDealModuleInterface
{
    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listUserDeals(array $query = []): array
    {
        return $this->privateGet('/api/v1/fills', $query);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listUserOrderDeals(array $query): array
    {
        return $this->privateGet('/api/v1/fills', $query);
    }
}
