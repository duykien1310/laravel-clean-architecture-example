<?php

namespace App\UseCase\Order;

use App\Models\Order;

interface OrderUseCase
{
    public function placeAnOrder(Order $order, $orderDetails);
}
