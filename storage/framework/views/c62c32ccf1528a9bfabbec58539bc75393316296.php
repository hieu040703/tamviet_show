<?php
    $field = $name ?? 'status';
    $labelText = $label ?? 'Trạng thái';
    $default = $value ?? 1;
    $current = old($field, $default);
?>
<div class="form-group has-feedback <?php if($errors->first($field)): ?> has-error <?php endif; ?>">
    <label class="control-label text-semibold"><?php echo e($labelText); ?></label>
    <select name="<?php echo e($field); ?>" class="form-control select2">
        <?php $__currentLoopData = config('apps.status'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>"
                <?php echo e((string)$key === (string)$current ? 'selected' : ''); ?>>
                <?php echo e($text); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <div class="form-control-feedback">
        <?php if($errors->first($field)): ?>
            <i class="icon-notification2"></i>
        <?php endif; ?>
    </div>

    <span class="help-block"><?php echo e($errors->first($field)); ?></span>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/components/status_select.blade.php ENDPATH**/ ?>