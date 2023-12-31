<?php

namespace App\Infrastructure\Repository\OrderDetail;

use App\Models\OrderDetail;

interface OrderDetailRepositoryInterface
{
    public function getById(int $id): ?OrderDetail;
    public function save(OrderDetail $orderDetail);
    public function delete(OrderDetail $orderDetail): bool;
}
