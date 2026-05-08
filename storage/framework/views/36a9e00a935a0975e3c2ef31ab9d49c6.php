<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - Inventory Management System</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --clr-primary: #2c3e50;
            --clr-accent:  #3498db;
            --clr-success: #27ae60;
            --clr-danger:  #e74c3c;
            --clr-warning: #f39c12;
            --sidebar-w: 260px;
        }

        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }

        /* ── TOP NAVBAR ── */
        .top-navbar {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,.3);
            z-index: 1040;
        }
        .top-navbar .navbar-brand { font-weight: 700; font-size: 1.2rem; color:#fff !important; }
        .top-navbar .nav-link { color: rgba(255,255,255,.85) !important; }
        .top-navbar .nav-link:hover { color:#fff !important; }
        .top-navbar .dropdown-menu { border:none; box-shadow:0 4px 20px rgba(0,0,0,.15); border-radius:10px; }

        /* ── SIDEBAR (desktop) ── */
        .sidebar-desktop {
            width: var(--sidebar-w);
            min-width: var(--sidebar-w);
            background-color: var(--clr-primary);
            min-height: calc(100vh - 56px);
            padding: 18px 0 30px;
            flex-shrink: 0;
        }
        /* ── SIDEBAR (mobile offcanvas) ── */
        .offcanvas-sidebar { width: var(--sidebar-w) !important; background-color: var(--clr-primary) !important; }
        .offcanvas-sidebar .offcanvas-header { background:rgba(0,0,0,.2); border-bottom:1px solid rgba(255,255,255,.1); }
        .offcanvas-sidebar .offcanvas-title  { color:#fff; font-weight:700; }
        .offcanvas-sidebar .btn-close { filter:invert(1) grayscale(100%) brightness(200%); }

        /* ── SIDEBAR NAV LINKS (shared) ── */
        .sidebar-nav .nav-section {
            font-size:.68rem; font-weight:700; letter-spacing:.1em;
            text-transform:uppercase; color:#95a5a6;
            padding:16px 20px 4px;
        }
        .sidebar-nav .nav-link {
            color:#ecf0f1;
            padding:10px 20px;
            border-radius:7px;
            margin:2px 10px;
            font-size:.9rem;
            display:flex; align-items:center; gap:10px;
            transition: background .2s, color .2s;
        }
        .sidebar-nav .nav-link i { font-size:1rem; width:20px; text-align:center; }
        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active { background-color: var(--clr-accent); color:#fff; }

        /* ── MAIN CONTENT ── */
        .main-content { flex:1; min-width:0; padding:26px; }

        /* ── PAGE HEADER ── */
        .page-header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color:#fff; padding:22px 26px; border-radius:10px;
            margin-bottom:22px; box-shadow:0 4px 14px rgba(0,0,0,.14);
        }
        .page-header h1 { font-size:1.7rem; font-weight:600; margin:0; }
        .page-header p  { margin:5px 0 0; opacity:.88; font-size:.93rem; }

        /* ── CARDS ── */
        .card { border:none; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,.08); transition:box-shadow .2s; }
        .card:hover { box-shadow:0 4px 18px rgba(0,0,0,.13); }
        .card-header { background-color: var(--clr-primary); color:#fff; border-radius:10px 10px 0 0 !important; padding:14px 20px; font-weight:600; }

        /* ── STAT CARDS ── */
        .stat-card { text-align:center; padding:26px 16px; border-left:5px solid var(--clr-accent); }
        .stat-card .stat-icon   { font-size:2.3rem; }
        .stat-card .stat-number { font-size:1.9rem; font-weight:700; color: var(--clr-primary); margin:8px 0 4px; }
        .stat-card .stat-label  { font-size:.83rem; color:#7f8c8d; margin:0; }

        /* ── TABLES ── */
        .table thead th { background-color:#ecf0f1; color: var(--clr-primary); font-weight:600; border-bottom:2px solid #dee2e6; padding:12px 14px; white-space:nowrap; }
        .table tbody td { padding:11px 14px; vertical-align:middle; }
        .table-hover tbody tr:hover { background-color:#f8f9fa; }

        /* ── FORMS ── */
        .form-section { background:#fff; padding:26px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,.08); }
        .form-control, .form-select { border-radius:8px; border:1.5px solid #dee2e6; }
        .form-control:focus, .form-select:focus { border-color: var(--clr-accent); box-shadow:0 0 0 .2rem rgba(52,152,219,.2); }
        .form-label { font-weight:500; color: var(--clr-primary); font-size:.9rem; }

        /* ── BUTTONS ── */
        .btn { border-radius:7px; font-weight:500; }
        .btn-primary  { background: var(--clr-accent);   border-color: var(--clr-accent); }
        .btn-primary:hover  { background:#2980b9; border-color:#2980b9; }
        .btn-success  { background: var(--clr-success); border-color: var(--clr-success); }
        .btn-success:hover  { background:#229954; border-color:#229954; }
        .btn-warning  { background: var(--clr-warning); border-color: var(--clr-warning); color:#fff; }
        .btn-warning:hover  { background:#e67e22; border-color:#e67e22; color:#fff; }
        .btn-danger   { background: var(--clr-danger);  border-color: var(--clr-danger); }
        .btn-danger:hover   { background:#c0392b; border-color:#c0392b; }

        /* ── ALERTS ── */
        .alert { border:none; border-radius:8px; }

        /* ── BADGES (semantic helpers) ── */
        .badge-active   { background-color: var(--clr-success) !important; color:#fff !important; }
        .badge-inactive { background-color:#95a5a6 !important; color:#fff !important; }
        .badge-low-stock{ background-color: var(--clr-danger)  !important; color:#fff !important; }
        .badge-in-stock { background-color: var(--clr-success) !important; color:#fff !important; }

        /* ── TOAST ── */
        .toast-container { z-index:1090; }

        /* ── PAGINATION ── */
        .pagination .page-link { border-radius:6px; margin:0 2px; color: var(--clr-accent); }
        .pagination .page-item.active .page-link { background: var(--clr-accent); border-color: var(--clr-accent); }

        /* ── FOOTER ── */
        .app-footer { background: var(--clr-primary); color:rgba(255,255,255,.7); text-align:center; padding:15px; font-size:.85rem; }

        /* ── RESPONSIVE ── */
        @media (max-width:991.98px) { .sidebar-desktop { display:none !important; } .main-content { padding:16px; } }
        @media (min-width:992px)    { .btn-sidebar-toggle { display:none !important; } }
    </style>

    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>


<nav class="navbar top-navbar navbar-expand-lg sticky-top">
    <div class="container-fluid">

        
        <button class="btn btn-outline-light btn-sm me-2 btn-sidebar-toggle"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar"
                aria-controls="mobileSidebar">
            <i class="bi bi-list fs-5"></i>
        </button>

        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
            <i class="bi bi-box2-heart me-2"></i>Inventory MS
        </a>

        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#topNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="topNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <?php if(auth()->guard()->check()): ?>
                    
                    <li class="nav-item">
                        <span class="badge <?php echo e(Auth::user()->isAdmin() ? 'bg-warning text-dark' : 'bg-success'); ?> rounded-pill py-2 px-3">
                            <i class="bi bi-<?php echo e(Auth::user()->isAdmin() ? 'shield-check' : 'person-check'); ?> me-1"></i>
                            <?php echo e(ucfirst(Auth::user()->role)); ?>

                        </span>
                    </li>

                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                           href="#" role="button" data-bs-toggle="dropdown">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary text-white"
                                  style="width:32px;height:32px;font-size:.85rem;font-weight:700;flex-shrink:0;">
                                <?php echo e(strtoupper(substr(Auth::user()->name,0,1))); ?>

                            </span>
                            <span class="d-none d-md-inline"><?php echo e(Auth::user()->name); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><h6 class="dropdown-header"><?php echo e(Auth::user()->email); ?></h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button class="dropdown-item text-danger" type="submit">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('register')); ?>"><i class="bi bi-person-plus me-1"></i>Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<?php if(auth()->guard()->check()): ?>
<div class="offcanvas offcanvas-start offcanvas-sidebar" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileSidebarLabel">
            <i class="bi bi-box2-heart me-2"></i>Inventory MS
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <?php echo $__env->make('layouts._sidebar_nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>
<?php endif; ?>


<?php if(auth()->guard()->check()): ?>
    <div class="d-flex">
        
        <div class="sidebar-desktop">
            <?php echo $__env->make('layouts._sidebar_nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        
        <div class="main-content">
            <?php echo $__env->make('layouts._alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
<?php else: ?>
    <div class="container py-4">
        <?php echo $__env->make('layouts._alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
<?php endif; ?>


<footer class="app-footer">
    <i class="bi bi-box2-heart me-1"></i>
    &copy; <?php echo e(date('Y')); ?> Inventory Management System. All rights reserved.
</footer>


<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <?php if(session('success')): ?>
    <div class="toast align-items-center text-bg-success border-0"
         role="alert" data-bs-autohide="true" data-bs-delay="4500">
        <div class="d-flex">
            <div class="toast-body fs-6">
                <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="toast align-items-center text-bg-danger border-0"
         role="alert" data-bs-autohide="true" data-bs-delay="5500">
        <div class="d-flex">
            <div class="toast-body fs-6">
                <i class="bi bi-exclamation-circle-fill me-2"></i><?php echo e(session('error')); ?>

            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    <?php endif; ?>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-4 px-4">
                <p class="mb-0 fs-6" id="deleteModalMessage">
                    Are you sure you want to delete this item? This action cannot be undone.
                </p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </button>
                <form id="deleteModalForm" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function () {
    // ── Auto-show Bootstrap 5 Toasts ──
    document.querySelectorAll('.toast').forEach(function (el) {
        bootstrap.Toast.getOrCreateInstance(el).show();
    });

    // ── Global delete-modal handler ──
    // Add data-delete-url and data-delete-name to any delete button
    $(document).on('click', '[data-delete-url]', function () {
        var url  = $(this).data('delete-url');
        var name = $(this).data('delete-name') || 'this item';
        $('#deleteModalMessage').text(
            'Are you sure you want to delete "' + name + '"? This action cannot be undone.'
        );
        $('#deleteModalForm').attr('action', url);
        bootstrap.Modal.getOrCreateInstance(document.getElementById('deleteModal')).show();
    });
});
</script>

<?php echo $__env->yieldContent('scripts'); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\backend\resources\views/layouts/base.blade.php ENDPATH**/ ?>