@extends('layouts.base')

@section('title', 'Stock Movement Report')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-arrow-left-right"></i> Stock Movement Report</h1>
    <p>Track stock movements for specific products or date ranges</p>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('reports.stock-movement') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="product_id" class="form-label">Product</label>
                <select class="form-select" id="product_id" name="product_id">
                    <option value="">-- All Products --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} ({{ $product->sku }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" class="form-control" id="from_date" name="from_date" value="{{ request('from_date') }}">
            </div>

            <div class="col-md-3">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" class="form-control" id="to_date" name="to_date" value="{{ request('to_date') }}">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <span>Movements</span>
            <button class="btn btn-sm btn-primary" onclick="window.print()">
                <i class="bi bi-printer"></i> Print Report
            </button>
        </div>
    </div>
    <div class="card-body">
        @if($transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Supplier</th>
                            <th>Recorded By</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
                                <td>
                                    <strong>{{ $transaction->product->name }}</strong><br>
                                    <small class="text-muted">{{ $transaction->product->sku }}</small>
                                </td>
                                <td>
                                    @if($transaction->type === 'in')
                                        <span class="badge" class="bg-success">
                                            <i class="bi bi-plus-circle"></i> In
                                        </span>
                                    @else
                                        <span class="badge" class="bg-danger">
                                            <i class="bi bi-dash-circle"></i> Out
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $transaction->quantity }} {{ $transaction->product->unit }}</td>
                                <td>{{ $transaction->supplier->name ?? '-' }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->remarks ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $transactions->links() }}
            </div>
        @else
            <p class="text-muted text-center py-5">No transactions found for the selected filters.</p>
        @endif
    </div>
</div>
@endsection
