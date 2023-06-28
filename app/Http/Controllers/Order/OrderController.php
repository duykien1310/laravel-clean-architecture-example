<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Models\Order;
use App\UseCase\Order\OrderUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderUseCase $orderService)
    {
        $this->orderService = $orderService;
    }

    public function placeAnOrder(Request $request)
    {
        $order = new Order;
        $order->user_id = $request->userId;
        $order->required_date = $request->requiredDate;
        $order->shipped_date = $request->shippedDate;
        $order->comment = $request->comment;
        $order->status = $request->status;

        $orderItems = $request->orderItems;

        $this->orderService->placeAnOrder($order, $orderItems);
    }

    public function getEagerOrder(Request $request)
    {
        $orderId = $request->input('orderId');
        return $this->orderService->getEagerOrder($orderId);
    }
}
