<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display current stock levels.
     */
    public function currentStock(): View
    {
        $products = Product::with('category')
            ->where('status', 'active')
            ->orderBy('quantity_on_hand')
            ->paginate(15);

        return view('reports.current-stock', compact('products'));
    }

    /**
     * Display stock movement report with filters.
     */
    public function stockMovement(Request $request): View
    {
        $query = StockTransaction::with(['product', 'supplier', 'user']);

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }
        if ($request->filled('from_date')) {
            $query->whereDate('transaction_date', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('transaction_date', '<=', $request->to_date);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->latest('transaction_date')->paginate(20)->withQueryString();
        $products     = Product::where('status', 'active')->orderBy('name')->get();

        return view('reports.stock-movement', compact('transactions', 'products'));
    }

    /**
     * Display stock summary by product (N+1 fixed with eager loading).
     */
    public function stockSummary(Request $request): View
    {
        $fromDate = $request->filled('from_date')
            ? \Carbon\Carbon::parse($request->from_date)
            : now()->subMonth();

        $toDate = $request->filled('to_date')
            ? \Carbon\Carbon::parse($request->to_date)
            : now();

        $products = Product::with([
            'category',
            'stockTransactions' => function ($q) use ($fromDate, $toDate) {
                $q->whereBetween('transaction_date', [$fromDate->toDateString(), $toDate->toDateString()]);
            },
        ])->where('status', 'active')->orderBy('name')->get();

        $summary = $products->map(function ($product) {
            $txns = $product->stockTransactions;
            return [
                'product'      => $product,
                'stock_in'     => $txns->where('type', 'in')->sum('quantity'),
                'stock_out'    => $txns->where('type', 'out')->sum('quantity'),
                'net_movement' => $txns->where('type', 'in')->sum('quantity')
                                - $txns->where('type', 'out')->sum('quantity'),
            ];
        });

        return view('reports.stock-summary', compact('summary', 'fromDate', 'toDate'));
    }
}
