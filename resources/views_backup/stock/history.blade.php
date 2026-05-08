@extends('layouts.base')

@section('title', 'Stock History')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-clock-history me-2"></i>Stock Transaction History</h1>
    <p>View and filter all stock movements</p>
</div>

{{-- Bootstrap 5 Filter Card --}}
<div class="card mb-4">
    <div class="card-header"><i class="bi bi-funnel me-2"></i>Filter Transactions</div>
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" id="historySearch" class="form-control"
                           placeholder="Search product, SKU, supplier…">
                </div>
            </div>
            <div class="col-md-2">
                <select id="typeFilter" class="form-select">
                    <option value="">All Types</option>
                    <option value="in">Stock In</option>
                    <option value="out">Stock Out</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted">From Date</label>
                <input type="date" id="fromDate" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted">To Date</label>
                <input type="date" id="toDate" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="button" id="clearFilters" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x-circle me-1"></i>Clear
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>Transactions</span>
        <span class="badge bg-light text-dark rounded-pill py-2 px-3" id="historyCount">
            {{ $transactions->count() }} records
        </span>
    </div>
    <div class="card-body p-0">
        @if($transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0" id="historyTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th class="text-center">Type</th>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th class="text-center">Quantity</th>
                            <th>Recorded By</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr data-type="{{ $transaction->type }}"
                                data-date="{{ $transaction->transaction_date->format('Y-m-d') }}">
                                <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
                                <td class="text-center">
                                    @if($transaction->type === 'in')
                                        <span class="badge bg-success rounded-pill">
                                            <i class="bi bi-plus-circle me-1"></i>Stock In
                                        </span>
                                    @else
                                        <span class="badge bg-danger rounded-pill">
                                            <i class="bi bi-dash-circle me-1"></i>Stock Out
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $transaction->product->name }}</strong><br>
                                    <small class="text-muted font-monospace">{{ $transaction->product->sku }}</small>
                                </td>
                                <td>{{ $transaction->supplier->name ?? '—' }}</td>
                                <td class="text-center">
                                    <span class="fw-semibold">{{ $transaction->quantity }}</span>
                                    <small class="text-muted">{{ $transaction->product->unit }}</small>
                                </td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>
                                    @if($transaction->remarks)
                                        <span data-bs-toggle="tooltip" title="{{ $transaction->remarks }}">
                                            {{ Str::limit($transaction->remarks, 30) }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center py-3">
                {{ $transactions->links() }}
            </div>
        @else
            <div class="text-center py-5 text-muted">
                <i class="bi bi-clock-history display-4 d-block mb-3"></i>
                <p>No stock transactions found.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
        bootstrap.Tooltip.getOrCreateInstance(el);
    });

    function filterHistory() {
        var q    = $('#historySearch').val().toLowerCase();
        var type = $('#typeFilter').val();
        var from = $('#fromDate').val();
        var to   = $('#toDate').val();
        var count = 0;

        $('#historyTable tbody tr').each(function () {
            var rowType = $(this).data('type');
            var rowDate = $(this).data('date');
            var matchText = !q || $(this).text().toLowerCase().includes(q);
            var matchType = !type || rowType === type;
            var matchFrom = !from || rowDate >= from;
            var matchTo   = !to   || rowDate <= to;

            var show = matchText && matchType && matchFrom && matchTo;
            $(this).toggle(show);
            if (show) count++;
        });
        $('#historyCount').text(count + ' records');
    }

    $('#historySearch').on('keyup input', filterHistory);
    $('#typeFilter, #fromDate, #toDate').on('change input', filterHistory);

    $('#clearFilters').on('click', function () {
        $('#historySearch').val('');
        $('#typeFilter').val('');
        $('#fromDate').val('');
        $('#toDate').val('');
        filterHistory();
    });
});
</script>
@endpush
