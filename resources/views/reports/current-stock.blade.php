@extends('layouts.base')

@section('title', 'Current Stock Report')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-file-earmark-bar-graph me-2"></i>Current Stock Report</h1>
            <p>Current quantity on hand for all products</p>
        </div>
        <button class="btn btn-light" onclick="window.print()">
            <i class="bi bi-printer me-1"></i>Print Report
        </button>
    </div>
</div>

{{-- Bootstrap 5 Summary Badges --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="fs-3 fw-bold text-primary">{{ $products->total() }}</div>
            <div class="text-muted small">Total Products</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="fs-3 fw-bold text-danger">
                {{ $products->filter(fn($p) => $p->isLowStock())->count() }}
            </div>
            <div class="text-muted small">Low Stock</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="fs-3 fw-bold text-success">
                {{ $products->filter(fn($p) => !$p->isLowStock())->count() }}
            </div>
            <div class="text-muted small">Adequate Stock</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="fs-3 fw-bold text-secondary">{{ now()->format('M d, Y') }}</div>
            <div class="text-muted small">Generated On</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="stockSearch" class="form-control border-start-0 ps-0"
                           placeholder="Filter by name, SKU or category…">
                </div>
            </div>
            <div class="col-md-3">
                <select id="stockStatusFilter" class="form-select">
                    <option value="">All Stock Levels</option>
                    <option value="low">Low Stock Only</option>
                    <option value="ok">Adequate Only</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0" id="stockTable">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th class="text-center">Unit</th>
                            <th class="text-center">Min Stock</th>
                            <th class="text-center">On Hand</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr data-stock="{{ $product->isLowStock() ? 'low' : 'ok' }}">
                                <td><span class="badge bg-secondary font-monospace fw-normal">{{ $product->sku }}</span></td>
                                <td><strong>{{ $product->name }}</strong></td>
                                <td><span class="badge bg-info text-dark">{{ $product->category->name }}</span></td>
                                <td class="text-center">{{ $product->unit }}</td>
                                <td class="text-center">{{ $product->minimum_stock }}</td>
                                <td class="text-center">
                                    @if($product->isLowStock())
                                        <span class="badge bg-danger rounded-pill fs-6">{{ $product->quantity_on_hand }}</span>
                                    @else
                                        <span class="badge bg-success rounded-pill fs-6">{{ $product->quantity_on_hand }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($product->isLowStock())
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-circle me-1"></i>Low Stock
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>Adequate
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center py-3">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox display-4 d-block mb-3"></i>No products found.
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    function filterStock() {
        var q     = $('#stockSearch').val().toLowerCase();
        var level = $('#stockStatusFilter').val();
        $('#stockTable tbody tr').each(function () {
            var match = (!q || $(this).text().toLowerCase().includes(q))
                     && (!level || $(this).data('stock') === level);
            $(this).toggle(match);
        });
    }
    $('#stockSearch').on('keyup input', filterStock);
    $('#stockStatusFilter').on('change', filterStock);
});
</script>
@endpush
