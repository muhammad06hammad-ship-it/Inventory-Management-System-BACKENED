@extends('layouts.base')
 
@section('title', 'Stock In')
 
@section('content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle"></i> Record Stock In</h1>
    <p>Record incoming stock from suppliers</p>
</div>
 
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('stock-in.store') }}" method="POST">
                    @csrf
 
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Product *</label>
                        <select class="form-select @error('product_id') is-invalid @enderror"
                                id="product_id" name="product_id" required>
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} ({{ $product->sku }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
 
                    {{-- AJAX: live stock info panel --}}
                    <div id="stockInfoPanel" class="alert alert-info d-none mb-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <span>
                                <i class="bi bi-info-circle"></i>
                                <strong id="ajaxProductName"></strong>
                                &nbsp;|&nbsp; SKU: <span id="ajaxSku"></span>
                            </span>
                            <span>
                                Current stock:
                                <strong id="ajaxQty" class="fs-5"></strong>
                                <span id="ajaxUnit"></span>
                                <span id="ajaxLowBadge" class="badge d-none ms-1"
                                      style="background:#e74c3c;color:white;">Low Stock</span>
                            </span>
                        </div>
                    </div>
 
                    <div id="stockLoading" class="text-muted small mb-2 d-none">
                        <span class="spinner-border spinner-border-sm me-1"></span> Loading stock info...
                    </div>
 
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select class="form-select @error('supplier_id') is-invalid @enderror"
                                id="supplier_id" name="supplier_id">
                            <option value="">-- Select Supplier (Optional) --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
 
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity *</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                               id="quantity" name="quantity" value="{{ old('quantity') }}"
                               min="1" required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
 
                    <div class="mb-3">
                        <label for="transaction_date" class="form-label">Transaction Date *</label>
                        <input type="date" class="form-control @error('transaction_date') is-invalid @enderror"
                               id="transaction_date" name="transaction_date"
                               value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                        @error('transaction_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
 
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control @error('remarks') is-invalid @enderror"
                                  id="remarks" name="remarks" rows="3"
                                  placeholder="e.g., Purchase order #456, Received from warehouse">{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
 
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Record Stock In
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@push('scripts')
<script>
$(document).ready(function () {
    var ajaxUrl = '{{ route("api.product-stock", ":id") }}';
 
    $('#product_id').on('change', function () {
        var productId = $(this).val();
 
        if (!productId) {
            $('#stockInfoPanel').addClass('d-none');
            return;
        }
 
        $('#stockLoading').removeClass('d-none');
        $('#stockInfoPanel').addClass('d-none');
 
        $.ajax({
            url: ajaxUrl.replace(':id', productId),
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (data) {
                $('#ajaxProductName').text(data.name);
                $('#ajaxSku').text(data.sku);
                $('#ajaxQty').text(data.quantity_on_hand);
                $('#ajaxUnit').text(data.unit);
 
                if (data.is_low_stock) {
                    $('#ajaxLowBadge').removeClass('d-none');
                    $('#stockInfoPanel').removeClass('alert-info').addClass('alert-warning');
                } else {
                    $('#ajaxLowBadge').addClass('d-none');
                    $('#stockInfoPanel').removeClass('alert-warning').addClass('alert-info');
                }
 
                $('#stockLoading').addClass('d-none');
                $('#stockInfoPanel').removeClass('d-none');
            },
            error: function () {
                $('#stockLoading').addClass('d-none');
            }
        });
    });
});
</script>
@endpush