<?php

namespace App\Infrastructure\Repository\OrderDetail;

use App\Models\OrderDetail;
use App\Infrastructure\Repository\OrderDetail\OrderDetailRepositoryInterface;

class OrderDetailRepository implements OrderDetailRepositoryInterface
{
    public function getById(int $id): ?OrderDetail
    {
        return OrderDetail::find($id);
    }

    public function save(OrderDetail $orderDeOrderDetail)
    {
        return $orderDeOrderDetail->save();
    }

    public function delete(OrderDetail $orderDeOrderDetail): bool
    {
        return $orderDeOrderDetail->delete();
    }
}
