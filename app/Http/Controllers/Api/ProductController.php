<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'product' => $product,
        ]);
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $product = Product::create(
            $request->only('name', 'description', 'image', 'price', 'stock', 'category_id')
        );

        return response()->json([
            'product' => $product,
        ]);
    }

    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $product->update(
            $request->only('name', 'description', 'image', 'price', 'stock', 'category_id')
        );

        return response()->json([
            'product' => $product,
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
