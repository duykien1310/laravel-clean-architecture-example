<?php

namespace App\UseCase\Product;

use App\UseCase\Product\ProductUseCase;
use App\Models\Product;
use App\Infrastructure\Repository\Product\ProductRepositoryInterface;

class ProductService implements ProductUseCase
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProduct(?int $id)
    {
        return $this->productRepository->getProduct($id);
    }

    public function create(Product $product): Product
    {
        return $this->productRepository->save($product);
    }

    public function update(int $id, Product $data): Product
    {
        $product = $this->productRepository->getById($id);

        if ($data->product_name != null) {
            $product->product_name = $data->product_name;
        }

        if ($data->product_description != null) {
            $product->product_description = $data->product_description;
        }

        if ($data->quantity_in_stock != null) {
            $product->quantity_in_stock = $data->quantity_in_stock;
        }

        if ($data->buy_price != null) {
            $product->buy_price = $data->buy_price;
        }

        if ($data->availability != null) {
            $product->availability = $data->availability;
        }

        if ($product) {
            return $this->productRepository->save($product);
        }
        return null;
    }

    public function delete(int $id)
    {
        $product = $this->productRepository->getById($id);
        if ($product) {
            return $this->productRepository->delete($product);
        }
        return false;
    }
}
