@extends('layouts.base')

@section('title', 'Create Product')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle"></i> Add New Product</h1>
    <p>Create a new product in the inventory system</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card"><div class="card-body p-4">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sku" class="form-label">Product SKU/Code *</label>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                               id="sku" name="sku" value="{{ old('sku') }}" required>
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Category *</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="unit" class="form-label">Unit (e.g., pcs, box, kg) *</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                               id="unit" name="unit" value="{{ old('unit') }}" placeholder="e.g., pcs, box, kg" required>
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="minimum_stock" class="form-label">Minimum Stock Level *</label>
                        <input type="number" class="form-control @error('minimum_stock') is-invalid @enderror" 
                               id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', 10) }}" 
                               min="0" required>
                        @error('minimum_stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Create Product
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
