

<?php $__env->startSection('title', 'Stock Summary Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-graph-up"></i> Stock Summary Report</h1>
    <p>Total stock in and stock out per product for a selected period</p>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="<?php echo e(route('reports.stock-summary')); ?>" method="GET" class="row g-3">
            <div class="col-md-5">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" class="form-control" id="from_date" name="from_date" 
                       value="<?php echo e(request('from_date', now()->subMonths(1)->toDateString())); ?>">
            </div>

            <div class="col-md-5">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" class="form-control" id="to_date" name="to_date" 
                       value="<?php echo e(request('to_date', now()->toDateString())); ?>">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Generate
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <span>Summary: <?php echo e(isset($fromDate) ? $fromDate->format('M d, Y') : now()->subMonths(1)->format('M d, Y')); ?> to <?php echo e(isset($toDate) ? $toDate->format('M d, Y') : now()->format('M d, Y')); ?></span>
            <button class="btn btn-sm btn-primary" onclick="window.print()">
                <i class="bi bi-printer"></i> Print Report
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php if(count($summary) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Stock In</th>
                            <th>Stock Out</th>
                            <th>Net Movement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalIn = 0;
                            $totalOut = 0;
                            $totalNet = 0;
                        ?>
                        <?php $__currentLoopData = $summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $totalIn += $item['stock_in'];
                                $totalOut += $item['stock_out'];
                                $totalNet += $item['net_movement'];
                            ?>
                            <tr>
                                <td><strong><?php echo e($item['product']->sku); ?></strong></td>
                                <td><?php echo e($item['product']->name); ?></td>
                                <td><?php echo e($item['product']->category->name); ?></td>
                                <td>
                                    <span class="badge" class="bg-success">
                                        <?php echo e($item['stock_in']); ?> <?php echo e($item['product']->unit); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge" class="bg-danger">
                                        <?php echo e($item['stock_out']); ?> <?php echo e($item['product']->unit); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php if($item['net_movement'] > 0): ?>
                                        <span class="badge badge-in-stock">+<?php echo e($item['net_movement']); ?></span>
                                    <?php elseif($item['net_movement'] < 0): ?>
                                        <span class="badge badge-low-stock"><?php echo e($item['net_movement']); ?></span>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: #95a5a6;">0</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #f8f9fa; font-weight: bold;">
                            <td colspan="3">TOTAL</td>
                            <td><span class="badge" class="bg-success"><?php echo e($totalIn); ?></span></td>
                            <td><span class="badge" class="bg-danger"><?php echo e($totalOut); ?></span></td>
                            <td>
                                <?php if($totalNet > 0): ?>
                                    <span class="badge badge-in-stock">+<?php echo e($totalNet); ?></span>
                                <?php elseif($totalNet < 0): ?>
                                    <span class="badge badge-low-stock"><?php echo e($totalNet); ?></span>
                                <?php else: ?>
                                    <span class="badge" style="background-color: #95a5a6;">0</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted text-center py-5">No data available for the selected period.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\resources\views/reports/stock-summary.blade.php ENDPATH**/ ?>