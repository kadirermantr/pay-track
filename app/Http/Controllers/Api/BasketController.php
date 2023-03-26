<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketRequest;
use App\Models\Product;
use App\Models\Showcase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function addBasket(BasketRequest $request, Showcase $showcase): JsonResponse
    {
        $product = Product::find($request->product_id);

        if ($showcase->products()->where('id', $product->id)->doesntExist()) {
            return response()->json([
                'message' => 'Product not found in showcase',
            ], 409);
        }

        $basket = Auth::user()->basket()->first();
        $products = $basket->products()->get();

        if ($products->contains($product)) {
            return response()->json([
                'message' => 'Product already added to basket',
            ], 409);
        }

        $basket->products()->sync([
            'basket_id' => $basket->id,
            'product_id' => $product->id,
        ], false);

        return response()->json([
            'message' => 'Product added to basket successfully',
        ], 201);
    }

    public function removeBasket(BasketRequest $request, Showcase $showcase): JsonResponse
    {
        $product = Product::find($request->product_id);

        if ($showcase->products()->where('id', $product->id)->doesntExist()) {
            return response()->json([
                'message' => 'Product not found in showcase',
            ], 409);
        }

        $basket = Auth::user()->basket()->first();
        $products = $basket->products()->get();

        if (!$products->contains($product)) {
            return response()->json([
                'message' => 'Product not found in basket',
            ], 409);
        }

        $basket->products()->detach($product);

        return response()->json([
            'message' => 'Product removed from basket successfully',
        ]);
    }
}
