<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return response()->json(['users' => $users]);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json(['user' => $user]);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function update(User $user): JsonResponse
    {
        $user->update(request()->all());

        return response()->json(['user' => $user]);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
