<nav class="sidebar-nav">
    <div class="nav-section">Main Menu</div>
    <a href="{{ route('dashboard') }}"
       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <div class="nav-section mt-2">Inventory</div>
    <a href="{{ route('stock-in') }}"
       class="nav-link {{ request()->routeIs('stock-in') ? 'active' : '' }}">
        <i class="bi bi-plus-circle"></i> Stock In
    </a>
    <a href="{{ route('stock-out') }}"
       class="nav-link {{ request()->routeIs('stock-out') ? 'active' : '' }}">
        <i class="bi bi-dash-circle"></i> Stock Out
    </a>
    <a href="{{ route('stock.history') }}"
       class="nav-link {{ request()->routeIs('stock.history') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i> Stock History
    </a>

    <div class="nav-section mt-2">Reports</div>
    <a href="{{ route('reports.current-stock') }}"
       class="nav-link {{ request()->routeIs('reports.current-stock') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-bar-graph"></i> Current Stock
    </a>
    <a href="{{ route('reports.stock-movement') }}"
       class="nav-link {{ request()->routeIs('reports.stock-movement') ? 'active' : '' }}">
        <i class="bi bi-arrow-left-right"></i> Stock Movement
    </a>
    <a href="{{ route('reports.stock-summary') }}"
       class="nav-link {{ request()->routeIs('reports.stock-summary') ? 'active' : '' }}">
        <i class="bi bi-graph-up"></i> Stock Summary
    </a>

    @if(Auth::user()->isAdmin())
    <div class="nav-section mt-2">Administration</div>
    <a href="{{ route('products.index') }}"
       class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
        <i class="bi bi-box-seam"></i> Products
    </a>
    <a href="{{ route('suppliers.index') }}"
       class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
        <i class="bi bi-shop"></i> Suppliers
    </a>
    <a href="{{ route('users.index') }}"
       class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Users
    </a>
    @endif
</nav>
