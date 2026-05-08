<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>
    <p>Welcome back, <strong><?php echo e(Auth::user()->name); ?></strong>! Here's your inventory overview.</p>
</div>


<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card stat-card" style="border-left-color:#3498db;">
            <span class="stat-icon text-primary"><i class="bi bi-box-seam"></i></span>
            <div class="stat-number text-primary"><?php echo e($totalProducts); ?></div>
            <p class="stat-label">Total Products</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card stat-card" style="border-left-color:#e74c3c;">
            <span class="stat-icon text-danger"><i class="bi bi-exclamation-triangle-fill"></i></span>
            <div class="stat-number text-danger"><?php echo e($lowStockProducts); ?></div>
            <p class="stat-label">Low Stock Items</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card stat-card" style="border-left-color:#27ae60;">
            <span class="stat-icon text-success"><i class="bi bi-shop"></i></span>
            <div class="stat-number text-success"><?php echo e($totalSuppliers); ?></div>
            <p class="stat-label">Total Suppliers</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <?php if(Auth::user()->isAdmin()): ?>
        <a href="<?php echo e(route('users.index')); ?>" class="text-decoration-none">
        <?php endif; ?>
        <div class="card stat-card" style="border-left-color:#f39c12;">
            <span class="stat-icon text-warning"><i class="bi bi-people"></i></span>
            <div class="stat-number text-warning"><?php echo e($totalUsers); ?></div>
            <p class="stat-label">System Users</p>
        </div>
        <?php if(Auth::user()->isAdmin()): ?>
        </a>
        <?php endif; ?>
    </div>
</div>


<div class="row g-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-list-ul"></i> Recent Stock Transactions
            </div>
            <div class="card-body p-0">
                <?php if($recentTransactions->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Qty</th>
                                    <th>Date</th>
                                    <th>By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo e($t->product->name); ?></strong><br>
                                            <small class="text-muted font-monospace"><?php echo e($t->product->sku); ?></small>
                                        </td>
                                        <td class="text-center">
                                            <?php if($t->type === 'in'): ?>
                                                <span class="badge bg-success rounded-pill">
                                                    <i class="bi bi-plus-circle me-1"></i>In
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-danger rounded-pill">
                                                    <i class="bi bi-dash-circle me-1"></i>Out
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><strong><?php echo e($t->quantity); ?></strong></td>
                                        <td><?php echo e($t->transaction_date->format('M d, Y')); ?></td>
                                        <td><?php echo e($t->user->name); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center py-3">
                        <a href="<?php echo e(route('stock.history')); ?>" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-clock-history me-1"></i>View All History
                        </a>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox display-5 d-block mb-2"></i>No transactions yet.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4 d-flex flex-column gap-4">
        
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill text-warning"></i> Low Stock Alerts
            </div>
            <div class="card-body p-0">
                <?php $lowStockItems = $products->filter(fn($p) => $p->isLowStock())->take(8); ?>
                <?php if($lowStockItems->count() > 0): ?>
                    <ul class="list-group list-group-flush">
                        <?php $__currentLoopData = $lowStockItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <strong><?php echo e($p->name); ?></strong><br>
                                    <small class="text-muted font-monospace"><?php echo e($p->sku); ?></small>
                                </div>
                                
                                <span class="badge bg-danger rounded-pill">
                                    <?php echo e($p->quantity_on_hand); ?>/<?php echo e($p->minimum_stock); ?>

                                </span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <div class="text-center py-4 text-success">
                        <i class="bi bi-check-circle-fill display-5 d-block mb-2"></i>
                        All items are well stocked!
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header"><i class="bi bi-lightning-charge me-2"></i>Quick Actions</div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('stock-in')); ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Record Stock In
                    </a>
                    <a href="<?php echo e(route('stock-out')); ?>" class="btn btn-danger">
                        <i class="bi bi-dash-circle me-2"></i>Record Stock Out
                    </a>
                    <a href="<?php echo e(route('reports.current-stock')); ?>" class="btn btn-outline-primary">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i>View Stock Report
                    </a>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-plus me-2"></i>Add New Product
                        </a>
                        <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-plus me-2"></i>Add Supplier
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\resources\views/dashboard.blade.php ENDPATH**/ ?>