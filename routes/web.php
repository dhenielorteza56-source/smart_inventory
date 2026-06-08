<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\BarcodeLookupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::middleware('auth')->group(function () {

    // Dashboard redirects to inventory
    Route::get('/dashboard', fn() => redirect()->route('inventory'))->name('dashboard');

    // Main inventory page (renders the SPA shell)
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');

    // JSON API routes (all return JSON)
    Route::prefix('api')->name('api.')->group(function () {

        // SKU lookup must be defined before the resource to prevent route shadowing
        Route::get('products/sku/{sku}', [ProductController::class, 'findBySku'])
            ->name('products.findBySku');

        Route::apiResource('products', ProductController::class);
        Route::patch('products/{product}/stock', [ProductController::class, 'updateStock'])
            ->name('products.updateStock');

        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('suppliers', SupplierController::class);

        // External barcode lookup proxy (avoids CORS on UPCitemdb)
        Route::get('barcode-lookup', [BarcodeLookupController::class, 'lookup'])
            ->name('barcode.lookup');
    });

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
