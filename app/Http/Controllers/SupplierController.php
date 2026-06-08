<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index(): JsonResponse
    {
        $suppliers = Supplier::forUser(Auth::id())
            ->withCount('products')
            ->orderBy('name')
            ->get();

        return response()->json($suppliers);
    }

    public function store(Request $request): JsonResponse
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => [
                'required', 'email', 'max:255',
                "unique:suppliers,email,NULL,id,user_id,{$userId}",
            ],
            'phone'   => 'required|string|max:50',
            'address' => 'required|string|max:500',
        ]);

        $validated['user_id'] = $userId;

        $supplier = Supplier::create($validated);

        return response()->json($supplier, 201);
    }

    public function show(Supplier $supplier): JsonResponse
    {
        $this->authorizeOwner($supplier);
        $supplier->loadCount('products');

        return response()->json($supplier);
    }

    public function update(Request $request, Supplier $supplier): JsonResponse
    {
        $this->authorizeOwner($supplier);
        $userId = Auth::id();

        $validated = $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'email'   => [
                'sometimes', 'required', 'email', 'max:255',
                "unique:suppliers,email,{$supplier->id},id,user_id,{$userId}",
            ],
            'phone'   => 'sometimes|required|string|max:50',
            'address' => 'sometimes|required|string|max:500',
        ]);

        $supplier->update($validated);

        return response()->json($supplier);
    }

    public function destroy(Supplier $supplier): JsonResponse
    {
        $this->authorizeOwner($supplier);

        if ($supplier->products()->exists()) {
            return response()->json([
                'message' => 'Cannot delete supplier with existing products. Reassign or delete products first.',
            ], 422);
        }

        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted successfully']);
    }

    private function authorizeOwner(Supplier $supplier): void
    {
        if ($supplier->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}
