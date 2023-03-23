<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        $user->update($request->only('name', 'email', 'password'));

        return response()->json([
            'user' => $user,
        ]);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}