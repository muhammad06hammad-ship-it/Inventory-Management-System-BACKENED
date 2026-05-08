

<?php $__env->startSection('title', 'Stock Movement Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-arrow-left-right"></i> Stock Movement Report</h1>
    <p>Track stock movements for specific products or date ranges</p>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="<?php echo e(route('reports.stock-movement')); ?>" method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="product_id" class="form-label">Product</label>
                <select class="form-select" id="product_id" name="product_id">
                    <option value="">-- All Products --</option>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product->id); ?>" <?php echo e(request('product_id') == $product->id ? 'selected' : ''); ?>>
                            <?php echo e($product->name); ?> (<?php echo e($product->sku); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo e(request('from_date')); ?>">
            </div>

            <div class="col-md-3">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo e(request('to_date')); ?>">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <span>Movements</span>
            <button class="btn btn-sm btn-primary" onclick="window.print()">
                <i class="bi bi-printer"></i> Print Report
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php if($transactions->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Supplier</th>
                            <th>Recorded By</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($transaction->transaction_date->format('M d, Y')); ?></td>
                                <td>
                                    <strong><?php echo e($transaction->product->name); ?></strong><br>
                                    <small class="text-muted"><?php echo e($transaction->product->sku); ?></small>
                                </td>
                                <td>
                                    <?php if($transaction->type === 'in'): ?>
                                        <span class="badge" class="bg-success">
                                            <i class="bi bi-plus-circle"></i> In
                                        </span>
                                    <?php else: ?>
                                        <span class="badge" class="bg-danger">
                                            <i class="bi bi-dash-circle"></i> Out
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($transaction->quantity); ?> <?php echo e($transaction->product->unit); ?></td>
                                <td><?php echo e($transaction->supplier->name ?? '-'); ?></td>
                                <td><?php echo e($transaction->user->name); ?></td>
                                <td><?php echo e($transaction->remarks ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <?php echo e($transactions->links()); ?>

            </div>
        <?php else: ?>
            <p class="text-muted text-center py-5">No transactions found for the selected filters.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\resources\views/reports/stock-movement.blade.php ENDPATH**/ ?>