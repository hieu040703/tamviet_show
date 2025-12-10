<?php
    $imagePath = (isset($model) && !empty($model->image))
        ? asset('storage/' . $model->image)
        : asset('backend/img/not-found.jpg');
?>

<div class="ibox-content">
    <div class="col-md-12">
        <div class="form-row">
            <span class="image img-cover image-target">
                <img id="preview-image" src="<?php echo e($imagePath); ?>" alt="">
            </span>
            <input type="file" id="image" name="image" class="hidden">
            <span class="help-block text-danger"><?php echo e($errors->first('image')); ?></span>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/components/image.blade.php ENDPATH**/ ?>