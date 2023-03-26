<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\AuthResource;
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

        User::create($inputs);

        return response()->json([
            'message' => 'Successfully created user!',
        ], 201);
    }

    public function login(AuthLoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return response()->json(
                AuthResource::make($user)
            );
        }

        return response()->json([
            'error' => 'Unauthorized',
        ], 401);
    }

    public function logout(): JsonResponse
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();

            return response()->json(['success' => 'Successfully logged out']);
        }

        return response()->json([
            'error' => 'Unauthorized',
        ], 401);
    }
}
