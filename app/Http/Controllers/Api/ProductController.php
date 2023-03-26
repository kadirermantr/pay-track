<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json([
            'products' => ProductResource::collection($products),
        ]);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'product' => ProductResource::make($product),
        ]);
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $product = Product::create(
            $request->validated()
        );

        return response()->json([
            'product' => ProductResource::make($product),
        ], 201);
    }

    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $product->update(
            $request->validated()
        );

        return response()->json([
            'product' => ProductResource::make($product),
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }

    public function addFavorite(Product $product): JsonResponse
    {
        $user = Auth::user();
        $favorites = $user->favorites()->get();

        if ($favorites->contains($product)) {
            return response()->json([
                'message' => 'Product already added to favorites',
            ]);
        }

        $user->favorites()->sync($product->id, false);

        return response()->json([
            'message' => 'Product added to favorites successfully',
        ]);
    }

    public function removeFavorite(Product $product): JsonResponse
    {
        $user = Auth::user();
        $favorites = $user->favorites()->get();

        if (!$favorites->contains($product)) {
            return response()->json([
                'message' => 'Product not found in favorites',
            ]);
        }

        $user->favorites()->detach($product);

        return response()->json([
            'message' => 'Product removed from favorites successfully',
        ]);
    }
}
