<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Http\Requests\StockTransactionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    /**
     * Show stock in form.
     */
    public function showStockInForm(): View
    {
        $products  = Product::where('status', 'active')->orderBy('name')->get();
        $suppliers = Supplier::where('status', 'active')->orderBy('name')->get();
        return view('stock.stock-in', compact('products', 'suppliers'));
    }

    /**
     * Store stock in transaction (atomic DB transaction).
     */
    public function storeStockIn(StockTransactionRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            StockTransaction::create([
                'product_id'       => $request->product_id,
                'supplier_id'      => $request->supplier_id,
                'user_id'          => Auth::id(),
                'type'             => 'in',
                'quantity'         => $request->quantity,
                'transaction_date' => $request->transaction_date,
                'remarks'          => $request->remarks,
            ]);

            $product->increment('quantity_on_hand', $request->quantity);
        });

        return redirect()->route('stock-in')
            ->with('success', 'Stock in recorded successfully.');
    }

    /**
     * Show stock out form.
     */
    public function showStockOutForm(): View
    {
        $products = Product::where('status', 'active')->orderBy('name')->get();
        return view('stock.stock-out', compact('products'));
    }

    /**
     * Store stock out transaction (atomic DB transaction).
     */
    public function storeStockOut(StockTransactionRequest $request): RedirectResponse
    {
        $error = null;

        DB::transaction(function () use ($request, &$error) {
            $product = Product::lockForUpdate()->findOrFail($request->product_id);

            if ($product->quantity_on_hand < $request->quantity) {
                $error = 'Insufficient stock. Available: ' . $product->quantity_on_hand . ' ' . $product->unit;
                return;
            }

            StockTransaction::create([
                'product_id'       => $request->product_id,
                'supplier_id'      => null,
                'user_id'          => Auth::id(),
                'type'             => 'out',
                'quantity'         => $request->quantity,
                'transaction_date' => $request->transaction_date,
                'remarks'          => $request->remarks,
            ]);

            $product->decrement('quantity_on_hand', $request->quantity);
        });

        if ($error) {
            return redirect()->back()->withErrors(['quantity' => $error])->withInput();
        }

        return redirect()->route('stock-out')
            ->with('success', 'Stock out recorded successfully.');
    }

    /**
     * Display stock transactions history.
     */
    public function history(): View
    {
        $transactions = StockTransaction::with(['product', 'supplier', 'user'])
            ->latest('transaction_date')
            ->paginate(20);

        return view('stock.history', compact('transactions'));
    }

    /**
     * AJAX: return current stock info for a product.
     */
    public function getProductStock(Product $product): JsonResponse
    {
        return response()->json([
            'id'               => $product->id,
            'name'             => $product->name,
            'sku'              => $product->sku,
            'quantity_on_hand' => $product->quantity_on_hand,
            'minimum_stock'    => $product->minimum_stock,
            'unit'             => $product->unit,
            'is_low_stock'     => $product->isLowStock(),
        ]);
    }
}
