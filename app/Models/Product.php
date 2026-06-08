<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'name', 'sku', 'description', 'quantity', 'price',
        'category_id', 'supplier_id', 'image',
    ];

    protected $casts = [
        'price'    => 'decimal:2',
        'quantity' => 'integer',
    ];

    // Relationships

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    // Scopes

    /**
     * Scope to a specific user's products.
     */
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeLowStock(Builder $query, int $threshold = 10): Builder
    {
        return $query->where('quantity', '>', 0)->where('quantity', '<', $threshold);
    }

    public function scopeOutOfStock(Builder $query): Builder
    {
        return $query->where('quantity', 0);
    }

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('quantity', '>', 0);
    }

    // Accessors

    public function getIsLowStockAttribute(): bool
    {
        return $this->quantity > 0 && $this->quantity < 10;
    }

    public function getIsOutOfStockAttribute(): bool
    {
        return $this->quantity === 0;
    }
}
