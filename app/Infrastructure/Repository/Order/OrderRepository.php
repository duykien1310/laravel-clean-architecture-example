<?php

namespace App\Infrastructure\Repository\Order;

use App\Models\Order;
use App\Infrastructure\Repository\Order\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getById(int $id): ?Order
    {
        return Order::find($id);
    }

    public function save(Order $order): Order
    {
        $order->save();
        return $order;
    }

    public function delete(Order $order): bool
    {
        return $order->delete();
    }
}
