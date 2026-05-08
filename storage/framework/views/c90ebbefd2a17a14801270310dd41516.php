<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 120px);">
    <div class="card shadow border-0" style="width: 100%; max-width: 440px; border-radius: 16px; overflow: hidden;">

        
        <div class="text-white text-center p-4"
             style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-25 mb-3"
                 style="width:64px;height:64px;">
                <i class="bi bi-box2-heart fs-2 text-white"></i>
            </div>
            <h4 class="fw-bold mb-1">Inventory Management</h4>
            <p class="mb-0 opacity-75 small">Sign in to your account</p>
        </div>

        <div class="card-body p-4">
            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                
                <div class="form-floating mb-3">
                    <input type="email"
                           class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           id="email" name="email"
                           value="<?php echo e(old('email')); ?>"
                           placeholder="Email address"
                           required autofocus>
                    <label for="email"><i class="bi bi-envelope me-1"></i>Email Address</label>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-3">
                    <div class="input-group">
                        <div class="form-floating flex-grow-1">
                            <input type="password"
                                   class="form-control border-end-0 rounded-end-0 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="password" name="password"
                                   placeholder="Password" required>
                            <label for="password"><i class="bi bi-lock me-1"></i>Password</label>
                        </div>
                        <button class="btn btn-outline-secondary border-start-0 rounded-start-0"
                                type="button" id="togglePw"
                                data-bs-toggle="tooltip" title="Toggle password visibility">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label text-muted small" for="remember">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                </button>
            </form>

            <hr class="my-4">

            <p class="text-center text-muted small mb-0">
                Don't have an account?
                <a href="<?php echo e(route('register')); ?>" class="text-primary fw-semibold text-decoration-none">
                    Create Account
                </a>
            </p>

            <?php if(app()->isLocal()): ?>
            
            <div class="accordion mt-3" id="devCreds">
                <div class="accordion-item border border-info rounded">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed py-2 bg-info bg-opacity-10 text-info small fw-semibold"
                                type="button" data-bs-toggle="collapse" data-bs-target="#devBody">
                            <i class="bi bi-info-circle me-2"></i>Dev Credentials
                        </button>
                    </h2>
                    <div id="devBody" class="accordion-collapse collapse" data-bs-parent="#devCreds">
                        <div class="accordion-body py-2 small">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted">Admin:</span>
                                <span>admin@inventory.com / <kbd>admin123</kbd></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Staff:</span>
                                <span>staff@inventory.com / <kbd>staff123</kbd></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
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

    $('#togglePw').on('click', function () {
        var inp  = $('#password');
        var icon = $('#eyeIcon');
        if (inp.attr('type') === 'password') {
            inp.attr('type', 'text');
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            inp.attr('type', 'password');
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\resources\views/auth/login.blade.php ENDPATH**/ ?>