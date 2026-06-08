<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::forUser(Auth::id())
            ->withCount('products')
            ->orderBy('name')
            ->get();

        return response()->json($categories);
    }

    public function store(Request $request): JsonResponse
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'name'        => [
                'required', 'string', 'max:255',
                "unique:categories,name,NULL,id,user_id,{$userId}",
            ],
            'description' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = $userId;

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    public function show(Category $category): JsonResponse
    {
        $this->authorizeOwner($category);
        $category->loadCount('products');

        return response()->json($category);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $this->authorizeOwner($category);
        $userId = Auth::id();

        $validated = $request->validate([
            'name'        => [
                'sometimes', 'required', 'string', 'max:255',
                "unique:categories,name,{$category->id},id,user_id,{$userId}",
            ],
            'description' => 'nullable|string|max:500',
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    public function destroy(Category $category): JsonResponse
    {
        $this->authorizeOwner($category);

        if ($category->products()->exists()) {
            return response()->json([
                'message' => 'Cannot delete category with existing products. Reassign or delete products first.',
            ], 422);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }

    private function authorizeOwner(Category $category): void
    {
        if ($category->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}
