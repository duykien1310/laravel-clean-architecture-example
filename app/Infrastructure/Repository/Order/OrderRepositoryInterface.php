<?php

namespace App\Infrastructure\Repository\Order;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function getById(int $id): ?Order;
    public function save(Order $order): Order;
    public function delete(Order $order): bool;
    public function getEagerOrder(int $orderId);
}
