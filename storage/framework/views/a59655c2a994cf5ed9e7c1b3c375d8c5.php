<?php $__env->startSection('title', 'User Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1><i class="bi bi-people me-2"></i>User Management</h1>
            <p>Manage system users and their roles</p>
        </div>
        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-light fw-semibold">
            <i class="bi bi-person-plus me-1"></i>Add New User
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
                    <input type="text" id="userSearch"
                           class="form-control border-start-0 ps-0"
                           placeholder="Search by name or email…">
                </div>
            </div>
            <div class="col-md-3">
                <select id="roleFilter" class="form-select">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div class="col-md-4 text-end">
                <small class="text-white opacity-75">
                    Total: <strong><?php echo e($users->total()); ?></strong> users
                </small>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0" id="usersTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Role</th>
                        <th>Registered</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr data-role="<?php echo e($user->role); ?>">
                            <td class="text-muted small"><?php echo e($user->id); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0"
                                         style="width:38px;height:38px;font-size:15px;background:<?php echo e($user->isAdmin() ? '#3498db' : '#27ae60'); ?>;">
                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <strong><?php echo e($user->name); ?></strong>
                                        <?php if($user->id === auth()->id()): ?>
                                            <span class="badge bg-warning text-dark ms-1" style="font-size:10px;">You</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo e($user->email); ?></td>
                            <td class="text-center">
                                <?php if($user->isAdmin()): ?>
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="bi bi-shield-check me-1"></i>Admin
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success rounded-pill">
                                        <i class="bi bi-person me-1"></i>Staff
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($user->created_at->format('M d, Y')); ?></td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="<?php echo e(route('users.edit', $user)); ?>"
                                       class="btn btn-warning btn-sm"
                                       data-bs-toggle="tooltip" title="Edit User">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                    <?php if($user->id !== auth()->id()): ?>
                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                data-delete-url="<?php echo e(route('users.destroy', $user)); ?>"
                                                data-delete-name="<?php echo e($user->name); ?>"
                                                data-bs-toggle="tooltip" title="Delete User">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-sm" disabled
                                                data-bs-toggle="tooltip" title="Cannot delete your own account">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-people display-4 d-block mb-2"></i>No users found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center px-3 py-3">
            <small class="text-muted">
                Showing <?php echo e($users->firstItem()); ?>–<?php echo e($users->lastItem()); ?> of <?php echo e($users->total()); ?> users
            </small>
            <?php echo e($users->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(function () {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
        bootstrap.Tooltip.getOrCreateInstance(el);
    });

    function filterUsers() {
        var q    = $('#userSearch').val().toLowerCase();
        var role = $('#roleFilter').val();
        $('#usersTable tbody tr').each(function () {
            var match = (!q || $(this).text().toLowerCase().includes(q))
                     && (!role || $(this).data('role') === role);
            $(this).toggle(match);
        });
    }
    $('#userSearch').on('keyup input', filterUsers);
    $('#roleFilter').on('change', filterUsers);
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\resources\views/users/index.blade.php ENDPATH**/ ?>