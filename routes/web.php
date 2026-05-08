<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Auth routes (guests only)
Route::middleware('guest')->group(function () {
    Route::get('/login',    [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login',   [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

    Route::get('/register',  [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // AJAX: live stock level lookup (used by Stock In / Stock Out forms)
    Route::get('/api/product-stock/{product}', [StockTransactionController::class, 'getProductStock'])
         ->name('api.product-stock');

    // Stock Transactions (all authenticated users)
    Route::get('/stock-in',  [StockTransactionController::class, 'showStockInForm'])->name('stock-in');
    Route::post('/stock-in', [StockTransactionController::class, 'storeStockIn'])->name('stock-in.store');

    Route::get('/stock-out',  [StockTransactionController::class, 'showStockOutForm'])->name('stock-out');
    Route::post('/stock-out', [StockTransactionController::class, 'storeStockOut'])->name('stock-out.store');

    Route::get('/stock/history', [StockTransactionController::class, 'history'])->name('stock.history');

    // Reports (all authenticated users)
    Route::get('/reports/current-stock',   [ReportController::class, 'currentStock'])->name('reports.current-stock');
    Route::get('/reports/stock-movement',  [ReportController::class, 'stockMovement'])->name('reports.stock-movement');
    Route::get('/reports/stock-summary',   [ReportController::class, 'stockSummary'])->name('reports.stock-summary');

    // Admin-only routes
    Route::middleware('admin')->group(function () {

        // Products CRUD
        Route::resource('products', ProductController::class)->except(['show']);

        // Suppliers CRUD
        Route::resource('suppliers', SupplierController::class)->except(['show']);

        // User Management CRUD
        Route::resource('users', UserController::class)->except(['show']);
    });
});
