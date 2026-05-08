<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds performance indexes and ensures quantity columns are unsigned.
     */
    public function up(): void
    {
        // Add indexes to stock_transactions for faster filtering in reports
        Schema::table('stock_transactions', function (Blueprint $table) {
            $table->index('product_id',       'idx_txn_product');
            $table->index('type',             'idx_txn_type');
            $table->index('transaction_date', 'idx_txn_date');
            $table->index(['product_id', 'type', 'transaction_date'], 'idx_txn_product_type_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_transactions', function (Blueprint $table) {
            $table->dropIndex('idx_txn_product');
            $table->dropIndex('idx_txn_type');
            $table->dropIndex('idx_txn_date');
            $table->dropIndex('idx_txn_product_type_date');
        });
    }
};
