<?php

declare(strict_types=1);

namespace Feedex\Kucoin\v1\Modules;

use Feedex\Contracts\Modules\SpotOrderCoreModuleInterface;
use InvalidArgumentException;

final class SpotOrder extends Module implements SpotOrderCoreModuleInterface
{
    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    public function putOrder(array $payload): array
    {
        return $this->privatePost('/api/v1/orders', $payload);
    }

    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    public function cancelOrder(array $payload): array
    {
        $orderId = $payload['order_id'] ?? null;
        if (is_string($orderId) && $orderId !== '') {
            return $this->privateDelete('/api/v1/orders/' . $orderId);
        }

        $clientOid = $payload['client_oid'] ?? null;
        if (is_string($clientOid) && $clientOid !== '') {
            return $this->privateDelete('/api/v1/order/client-order/' . $clientOid);
        }

        throw new InvalidArgumentException('cancelOrder requires order_id or client_oid.');
    }

    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    public function cancelAllOrder(array $payload): array
    {
        return $this->privateDelete('/api/v1/orders', $payload);
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function getOrderStatus(array $query): array
    {
        $orderId = $query['order_id'] ?? null;
        if (is_string($orderId) && $orderId !== '') {
            return $this->privateGet('/api/v1/orders/' . $orderId);
        }

        $clientOid = $query['client_oid'] ?? null;
        if (is_string($clientOid) && $clientOid !== '') {
            return $this->privateGet('/api/v1/order/client-order/' . $clientOid);
        }

        throw new InvalidArgumentException('getOrderStatus requires order_id or client_oid.');
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listPendingOrder(array $query = []): array
    {
        return $this->privateGet('/api/v1/orders', array_merge($query, ['status' => 'active']));
    }

    /**
     * @param array<string, mixed> $query
     * @return array<string, mixed>
     */
    public function listFinishedOrder(array $query = []): array
    {
        return $this->privateGet('/api/v1/orders', array_merge($query, ['status' => 'done']));
    }
}
