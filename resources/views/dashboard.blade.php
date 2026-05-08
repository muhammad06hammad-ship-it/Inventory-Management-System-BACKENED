@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>
    <p>Welcome back, <strong>{{ Auth::user()->name }}</strong>! Here's your inventory overview.</p>
</div>

{{-- ── Bootstrap 5 Stats Row ── --}}
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card stat-card" style="border-left-color:#3498db;">
            <span class="stat-icon text-primary"><i class="bi bi-box-seam"></i></span>
            <div class="stat-number text-primary">{{ $totalProducts }}</div>
            <p class="stat-label">Total Products</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card stat-card" style="border-left-color:#e74c3c;">
            <span class="stat-icon text-danger"><i class="bi bi-exclamation-triangle-fill"></i></span>
            <div class="stat-number text-danger">{{ $lowStockProducts }}</div>
            <p class="stat-label">Low Stock Items</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card stat-card" style="border-left-color:#27ae60;">
            <span class="stat-icon text-success"><i class="bi bi-shop"></i></span>
            <div class="stat-number text-success">{{ $totalSuppliers }}</div>
            <p class="stat-label">Total Suppliers</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        @if(Auth::user()->isAdmin())
        <a href="{{ route('users.index') }}" class="text-decoration-none">
        @endif
        <div class="card stat-card" style="border-left-color:#f39c12;">
            <span class="stat-icon text-warning"><i class="bi bi-people"></i></span>
            <div class="stat-number text-warning">{{ $totalUsers }}</div>
            <p class="stat-label">System Users</p>
        </div>
        @if(Auth::user()->isAdmin())
        </a>
        @endif
    </div>
</div>

{{-- ── Bootstrap 5 Nav Tabs for Recent Data ── --}}
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-list-ul"></i> Recent Stock Transactions
            </div>
            <div class="card-body p-0">
                @if($recentTransactions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Qty</th>
                                    <th>Date</th>
                                    <th>By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTransactions as $t)
                                    <tr>
                                        <td>
                                            <strong>{{ $t->product->name }}</strong><br>
                                            <small class="text-muted font-monospace">{{ $t->product->sku }}</small>
                                        </td>
                                        <td class="text-center">
                                            @if($t->type === 'in')
                                                <span class="badge bg-success rounded-pill">
                                                    <i class="bi bi-plus-circle me-1"></i>In
                                                </span>
                                            @else
                                                <span class="badge bg-danger rounded-pill">
                                                    <i class="bi bi-dash-circle me-1"></i>Out
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center"><strong>{{ $t->quantity }}</strong></td>
                                        <td>{{ $t->transaction_date->format('M d, Y') }}</td>
                                        <td>{{ $t->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center py-3">
                        <a href="{{ route('stock.history') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-clock-history me-1"></i>View All History
                        </a>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox display-5 d-block mb-2"></i>No transactions yet.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4 d-flex flex-column gap-4">
        {{-- Low Stock Alert --}}
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill text-warning"></i> Low Stock Alerts
            </div>
            <div class="card-body p-0">
                @php $lowStockItems = $products->filter(fn($p) => $p->isLowStock())->take(8); @endphp
                @if($lowStockItems->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($lowStockItems as $p)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <strong>{{ $p->name }}</strong><br>
                                    <small class="text-muted font-monospace">{{ $p->sku }}</small>
                                </div>
                                {{-- Bootstrap 5 badge with pill --}}
                                <span class="badge bg-danger rounded-pill">
                                    {{ $p->quantity_on_hand }}/{{ $p->minimum_stock }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-4 text-success">
                        <i class="bi bi-check-circle-fill display-5 d-block mb-2"></i>
                        All items are well stocked!
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="card">
            <div class="card-header"><i class="bi bi-lightning-charge me-2"></i>Quick Actions</div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('stock-in') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Record Stock In
                    </a>
                    <a href="{{ route('stock-out') }}" class="btn btn-danger">
                        <i class="bi bi-dash-circle me-2"></i>Record Stock Out
                    </a>
                    <a href="{{ route('reports.current-stock') }}" class="btn btn-outline-primary">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i>View Stock Report
                    </a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('products.create') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-plus me-2"></i>Add New Product
                        </a>
                        <a href="{{ route('suppliers.create') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-plus me-2"></i>Add Supplier
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
