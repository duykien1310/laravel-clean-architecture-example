<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Models\Product;
use App\UseCase\Product\ProductUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductUseCase $productService)
    {
        $this->productService = $productService;
    }

    // @Param ProductId int
    public function show(Request $request)
    {
        $id = $request->input('productId');
        $product = $this->productService->getProduct($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->product_name = $request->productName;
        $product->product_description = $request->productDescription;
        $product->quantity_in_stock = $request->quantityInStock;
        $product->buy_price = $request->buyPrice;
        $product->availability = $request->availability;
        $product = $this->productService->create($product);
        return response()->json($product, 201);
    }

    public function update(Request $request)
    {
        $id = $request->input('productId');
        $product = new Product;
        $product->product_name = $request->productName;
        $product->product_description = $request->productDescription;
        $product->quantity_in_stock = $request->quantityInStock;
        $product->buy_price = $request->buyPrice;
        $product->availability = $request->availability;

        $product = $this->productService->update($id, $product);
        if ($product) {
            return response()->json($product);
        }
        return response()->json(['error' => 'Product not found.'], 404);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('productId');
        $result = $this->productService->delete($id);
        if ($result) {
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Product not found.'], 404);
    }
}
