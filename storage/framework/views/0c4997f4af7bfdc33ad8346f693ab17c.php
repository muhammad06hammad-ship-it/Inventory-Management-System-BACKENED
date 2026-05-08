<?php $__env->startSection('title', 'Suppliers'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-shop me-2"></i>Suppliers</h1>
            <p>Manage your product suppliers</p>
        </div>
        <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-light fw-semibold">
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
                    <span id="supplierCount"><?php echo e($suppliers->count()); ?></span> suppliers
                </span>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <?php if($suppliers->count() > 0): ?>
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
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-status="<?php echo e($supplier->status); ?>">
                                <td><strong><?php echo e($supplier->name); ?></strong></td>
                                <td><?php echo e($supplier->contact_person ?? '—'); ?></td>
                                <td>
                                    <?php if($supplier->email): ?>
                                        <a href="mailto:<?php echo e($supplier->email); ?>" class="text-decoration-none">
                                            <?php echo e($supplier->email); ?>

                                        </a>
                                    <?php else: ?> —
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($supplier->phone ?? '—'); ?></td>
                                <td>
                                    <span data-bs-toggle="tooltip" title="<?php echo e($supplier->address); ?>">
                                        <?php echo e(Str::limit($supplier->address ?? '—', 40)); ?>

                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if($supplier->status === 'active'): ?>
                                        <span class="badge bg-success rounded-pill">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary rounded-pill">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="<?php echo e(route('suppliers.edit', $supplier)); ?>"
                                           class="btn btn-warning btn-sm"
                                           data-bs-toggle="tooltip" title="Edit Supplier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-delete-url="<?php echo e(route('suppliers.destroy', $supplier)); ?>"
                                                data-delete-name="<?php echo e($supplier->name); ?>"
                                                data-bs-toggle="tooltip" title="Delete Supplier">
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
                <?php echo e($suppliers->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-shop display-4 d-block mb-3"></i>
                <p>No suppliers found. <a href="<?php echo e(route('suppliers.create')); ?>">Create one now.</a></p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\resources\views/suppliers/index.blade.php ENDPATH**/ ?>