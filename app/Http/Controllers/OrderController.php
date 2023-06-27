<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\UseCase\Order\OrderUseCase;

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
}
