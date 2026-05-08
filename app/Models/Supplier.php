<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'status',
    ];

    /**
     * Get the stock transactions for this supplier.
     */
    public function stockTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class);
    }
}
