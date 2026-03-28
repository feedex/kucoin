<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Modules;

use Feedex\Contracts\Modules\CommonModuleInterface;

final class Common extends Module implements CommonModuleInterface
{
    /** @return array<string, mixed> */
    public function ping(): array
    {
        return $this->publicGet('/api/v1/status');
    }

    /** @return array<string, mixed> */
    public function time(): array
    {
        return $this->publicGet('/api/v1/timestamp');
    }

    /** @return array<string, mixed> */
    public function maintainInfo(): array
    {
        return $this->publicGet('/api/v1/status');
    }
}
