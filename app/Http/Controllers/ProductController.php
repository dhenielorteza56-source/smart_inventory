<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::forUser(Auth::id())
            ->with(['category', 'supplier'])
            ->orderBy('name')
            ->get()
            ->map(fn($p) => $this->formatProduct($p));

        return response()->json($products);
    }

    public function store(Request $request): JsonResponse
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => [
                'required', 'string', 'max:100',
                "unique:products,sku,NULL,id,user_id,{$userId}",
            ],
            'description' => 'nullable|string|max:1000',
            'quantity'    => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'category_id' => "required|exists:categories,id,user_id,{$userId}",
            'supplier_id' => "required|exists:suppliers,id,user_id,{$userId}",
            'image'       => 'nullable|string|max:2048',
        ]);

        $validated['user_id'] = $userId;

        $product = Product::create($validated);
        $product->load(['category', 'supplier']);

        return response()->json($this->formatProduct($product), 201);
    }

    public function show(Product $product): JsonResponse
    {
        $this->authorizeOwner($product);
        $product->load(['category', 'supplier']);

        return response()->json($this->formatProduct($product));
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $this->authorizeOwner($product);
        $userId = Auth::id();

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'sku'         => [
                'sometimes', 'required', 'string', 'max:100',
                "unique:products,sku,{$product->id},id,user_id,{$userId}",
            ],
            'description' => 'nullable|string|max:1000',
            'quantity'    => 'sometimes|required|integer|min:0',
            'price'       => 'sometimes|required|numeric|min:0',
            'category_id' => "sometimes|required|exists:categories,id,user_id,{$userId}",
            'supplier_id' => "sometimes|required|exists:suppliers,id,user_id,{$userId}",
            'image'       => 'nullable|string|max:2048',
        ]);

        $product->update($validated);
        $product->load(['category', 'supplier']);

        return response()->json($this->formatProduct($product));
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->authorizeOwner($product);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function updateStock(Request $request, Product $product): JsonResponse
    {
        $this->authorizeOwner($product);

        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $product->update(['quantity' => $validated['quantity']]);
        $product->refresh();

        return response()->json([
            'message'      => 'Stock updated successfully',
            'id'           => $product->id,
            'quantity'     => $product->quantity,
            'is_low_stock' => $product->is_low_stock,
            'is_out_of_stock' => $product->is_out_of_stock,
        ]);
    }

    public function findBySku(string $sku): JsonResponse
    {
        $product = Product::forUser(Auth::id())
            ->where('sku', $sku)
            ->with(['category', 'supplier'])
            ->first();

        if (! $product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($this->formatProduct($product));
    }

    private function formatProduct(Product $product): array
    {
        return [
            'id'             => $product->id,
            'name'           => $product->name,
            'sku'            => $product->sku,
            'description'    => $product->description,
            'quantity'       => $product->quantity,
            'price'          => $product->price,
            'category_id'    => $product->category_id,
            'supplier_id'    => $product->supplier_id,
            'image'          => $product->image,
            'category'       => $product->category?->name,
            'supplier'       => $product->supplier?->name,
            'is_low_stock'   => $product->is_low_stock,
            'is_out_of_stock' => $product->is_out_of_stock,
            'created_at'     => $product->created_at?->toDateTimeString(),
            'updated_at'     => $product->updated_at?->toDateTimeString(),
        ];
    }

    private function authorizeOwner(Product $product): void
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}
