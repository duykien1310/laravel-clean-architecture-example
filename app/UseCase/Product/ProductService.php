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

    public function create(Product $Product): Product
    {
        return $this->productRepository->create($Product);
    }

    public function update(int $id, Product $data): Product
    {
        $Product = $this->productRepository->getById($id);

        if ($data->product_name != null) {
            $Product->product_name = $data->product_name;
        }

        if ($data->product_description != null) {
            $Product->product_description = $data->product_description;
        }

        if ($data->quantity_in_stock != null) {
            $Product->quantity_in_stock = $data->quantity_in_stock;
        }

        if ($data->buy_price != null) {
            $Product->buy_price = $data->buy_price;
        }

        if ($data->availability != null) {
            $Product->availability = $data->availability;
        }

        if ($Product) {
            return $this->productRepository->update($Product);
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $Product = $this->productRepository->getById($id);
        if ($Product) {
            return $this->productRepository->delete($Product);
        }
        return false;
    }
}
