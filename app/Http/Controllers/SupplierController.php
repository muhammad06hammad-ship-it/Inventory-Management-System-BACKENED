<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     */
    public function index(): View
    {
        $suppliers = Supplier::paginate(15);
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create(): View
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(SupplierRequest $request): RedirectResponse
    {
        Supplier::create($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    /**
     * Show the form for editing the specified supplier.
     */
    public function edit(Supplier $supplier): View
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(SupplierRequest $request, Supplier $supplier): RedirectResponse
    {
        $supplier->update($request->validated());
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified supplier from storage.
     */
    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
