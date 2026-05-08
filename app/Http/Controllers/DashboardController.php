<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): View
    {
        $totalProducts   = Product::count();
        $lowStockProducts = Product::where('status', 'active')
            ->whereColumn('quantity_on_hand', '<', 'minimum_stock')
            ->count();
        $totalSuppliers  = Supplier::count();
        $totalUsers      = User::count();

        $recentTransactions = StockTransaction::with(['product', 'supplier', 'user'])
            ->latest('transaction_date')
            ->take(10)
            ->get();

        $products = Product::with('category')
            ->where('status', 'active')
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'lowStockProducts',
            'totalSuppliers',
            'totalUsers',
            'recentTransactions',
            'products'
        ));
    }
}
