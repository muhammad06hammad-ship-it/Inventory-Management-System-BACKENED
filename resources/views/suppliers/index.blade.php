@extends('layouts.base')

@section('title', 'Suppliers')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-shop me-2"></i>Suppliers</h1>
            <p>Manage your product suppliers</p>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn btn-light fw-semibold">
            <i class="bi bi-plus-circle me-1"></i>Add New Supplier
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" id="supplierSearch"
                           class="form-control border-start-0 ps-0"
                           placeholder="Search by name, contact, email or phone…">
                </div>
            </div>
            <div class="col-md-3">
                <select id="supplierStatusFilter" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-3 text-end">
                <span class="badge bg-secondary rounded-pill py-2 px-3">
                    <span id="supplierCount">{{ $suppliers->count() }}</span> suppliers
                </span>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        @if($suppliers->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0" id="suppliersTable">
                    <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                            <tr data-status="{{ $supplier->status }}">
                                <td><strong>{{ $supplier->name }}</strong></td>
                                <td>{{ $supplier->contact_person ?? '—' }}</td>
                                <td>
                                    @if($supplier->email)
                                        <a href="mailto:{{ $supplier->email }}" class="text-decoration-none">
                                            {{ $supplier->email }}
                                        </a>
                                    @else —
                                    @endif
                                </td>
                                <td>{{ $supplier->phone ?? '—' }}</td>
                                <td>
                                    <span data-bs-toggle="tooltip" title="{{ $supplier->address }}">
                                        {{ Str::limit($supplier->address ?? '—', 40) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($supplier->status === 'active')
                                        <span class="badge bg-success rounded-pill">Active</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('suppliers.edit', $supplier) }}"
                                           class="btn btn-warning btn-sm"
                                           data-bs-toggle="tooltip" title="Edit Supplier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-delete-url="{{ route('suppliers.destroy', $supplier) }}"
                                                data-delete-name="{{ $supplier->name }}"
                                                data-bs-toggle="tooltip" title="Delete Supplier">
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
                {{ $suppliers->links() }}
            </div>
        @else
            <div class="text-center py-5 text-muted">
                <i class="bi bi-shop display-4 d-block mb-3"></i>
                <p>No suppliers found. <a href="{{ route('suppliers.create') }}">Create one now.</a></p>
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

    function filterSuppliers() {
        var q      = $('#supplierSearch').val().toLowerCase();
        var status = $('#supplierStatusFilter').val();
        var count  = 0;

        $('#suppliersTable tbody tr').each(function () {
            var match = (!q || $(this).text().toLowerCase().includes(q))
                     && (!status || $(this).data('status') === status);
            $(this).toggle(match);
            if (match) count++;
        });
        $('#supplierCount').text(count);
    }

    $('#supplierSearch').on('keyup input', filterSuppliers);
    $('#supplierStatusFilter').on('change', filterSuppliers);
});
</script>
@endpush
