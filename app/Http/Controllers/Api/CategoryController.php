<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json([
            'categories' => $categories,
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json([
            'category' => $category,
        ]);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->only('name', 'description'));

        return response()->json([
            'category' => $category,
        ]);
    }

    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        $category->update($request->only('name', 'description'));

        return response()->json([
            'category' => $category,
        ]);
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
        ]);
    }
}
