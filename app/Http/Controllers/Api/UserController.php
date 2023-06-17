<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\BasketResource;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::withTrashed()->get();

        return response()->json([
            'users' => UserResource::collection($users),
        ]);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'user' => UserResource::make($user),
        ]);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());

        return response()->json([
            'user' => UserResource::make($user),
        ]);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }

    public function products(User $user): JsonResponse
    {
        $products = $user->products()->get();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function favorites(User $user): JsonResponse
    {
        $favorites = $user->favorites()->get();

        return response()->json([
            'favorites' => FavoriteResource::collection($favorites),
        ]);
    }

    public function basket(User $user): JsonResponse
    {
        $basket = $user->basket()->get();

        return response()->json([
            'basket' => BasketResource::collection($basket),
        ]);
    }
}
