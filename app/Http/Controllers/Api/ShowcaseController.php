<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowcaseRequest;
use App\Http\Resources\ShowcaseResource;
use App\Models\Showcase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ShowcaseController extends Controller
{
    public function index(): JsonResponse
    {
        $showcases = Showcase::all();

        return response()->json([
            'showcases' => ShowcaseResource::collection($showcases),
        ]);
    }

    public function show(Showcase $showcase): JsonResponse
    {
        return response()->json([
            'showcase' => ShowcaseResource::make($showcase),
        ]);
    }

    public function store(ShowcaseRequest $request): JsonResponse
    {
        $inputs = array_merge($request->validated(), [
            'user_id' => Auth::id(),
        ]);

        $showcase = Showcase::create($inputs);

        return response()->json([
            'showcase' => ShowcaseResource::make($showcase),
        ], 201);
    }

    public function update(ShowcaseRequest $request, Showcase $showcase): JsonResponse
    {
        $showcase->update(
            $request->validated()
        );

        return response()->json([
            'showcase' => ShowcaseResource::make($showcase),
        ]);
    }

    public function destroy(Showcase $showcase): JsonResponse
    {
        $showcase->delete();

        return response()->json([
            'message' => 'Showcase deleted successfully',
        ]);
    }
}
