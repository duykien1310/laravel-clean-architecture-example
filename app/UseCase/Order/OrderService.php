<?php

namespace App\UseCase\Order;

use App\UseCase\Order\OrderUseCase;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Infrastructure\Repository\Order\OrderRepositoryInterface;
use App\Infrastructure\Repository\OrderDetail\OrderDetailRepositoryInterface;
use App\Infrastructure\Repository\Product\ProductRepository;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderUseCase
{
    protected $orderRepository;
    protected $orderDetailRepository;
    protected $productRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, OrderDetailRepositoryInterface $orderDetailRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->productRepository = $productRepository;
    }

    public function placeAnOrder(Order $orderRequest, $orderDetails)
    {
        DB::beginTransaction();

        try {
            // create table order
            $order = $this->orderRepository->save($orderRequest);
            if (!$order) {
                throw new \Exception('fail');
            }

            // create table orderdetail
            foreach ($orderDetails as $item) {
                $orderDetail = new OrderDetail();

                $product = $this->productRepository->getById($item['productId']);

                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $item['productId'];
                $orderDetail->quantity_ordered = $item['quantityOrdered'];
                $orderDetail->price_each = $item['quantityOrdered'] * $product->buy_price;
                $ordedt = $this->orderDetailRepository->save($orderDetail);
                if (!$ordedt) {
                    throw new \Exception('fail');
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getEagerOrder(int $orderId)
    {
        return $this->orderRepository->getEagerOrder($orderId);
    }
}
