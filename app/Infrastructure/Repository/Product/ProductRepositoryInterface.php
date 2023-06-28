<?php

namespace App\Infrastructure\Repository\Product;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getProduct(?int $id);

    public function getById(int $id): ?Product;

    public function save(Product $product);

    public function delete(Product $product);
}
