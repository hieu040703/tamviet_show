<?php
    $name = $name ?? 'parent_id';
    $label = $label ?? 'Chọn Root nếu không có danh mục cha';
    $dropdown = $dropdown ?? [];
    $selected = old($name, $selected ?? 0);
?>
<div class="form-group has-feedback <?php if($errors->first($name)): ?> has-error <?php endif; ?>">
    <label class="control-label text-semibold">
        <span class="text-danger">
            <?php echo e($label); ?>

        </span>
    </label>
    <select name="<?php echo e($name); ?>"
            class="form-control select2"
            id="<?php echo e($id ?? $name); ?>"
            data-allow-clear="true">
        <?php $__currentLoopData = $dropdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($key); ?>" <?php echo e((string)$key === (string)$selected ? 'selected' : ''); ?>>
                <?php echo e($val); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <div class="form-control-feedback">
        <?php if($errors->first($name)): ?>
            <i class="icon-notification2"></i>
        <?php endif; ?>
    </div>
    <span class="help-block"><?php echo e($errors->first($name)); ?></span>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/components/parent_select.blade.php ENDPATH**/ ?>