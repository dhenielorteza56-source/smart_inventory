<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $base = Product::forUser($userId);

        $stats = [
            'total_products' => (clone $base)->count(),
            'low_stock'      => (clone $base)->lowStock()->count(),
            'out_of_stock'   => (clone $base)->outOfStock()->count(),
            'total_value'    => (clone $base)->selectRaw('COALESCE(SUM(price * quantity), 0) as value')->value('value'),
        ];

        $categories = Category::forUser($userId)->orderBy('name')->get(['id', 'name']);
        $suppliers  = Supplier::forUser($userId)->orderBy('name')->get(['id', 'name']);

        return view('inventory', compact('stats', 'categories', 'suppliers'));
    }
}
