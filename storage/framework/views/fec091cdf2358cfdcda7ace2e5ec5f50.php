 
<?php $__env->startSection('title', 'Stock Out'); ?>
 
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-dash-circle"></i> Record Stock Out</h1>
    <p>Record outgoing stock (sales, usage, transfers)</p>
</div>
 
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="<?php echo e(route('stock-out.store')); ?>" method="POST">
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
                                <i class="bi bi-box-seam"></i>
                                <strong id="ajaxProductName"></strong>
                                &nbsp;|&nbsp; SKU: <span id="ajaxSku"></span>
                            </span>
                            <span>
                                Available: <strong id="ajaxQty" class="fs-5"></strong>
                                <span id="ajaxUnit"></span>
                                <span id="ajaxMinBadge" class="badge d-none ms-1"
                                      style="background:#e74c3c;color:white;">Low Stock</span>
                            </span>
                        </div>
                    </div>
 
                    <div id="stockLoading" class="text-muted small mb-2 d-none">
                        <span class="spinner-border spinner-border-sm me-1"></span> Loading stock info...
                    </div>
 
                    
                    <div class="alert alert-danger" id="stockWarning" style="display:none;">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>Warning:</strong> <span id="warningText"></span>
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
                        <label for="remarks" class="form-label">Remarks (reason for stock out)</label>
                        <textarea class="form-control <?php $__errorArgs = ['remarks'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  id="remarks" name="remarks" rows="3"
                                  placeholder="e.g., Sale order #123, Internal use, Transfer"><?php echo e(old('remarks')); ?></textarea>
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
                        <button type="submit" class="btn btn-danger" id="submitBtn">
                            <i class="bi bi-check-circle"></i> Record Stock Out
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
    var ajaxUrl  = '<?php echo e(route("api.product-stock", ":id")); ?>';
    var available = 0;
 
    $('#product_id').on('change', function () {
        var productId = $(this).val();
        available = 0;
        $('#stockWarning').hide();
        $('#stockInfoPanel').addClass('d-none');
 
        if (!productId) return;
 
        $('#stockLoading').removeClass('d-none');
 
        $.ajax({
            url: ajaxUrl.replace(':id', productId),
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (data) {
                available = data.quantity_on_hand;
                $('#ajaxProductName').text(data.name);
                $('#ajaxSku').text(data.sku);
                $('#ajaxQty').text(data.quantity_on_hand);
                $('#ajaxUnit').text(data.unit);
 
                if (data.is_low_stock) {
                    $('#ajaxMinBadge').removeClass('d-none');
                    $('#stockInfoPanel').removeClass('alert-info').addClass('alert-warning');
                } else {
                    $('#ajaxMinBadge').addClass('d-none');
                    $('#stockInfoPanel').removeClass('alert-warning').addClass('alert-info');
                }
 
                $('#stockLoading').addClass('d-none');
                $('#stockInfoPanel').removeClass('d-none');
                checkQty();
            },
            error: function () {
                $('#stockLoading').addClass('d-none');
            }
        });
    });
 
    $('#quantity').on('input', function () {
        checkQty();
    });
 
    function checkQty() {
        var qty = parseInt($('#quantity').val()) || 0;
        if ($('#product_id').val() && qty > available) {
            $('#warningText').text(
                'Requested ' + qty + ' units but only ' + available + ' are in stock.'
            );
            $('#stockWarning').show();
            $('#submitBtn').prop('disabled', true);
        } else {
            $('#stockWarning').hide();
            $('#submitBtn').prop('disabled', false);
        }
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\resources\views/stock/stock-out.blade.php ENDPATH**/ ?>