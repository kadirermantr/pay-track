<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\Basket;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request): JsonResponse
    {
        $inputs = array_merge($request->validated(), [
            'password' => bcrypt($request->password),
        ]);

        $user = User::create($inputs);

        Basket::create([
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'Successfully created user!',
        ], 201);
    }

    public function login(AuthLoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'Email or password is wrong',
            ], 401);
        }

        return response()->json(
            AuthResource::make(Auth::user())
        );
    }

    public function logout(): JsonResponse
    {
        if (! Auth::check()) {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }

        Auth::user()->token()->revoke();

        return response()->json([
            'success' => 'Successfully logged out',
        ]);
    }
}
