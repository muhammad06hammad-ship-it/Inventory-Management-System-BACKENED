 
<?php $__env->startSection('title', 'Stock In'); ?>
 
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-plus-circle"></i> Record Stock In</h1>
    <p>Record incoming stock from suppliers</p>
</div>
 
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="<?php echo e(route('stock-in.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
 
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Product *</label>
                        <select class="form-select <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="product_id" name="product_id" required>
                            <option value="">-- Select Product --</option>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($product->id); ?>" <?php echo e(old('product_id') == $product->id ? 'selected' : ''); ?>>
                                    <?php echo e($product->name); ?> (<?php echo e($product->sku); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['product_id'];
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
 
                    
                    <div id="stockInfoPanel" class="alert alert-info d-none mb-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <span>
                                <i class="bi bi-info-circle"></i>
                                <strong id="ajaxProductName"></strong>
                                &nbsp;|&nbsp; SKU: <span id="ajaxSku"></span>
                            </span>
                            <span>
                                Current stock:
                                <strong id="ajaxQty" class="fs-5"></strong>
                                <span id="ajaxUnit"></span>
                                <span id="ajaxLowBadge" class="badge d-none ms-1"
                                      style="background:#e74c3c;color:white;">Low Stock</span>
                            </span>
                        </div>
                    </div>
 
                    <div id="stockLoading" class="text-muted small mb-2 d-none">
                        <span class="spinner-border spinner-border-sm me-1"></span> Loading stock info...
                    </div>
 
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select class="form-select <?php $__errorArgs = ['supplier_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="supplier_id" name="supplier_id">
                            <option value="">-- Select Supplier (Optional) --</option>
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->id); ?>" <?php echo e(old('supplier_id') == $supplier->id ? 'selected' : ''); ?>>
                                    <?php echo e($supplier->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['supplier_id'];
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
                        <label for="quantity" class="form-label">Quantity *</label>
                        <input type="number" class="form-control <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="quantity" name="quantity" value="<?php echo e(old('quantity')); ?>"
                               min="1" required>
                        <?php $__errorArgs = ['quantity'];
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
                        <label for="transaction_date" class="form-label">Transaction Date *</label>
                        <input type="date" class="form-control <?php $__errorArgs = ['transaction_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="transaction_date" name="transaction_date"
                               value="<?php echo e(old('transaction_date', date('Y-m-d'))); ?>" required>
                        <?php $__errorArgs = ['transaction_date'];
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
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control <?php $__errorArgs = ['remarks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  id="remarks" name="remarks" rows="3"
                                  placeholder="e.g., Purchase order #456, Received from warehouse"><?php echo e(old('remarks')); ?></textarea>
                        <?php $__errorArgs = ['remarks'];
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
 
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Record Stock In
                        </button>
                        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
<?php $__env->stopSection(); ?>
 
<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function () {
    var ajaxUrl = '<?php echo e(route("api.product-stock", ":id")); ?>';
 
    $('#product_id').on('change', function () {
        var productId = $(this).val();
 
        if (!productId) {
            $('#stockInfoPanel').addClass('d-none');
            return;
        }
 
        $('#stockLoading').removeClass('d-none');
        $('#stockInfoPanel').addClass('d-none');
 
        $.ajax({
            url: ajaxUrl.replace(':id', productId),
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (data) {
                $('#ajaxProductName').text(data.name);
                $('#ajaxSku').text(data.sku);
                $('#ajaxQty').text(data.quantity_on_hand);
                $('#ajaxUnit').text(data.unit);
 
                if (data.is_low_stock) {
                    $('#ajaxLowBadge').removeClass('d-none');
                    $('#stockInfoPanel').removeClass('alert-info').addClass('alert-warning');
                } else {
                    $('#ajaxLowBadge').addClass('d-none');
                    $('#stockInfoPanel').removeClass('alert-warning').addClass('alert-info');
                }
 
                $('#stockLoading').addClass('d-none');
                $('#stockInfoPanel').removeClass('d-none');
            },
            error: function () {
                $('#stockLoading').addClass('d-none');
            }
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\resources\views/stock/stock-in.blade.php ENDPATH**/ ?>