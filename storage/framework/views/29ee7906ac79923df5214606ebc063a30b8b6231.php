<?php $__env->startSection('content'); ?>
    <form id="productForm"
          action="<?php echo e(isset($item) ? route('admin.banner_items.update', $item->id) : route('admin.banner_items.store')); ?>"
          method="POST"
          enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php if(isset($item)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="col-md-12">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">

                        <fieldset class="content-group">
                            <legend class="text-bold"><?php echo e($title); ?></legend>
                            <div class="form-group <?php $__errorArgs = ['banner_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <label class="control-label">Nhóm Banner</label>
                                <select name="banner_id" class="form-control">
                                    <option value="">-- Chọn nhóm --</option>
                                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($b->id); ?>"
                                            <?php echo e(old('banner_id', $item->banner_id ?? $banner_id ?? '') == $b->id ? 'selected' : ''); ?>>
                                            <?php echo e($b->name); ?> (<?php echo e($b->code); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="help-block"><?php echo e($errors->first('banner_id')); ?></span>
                            </div>
                            <div class="form-group <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <label class="control-label">Tiêu đề</label>
                                <input type="text" class="form-control"
                                       name="title"
                                       value="<?php echo e(old('title', $item->title ?? '')); ?>">
                                <span class="help-block"><?php echo e($errors->first('title')); ?></span>
                            </div>
                            <div class="form-group <?php $__errorArgs = ['subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <label class="control-label">Phụ đề</label>
                                <input type="text" class="form-control"
                                       name="subtitle"
                                       value="<?php echo e(old('subtitle', $item->subtitle ?? '')); ?>">
                                <span class="help-block"><?php echo e($errors->first('subtitle')); ?></span>
                            </div>
                            <div class="form-group <?php $__errorArgs = ['link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <label class="control-label">Link</label>
                                <input type="text" class="form-control"
                                       name="link"
                                       value="<?php echo e(old('link', $item->link ?? '')); ?>">
                                <span class="help-block"><?php echo e($errors->first('link')); ?></span>
                            </div>
                            <div class="form-group <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <label class="control-label">Thứ tự</label>
                                <input type="number" class="form-control"
                                       name="sort_order"
                                       value="<?php echo e(old('sort_order', $item->sort_order ?? 0)); ?>">
                                <span class="help-block"><?php echo e($errors->first('sort_order')); ?></span>
                            </div>

                        </fieldset>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN</legend>
                            <?php echo $__env->make('backend.components.status_select', [
                                'name'  => 'status',
                                'label' => 'Trạng thái',
                                'value' => old('status', $item->status ?? 1),
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Hình ảnh</legend>
                            <?php echo $__env->make('backend.components.image', [
                                'model' => $item ?? null,
                                'name'  => 'image'
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </fieldset>
                    </div>
                </div>

            </div>
        </div>
        <?php echo $__env->make('backend.components.button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('backend.partials.ckeditor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/banner_items/form.blade.php ENDPATH**/ ?>