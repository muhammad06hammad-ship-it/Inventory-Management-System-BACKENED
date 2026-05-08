<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'category_id',
        'unit',
        'minimum_stock',
        'quantity_on_hand',
        'status',
        'description',
    ];

    /**
     * Get the category that owns this product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the stock transactions for this product.
     */
    public function stockTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class);
    }

    /**
     * Check if product is below minimum stock.
     */
    public function isLowStock(): bool
    {
        return $this->quantity_on_hand < $this->minimum_stock;
    }

    /**
     * Get stock in transactions for this product.
     */
    public function stockInTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class)->where('type', 'in');
    }

    /**
     * Get stock out transactions for this product.
     */
    public function stockOutTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class)->where('type', 'out');
    }
}
