@extends('layouts.base')

@section('title', 'Products')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-box-seam me-2"></i>Products</h1>
            <p>Manage your product inventory</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-light fw-semibold">
            <i class="bi bi-plus-circle me-1"></i>Add New Product
        </a>
    </div>
</div>

<div class="card">
    {{-- Search + Filter toolbar (Bootstrap 5 input-group + jQuery live filter) --}}
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="productSearch"
                           class="form-control border-start-0 ps-0"
                           placeholder="Search by name, SKU or category…">
                </div>
            </div>
            <div class="col-md-3">
                <select id="statusFilter" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="stockFilter" class="form-select">
                    <option value="">All Stock</option>
                    <option value="low">Low Stock</option>
                    <option value="ok">Adequate</option>
                </select>
            </div>
            <div class="col-md-2 text-end">
                <span class="badge bg-secondary rounded-pill py-2 px-3" id="rowCount">
                    Showing <span id="visibleCount">{{ $products->count() }}</span> items
                </span>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0" id="productsTable">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th class="text-center">On Hand</th>
                            <th class="text-center">Min Stock</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr data-status="{{ $product->status }}"
                                data-stock="{{ $product->isLowStock() ? 'low' : 'ok' }}">
                                <td>
                                    <span class="badge bg-secondary rounded-pill fw-normal font-monospace">
                                        {{ $product->sku }}
                                    </span>
                                </td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    @if($product->description)
                                        <br><small class="text-muted">{{ Str::limit($product->description, 45) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">{{ $product->category->name }}</span>
                                </td>
                                <td>{{ $product->unit }}</td>
                                <td class="text-center">
                                    @if($product->isLowStock())
                                        <span class="badge bg-danger rounded-pill">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $product->quantity_on_hand }}
                                        </span>
                                    @else
                                        <span class="badge bg-success rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i>{{ $product->quantity_on_hand }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $product->minimum_stock }}</td>
                                <td class="text-center">
                                    @if($product->status === 'active')
                                        <span class="badge bg-success rounded-pill">Active</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        {{-- Bootstrap 5 Tooltip on edit button --}}
                                        <a href="{{ route('products.edit', $product) }}"
                                           class="btn btn-warning btn-sm"
                                           data-bs-toggle="tooltip" title="Edit Product">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        {{-- Bootstrap 5 Modal delete --}}
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-delete-url="{{ route('products.destroy', $product) }}"
                                                data-delete-name="{{ $product->name }}"
                                                data-bs-toggle="tooltip" title="Delete Product">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
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
                <i class="bi bi-box-seam display-4 d-block mb-3"></i>
                <p>No products found. <a href="{{ route('products.create') }}">Create one now.</a></p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    // ── Bootstrap 5 Tooltips init ──
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
        bootstrap.Tooltip.getOrCreateInstance(el);
    });

    // ── jQuery live search + filter (no page reload) ──
    function filterTable() {
        var search = $('#productSearch').val().toLowerCase();
        var status = $('#statusFilter').val();
        var stock  = $('#stockFilter').val();
        var count  = 0;

        $('#productsTable tbody tr').each(function () {
            var rowText    = $(this).text().toLowerCase();
            var rowStatus  = $(this).data('status');
            var rowStock   = $(this).data('stock');

            var matchText   = rowText.indexOf(search) > -1;
            var matchStatus = !status || rowStatus === status;
            var matchStock  = !stock  || rowStock  === stock;

            if (matchText && matchStatus && matchStock) {
                $(this).show(); count++;
            } else {
                $(this).hide();
            }
        });
        $('#visibleCount').text(count);
    }

    $('#productSearch').on('keyup input', filterTable);
    $('#statusFilter, #stockFilter').on('change', filterTable);
});
</script>
@endpush
