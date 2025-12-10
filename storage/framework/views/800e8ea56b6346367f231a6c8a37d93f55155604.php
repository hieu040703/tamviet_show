<?php $__env->startSection('content'); ?>
    <form id="productForm"
          data-model="<?php echo e(strtolower($model ?? '')); ?>"
          action="<?php echo e(isset($id) ? route('admin.categories.update', $id) : route('admin.categories.store')); ?>"
          method="POST"
          enctype="multipart/form-data">
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
                                <label class="control-label" for="name">Tên danh mục</label>
                                <input type="text"
                                       class="form-control change-title"
                                       name="name"
                                       data-flag="0"
                                       value="<?php echo e(old('name', $category->name ?? '')); ?>">
                                <div class="form-control-feedback">
                                    <?php if($errors->first('name')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                            </div>
                            <div class="form-group has-feedback <?php if($errors->first('description')): ?> has-error <?php endif; ?>">
                                <label class="control-label text-semibold">Mô tả</label>
                                <textarea class="ck-editor "
                                          id="description"
                                          name="description"><?php echo e(old('description', $category->description ?? '')); ?></textarea>
                                <div class="form-control-feedback">
                                    <?php if($errors->first('description')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('description')); ?></span>
                            </div>
                            <div class="form-group has-feedback <?php if($errors->first('content')): ?> has-error <?php endif; ?>">
                                <label class="control-label text-semibold">Nội dung</label>
                                <textarea class="ck-editor"
                                          id="content"
                                          name="content"><?php echo e(old('content', $category->content ?? '')); ?></textarea>
                                <div class="form-control-feedback">
                                    <?php if($errors->first('content')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('content')); ?></span>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <?php echo $__env->make('backend.components.seo', ['model' => $category ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN CHUNG</legend>
                            <?php echo $__env->make('backend.components.status_select', [
                                 'name'  => 'status',
                                 'label' => 'Trạng thái',
                                 'value' => $category->status ?? 1,
                             ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('backend.components.status_select', [
                              'name'  => 'is_featured',
                              'label' => 'Nổi bật',
                              'value' => $category->is_featured ?? 1,
                          ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('backend.components.parent_select', [
                                 'dropdown' => $dropdown,
                                 'selected' => isset($category) ? $category->parent_id : 0,
                                 'name'     => 'parent_id',
                                 'id'       => 'parent_id',
                                 'label'    => 'Chọn Root nếu không có danh mục cha',
                             ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Hình ảnh</legend>
                            <?php echo $__env->make('backend.components.image', ['model' => $category ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Icon</legend>
                            <?php echo $__env->make('backend.components.icon', ['model' => $category ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('backend.components.button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/plugins/uploaders/dropzone.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/plugins/forms/selects/select2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/plugins/forms/selects/selectboxit.min.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.ckeditor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/categories/form.blade.php ENDPATH**/ ?>