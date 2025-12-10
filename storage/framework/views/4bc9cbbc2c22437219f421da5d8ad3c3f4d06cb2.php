<?php
    $iconPath = (isset($model) && !empty($model->icon))
        ? asset('storage/' . $model->icon)
        : asset('backend/img/not-found.jpg');
?>

<div class="ibox-content">
    <div class="col-md-12">
        <div class="form-row">
            <span class="image img-cover icon-target-1">
                <img id="preview-icon" src="<?php echo e($iconPath); ?>" alt="">
            </span>
            <input type="file" id="icon" name="icon" class="hidden">
            <span class="help-block text-danger"><?php echo e($errors->first('icon')); ?></span>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/components/icon.blade.php ENDPATH**/ ?>