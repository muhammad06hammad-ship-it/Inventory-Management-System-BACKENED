@extends('layouts.base')

@section('title', 'Home')

@section('content')
<div style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%); color: white; padding: 80px 20px; text-align: center; border-radius: 8px; margin-bottom: 50px;">
    <h1 style="font-size: 3rem; margin-bottom: 20px;">
        <i class="bi bi-box2-heart" style="font-size: 4rem;"></i>
    </h1>
    <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Inventory Management System</h2>
    <p style="font-size: 1.2rem; margin-bottom: 30px;">Efficiently manage your products, suppliers, and stock movements</p>
    
    @auth
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg" style="margin: 0 10px;">
            <i class="bi bi-house"></i> Go to Dashboard
        </a>
    @else
        <a href="{{ route('login') }}" class="btn btn-light btn-lg" style="margin: 0 10px;">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </a>
    @endauth
</div>

@auth
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-plus-circle" style="font-size: 3rem; color: var(--success-color);"></i>
                    <h5 class="card-title mt-3">Record Stock In</h5>
                    <p class="card-text">Register incoming inventory from suppliers</p>
                    <a href="{{ route('stock-in') }}" class="btn btn-success">Record Now</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-dash-circle" style="font-size: 3rem; color: var(--danger-color);"></i>
                    <h5 class="card-title mt-3">Record Stock Out</h5>
                    <p class="card-text">Track sales and stock usage</p>
                    <a href="{{ route('stock-out') }}" class="btn btn-danger">Record Now</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="bi bi-file-earmark-bar-graph" style="font-size: 3rem; color: var(--secondary-color);"></i>
                    <h5 class="card-title mt-3">View Reports</h5>
                    <p class="card-text">Analyze inventory levels and movements</p>
                    <a href="{{ route('reports.current-stock') }}" class="btn btn-primary">View Reports</a>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->isAdmin())
        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-box-seam" style="font-size: 3rem; color: var(--warning-color);"></i>
                        <h5 class="card-title mt-3">Manage Products</h5>
                        <p class="card-text">Add, edit, and manage product catalog</p>
                        <a href="{{ route('products.index') }}" class="btn btn-warning">Manage Products</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-shop" style="font-size: 3rem; color: #16a085;"></i>
                        <h5 class="card-title mt-3">Manage Suppliers</h5>
                        <p class="card-text">Maintain supplier information and contacts</p>
                        <a href="{{ route('suppliers.index') }}" class="btn" style="background-color: #16a085; color: white;">Manage Suppliers</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@else
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Features</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Product Management</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Supplier Management</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Stock In/Out Tracking</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Real-time Stock Levels</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Comprehensive Reports</li>
                        <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Low Stock Alerts</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Demo Credentials</h5>
                </div>
                <div class="card-body">
                    <p><strong>Admin Account:</strong></p>
                    <p class="text-muted">Email: admin@inventory.com<br>Password: admin123</p>
                    
                    <hr>
                    
                    <p><strong>Staff Account:</strong></p>
                    <p class="text-muted">Email: staff@inventory.com<br>Password: staff123</p>

                    <a href="{{ route('login') }}" class="btn btn-primary w-100 mt-3">
                        <i class="bi bi-box-arrow-in-right"></i> Login Now
                    </a>
                </div>
            </div>
        </div>
    </div>
@endauth
@endsection
