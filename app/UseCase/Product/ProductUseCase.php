<?php

namespace App\UseCase\Product;

use App\Models\Product;


interface ProductUseCase
{
    public function getProduct(?int $id);

    public function create(Product $product): Product;

    public function update(int $id, Product $data): Product;

    public function delete(int $id): bool;
}
