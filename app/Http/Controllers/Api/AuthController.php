<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request): JsonResponse
    {
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'Successfully created user!',
        ], 201);
    }

    public function login(AuthLoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return response()->json([
                'token' => $user->createToken('login')->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(Carbon::now()->addWeek())->toDateTimeString(),
                'success' => 'Successfully logged in',
            ]);
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
