<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1;

use Feedex\Contracts\Capabilities\HasAccountModuleInterface;
use Feedex\Contracts\Capabilities\HasAssetSpotBalanceModuleInterface;
use Feedex\Contracts\Capabilities\HasCommonModuleInterface;
use Feedex\Contracts\Capabilities\HasSpotDealModuleInterface;
use Feedex\Contracts\Capabilities\HasSpotMarketCoreModuleInterface;
use Feedex\Contracts\Capabilities\HasSpotOrderCoreModuleInterface;
use Feedex\Contracts\ExchangeInterface;
use Feedex\Kucoin\v1\Http\KucoinHttpClient;
use Feedex\Kucoin\v1\Modules\Account;
use Feedex\Kucoin\v1\Modules\Asset;
use Feedex\Kucoin\v1\Modules\Common;
use Feedex\Kucoin\v1\Modules\SpotDeal;
use Feedex\Kucoin\v1\Modules\SpotMarket;
use Feedex\Kucoin\v1\Modules\SpotOrder;

final class Kucoin implements
    ExchangeInterface,
    HasCommonModuleInterface,
    HasAccountModuleInterface,
    HasAssetSpotBalanceModuleInterface,
    HasSpotMarketCoreModuleInterface,
    HasSpotOrderCoreModuleInterface,
    HasSpotDealModuleInterface
{
    private KucoinHttpClient $httpClient;

    public function __construct(
        string $apiKey,
        string $apiSecret,
        string $apiPassphrase,
        string $baseUrl = 'https://api.kucoin.com',
        int $timeout = 60
    ) {
        $this->httpClient = new KucoinHttpClient($apiKey, $apiSecret, $apiPassphrase, $baseUrl, $timeout);
    }

    public function id(): string
    {
        return 'kucoin';
    }

    public function common(): Common
    {
        return new Common($this->httpClient);
    }

    public function account(): Account
    {
        return new Account($this->httpClient);
    }

    public function asset(): Asset
    {
        return new Asset($this->httpClient);
    }

    public function spotMarket(): SpotMarket
    {
        return new SpotMarket($this->httpClient);
    }

    public function spotOrder(): SpotOrder
    {
        return new SpotOrder($this->httpClient);
    }

    public function spotDeal(): SpotDeal
    {
        return new SpotDeal($this->httpClient);
    }
}
