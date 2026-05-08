<nav class="sidebar-nav">
    <div class="nav-section">Main Menu</div>
    <a href="{{ route('dashboard') }}"
       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
 
    <a class="nav-link d-flex justify-content-between align-items-center"
       data-bs-toggle="collapse" href="#inventoryMenu" role="button"
       aria-expanded="{{ request()->routeIs('stock-in','stock-out','stock.history') ? 'true' : 'false' }}">
        <span><i class="bi bi-boxes"></i> Inventory</span>
        <i class="bi bi-chevron-down small"></i>
    </a>
    <div class="collapse {{ request()->routeIs('stock-in','stock-out','stock.history') ? 'show' : '' }}" id="inventoryMenu">
        <a href="{{ route('stock-in') }}" class="nav-link ps-4 {{ request()->routeIs('stock-in') ? 'active' : '' }}">
            <i class="bi bi-plus-circle"></i> Stock In
        </a>
        <a href="{{ route('stock-out') }}" class="nav-link ps-4 {{ request()->routeIs('stock-out') ? 'active' : '' }}">
            <i class="bi bi-dash-circle"></i> Stock Out
        </a>
        <a href="{{ route('stock.history') }}" class="nav-link ps-4 {{ request()->routeIs('stock.history') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Stock History
        </a>
    </div>
 
    <a class="nav-link d-flex justify-content-between align-items-center mt-1"
       data-bs-toggle="collapse" href="#reportsMenu" role="button"
       aria-expanded="{{ request()->routeIs('reports.*') ? 'true' : 'false' }}">
        <span><i class="bi bi-bar-chart"></i> Reports</span>
        <i class="bi bi-chevron-down small"></i>
    </a>
    <div class="collapse {{ request()->routeIs('reports.*') ? 'show' : '' }}" id="reportsMenu">
        <a href="{{ route('reports.current-stock') }}" class="nav-link ps-4 {{ request()->routeIs('reports.current-stock') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-bar-graph"></i> Current Stock
        </a>
        <a href="{{ route('reports.stock-movement') }}" class="nav-link ps-4 {{ request()->routeIs('reports.stock-movement') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-right"></i> Stock Movement
        </a>
        <a href="{{ route('reports.stock-summary') }}" class="nav-link ps-4 {{ request()->routeIs('reports.stock-summary') ? 'active' : '' }}">
            <i class="bi bi-graph-up"></i> Stock Summary
        </a>
    </div>
 
    @if(Auth::user()->isAdmin())
    <a class="nav-link d-flex justify-content-between align-items-center mt-1"
       data-bs-toggle="collapse" href="#adminMenu" role="button"
       aria-expanded="{{ request()->routeIs('products.*','suppliers.*','users.*') ? 'true' : 'false' }}">
        <span><i class="bi bi-gear"></i> Administration</span>
        <i class="bi bi-chevron-down small"></i>
    </a>
    <div class="collapse {{ request()->routeIs('products.*','suppliers.*','users.*') ? 'show' : '' }}" id="adminMenu">
        <a href="{{ route('products.index') }}" class="nav-link ps-4 {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>
        <a href="{{ route('suppliers.index') }}" class="nav-link ps-4 {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
            <i class="bi bi-shop"></i> Suppliers
        </a>
        <a href="{{ route('users.index') }}" class="nav-link ps-4 {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Users
        </a>
    </div>
    @endif
</nav>