<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-box-seam me-2"></i>Products</h1>
            <p>Manage your product inventory</p>
        </div>
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-light fw-semibold">
            <i class="bi bi-plus-circle me-1"></i>Add New Product
        </a>
    </div>
</div>

<div class="card">
    
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
                    Showing <span id="visibleCount"><?php echo e($products->count()); ?></span> items
                </span>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <?php if($products->count() > 0): ?>
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
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-status="<?php echo e($product->status); ?>"
                                data-stock="<?php echo e($product->isLowStock() ? 'low' : 'ok'); ?>">
                                <td>
                                    <span class="badge bg-secondary rounded-pill fw-normal font-monospace">
                                        <?php echo e($product->sku); ?>

                                    </span>
                                </td>
                                <td>
                                    <strong><?php echo e($product->name); ?></strong>
                                    <?php if($product->description): ?>
                                        <br><small class="text-muted"><?php echo e(Str::limit($product->description, 45)); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark"><?php echo e($product->category->name); ?></span>
                                </td>
                                <td><?php echo e($product->unit); ?></td>
                                <td class="text-center">
                                    <?php if($product->isLowStock()): ?>
                                        <span class="badge bg-danger rounded-pill">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i><?php echo e($product->quantity_on_hand); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i><?php echo e($product->quantity_on_hand); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?php echo e($product->minimum_stock); ?></td>
                                <td class="text-center">
                                    <?php if($product->status === 'active'): ?>
                                        <span class="badge bg-success rounded-pill">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary rounded-pill">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        
                                        <a href="<?php echo e(route('products.edit', $product)); ?>"
                                           class="btn btn-warning btn-sm"
                                           data-bs-toggle="tooltip" title="Edit Product">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-delete-url="<?php echo e(route('products.destroy', $product)); ?>"
                                                data-delete-name="<?php echo e($product->name); ?>"
                                                data-bs-toggle="tooltip" title="Delete Product">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center py-3">
                <?php echo e($products->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-box-seam display-4 d-block mb-3"></i>
                <p>No products found. <a href="<?php echo e(route('products.create')); ?>">Create one now.</a></p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\resources\views/products/index.blade.php ENDPATH**/ ?>