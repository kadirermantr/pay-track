<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json(['message' => 'Successfully created user!'], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

       if (Auth::attempt($credentials)) {
           $user = Auth::user();

           return response()->json([
               'token' => $user->createToken('login')->accessToken,
               'token_type' => 'Bearer',
               'expires_at' => Carbon::parse(Carbon::now()->addWeek())->toDateTimeString(),
               'success' => 'Successfully logged in',
           ]);
       }

       return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();

            return response()->json(['success' => 'Successfully logged out']);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
