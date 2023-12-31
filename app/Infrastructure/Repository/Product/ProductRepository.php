<?php

namespace App\Infrastructure\Repository\Product;

use App\Models\Product;
use App\Infrastructure\Repository\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getProduct(?int $id)
    {
        if ($id == null) {
            return Product::all();
        }
        return Product::find($id);
    }

    public function getById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function save(Product $product)
    {
        return $product->save();
    }

    public function delete(Product $product)
    {
        return $product->delete($product);
    }
}
