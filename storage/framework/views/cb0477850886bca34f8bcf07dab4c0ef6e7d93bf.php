<?php $__env->startSection('content'); ?>
    <form id="productForm"
          action="<?php echo e(isset($id) ? route('admin.banners.update', $id) : route('admin.banners.store')); ?>"
          method="POST">
        <?php echo csrf_field(); ?>
        <?php if(isset($id)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="col-md-12">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold"><?php echo e($title); ?></legend>

                            <div class="form-group <?php if($errors->first('name')): ?> has-error <?php endif; ?>">
                                <label class="control-label" for="name">Tên nhóm banner</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       id="name"
                                       value="<?php echo e(old('name', $banner->name ?? '')); ?>">
                                <div class="form-control-feedback">
                                    <?php if($errors->first('name')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                            </div>

                            <div class="form-group <?php if($errors->first('code')): ?> has-error <?php endif; ?>">
                                <label class="control-label" for="code">Code (duy nhất)</label>
                                <input type="text"
                                       class="form-control"
                                       name="code"
                                       id="code"
                                       value="<?php echo e(old('code', $banner->code ?? '')); ?>"
                                       placeholder="VD: home_main, home_right_top">
                                <div class="form-control-feedback">
                                    <?php if($errors->first('code')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('code')); ?></span>
                                <span class="help-block text-muted">
                                    Dùng code để gọi banner trong code PHP (VD: home_main).
                                </span>
                            </div>

                            <div class="form-group <?php if($errors->first('position')): ?> has-error <?php endif; ?>">
                                <label class="control-label" for="position">Vị trí hiển thị</label>
                                <input type="text"
                                       class="form-control"
                                       name="position"
                                       id="position"
                                       value="<?php echo e(old('position', $banner->position ?? '')); ?>"
                                       placeholder="VD: main, right_top, right_bottom">
                                <div class="form-control-feedback">
                                    <?php if($errors->first('position')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('position')); ?></span>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN CHUNG</legend>

                            <?php echo $__env->make('backend.components.status_select', [
                                'name'  => 'status',
                                'label' => 'Trạng thái',
                                'value' => old('status', $banner->status ?? 1),
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('backend.components.button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/banners/form.blade.php ENDPATH**/ ?>