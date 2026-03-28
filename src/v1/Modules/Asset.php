<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Modules;

use Feedex\Contracts\Modules\AssetSpotBalanceModuleInterface;

final class Asset extends Module implements AssetSpotBalanceModuleInterface
{
    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function getSpotBalance(array $query = []): array
    {
        return $this->privateGet('/api/v1/accounts', array_merge(['type' => 'trade'], $query));
    }
}
