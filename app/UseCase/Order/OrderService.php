<?php

namespace App\UseCase\Order;

use App\UseCase\Order\OrderUseCase;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Infrastructure\Repository\Order\OrderRepositoryInterface;
use App\Infrastructure\Repository\OrderDetail\OrderDetailRepositoryInterface;

class OrderService implements OrderUseCase
{
    protected $orderRepository;
    protected $orderDetailRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, OrderDetailRepositoryInterface $orderDetailRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function placeAnOrder(Order $orderRequest, $orderDetails)
    {
        // create table order
        $order = $this->orderRepository->save($orderRequest);

        // create table orderdetail
        foreach ($orderDetails as $item) {
            $orderDetail = new OrderDetail();

            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item['productId'];
            $orderDetail->quantity_ordered = $item['quantityOrdered'];

            $this->orderDetailRepository->save($orderDetail);
        }
    }
}
