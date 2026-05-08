<nav class="sidebar-nav">
    <div class="nav-section">Main Menu</div>
    <a href="<?php echo e(route('dashboard')); ?>"
       class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
 
    <a class="nav-link d-flex justify-content-between align-items-center"
       data-bs-toggle="collapse" href="#inventoryMenu" role="button"
       aria-expanded="<?php echo e(request()->routeIs('stock-in','stock-out','stock.history') ? 'true' : 'false'); ?>">
        <span><i class="bi bi-boxes"></i> Inventory</span>
        <i class="bi bi-chevron-down small"></i>
    </a>
    <div class="collapse <?php echo e(request()->routeIs('stock-in','stock-out','stock.history') ? 'show' : ''); ?>" id="inventoryMenu">
        <a href="<?php echo e(route('stock-in')); ?>" class="nav-link ps-4 <?php echo e(request()->routeIs('stock-in') ? 'active' : ''); ?>">
            <i class="bi bi-plus-circle"></i> Stock In
        </a>
        <a href="<?php echo e(route('stock-out')); ?>" class="nav-link ps-4 <?php echo e(request()->routeIs('stock-out') ? 'active' : ''); ?>">
            <i class="bi bi-dash-circle"></i> Stock Out
        </a>
        <a href="<?php echo e(route('stock.history')); ?>" class="nav-link ps-4 <?php echo e(request()->routeIs('stock.history') ? 'active' : ''); ?>">
            <i class="bi bi-clock-history"></i> Stock History
        </a>
    </div>
 
    <a class="nav-link d-flex justify-content-between align-items-center mt-1"
       data-bs-toggle="collapse" href="#reportsMenu" role="button"
       aria-expanded="<?php echo e(request()->routeIs('reports.*') ? 'true' : 'false'); ?>">
        <span><i class="bi bi-bar-chart"></i> Reports</span>
        <i class="bi bi-chevron-down small"></i>
    </a>
    <div class="collapse <?php echo e(request()->routeIs('reports.*') ? 'show' : ''); ?>" id="reportsMenu">
        <a href="<?php echo e(route('reports.current-stock')); ?>" class="nav-link ps-4 <?php echo e(request()->routeIs('reports.current-stock') ? 'active' : ''); ?>">
            <i class="bi bi-file-earmark-bar-graph"></i> Current Stock
        </a>
        <a href="<?php echo e(route('reports.stock-movement')); ?>" class="nav-link ps-4 <?php echo e(request()->routeIs('reports.stock-movement') ? 'active' : ''); ?>">
            <i class="bi bi-arrow-left-right"></i> Stock Movement
        </a>
        <a href="<?php echo e(route('reports.stock-summary')); ?>" class="nav-link ps-4 <?php echo e(request()->routeIs('reports.stock-summary') ? 'active' : ''); ?>">
            <i class="bi bi-graph-up"></i> Stock Summary
        </a>
    </div>
 
    <?php if(Auth::user()->isAdmin()): ?>
    <a class="nav-link d-flex justify-content-between align-items-center mt-1"
       data-bs-toggle="collapse" href="#adminMenu" role="button"
       aria-expanded="<?php echo e(request()->routeIs('products.*','suppliers.*','users.*') ? 'true' : 'false'); ?>">
        <span><i class="bi bi-gear"></i> Administration</span>
        <i class="bi bi-chevron-down small"></i>
    </a>
    <div class="collapse <?php echo e(request()->routeIs('products.*','suppliers.*','users.*') ? 'show' : ''); ?>" id="adminMenu">
        <a href="<?php echo e(route('products.index')); ?>" class="nav-link ps-4 <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>">
            <i class="bi bi-box-seam"></i> Products
        </a>
        <a href="<?php echo e(route('suppliers.index')); ?>" class="nav-link ps-4 <?php echo e(request()->routeIs('suppliers.*') ? 'active' : ''); ?>">
            <i class="bi bi-shop"></i> Suppliers
        </a>
        <a href="<?php echo e(route('users.index')); ?>" class="nav-link ps-4 <?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>">
            <i class="bi bi-people"></i> Users
        </a>
    </div>
    <?php endif; ?>
</nav><?php /**PATH D:\backend\resources\views/layouts/_sidebar_nav.blade.php ENDPATH**/ ?>