<?php $__env->startSection('content'); ?>
    <form id="productForm"
          data-model="<?php echo e(strtolower($model ?? '')); ?>"
          action="<?php echo e(isset($id) ? route('admin.products.update', $id) : route('admin.products.store')); ?>"
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
                                <label class="control-label" for="name">Tên sản phẩm</label>
                                <input type="text"
                                       class="form-control change-title"
                                       name="name"
                                       data-flag="0"
                                       value="<?php echo e(old('name', $product->name ?? '')); ?>">
                                <div class="form-control-feedback">
                                    <?php if($errors->first('name')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                            </div>
                            <div class="form-group <?php if($errors->first('note')): ?> has-error <?php endif; ?>">
                                <label class="control-label" for="note">Lưu ý</label>
                                <input type="text"
                                       class="form-control change-title"
                                       name="note"
                                       value="<?php echo e(old('note', $product->note ?? '')); ?>">
                                <div class="form-control-feedback">
                                    <?php if($errors->first('note')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('name')); ?></span>
                            </div>
                            <div class="form-group has-feedback <?php if($errors->first('description')): ?> has-error <?php endif; ?>">
                                <label class="control-label text-semibold">Mô tả</label>
                                <textarea class="ck-editor"
                                          id="description"
                                          name="description"><?php echo e(old('description', $product->description ?? '')); ?></textarea>
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
                                          name="content"><?php echo e(old('content', $product->content ?? '')); ?></textarea>
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
                <?php echo $__env->make('backend.components.album',['model' => $product ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('backend.components.seo', ['model' => $product ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN CHUNG</legend>
                            <div class="form-group <?php if($errors->first('category_id')): ?> has-error <?php endif; ?>">
                                <label class="control-label text-semibold">Danh mục</label>
                                <select name="category_id" class="form-control select2">
                                    <option value="">-- Chọn danh mục --</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"
                                            <?php echo e((string)$category->id === (string)old('category_id', $product->category_id ?? '') ? 'selected' : ''); ?>>
                                            <?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="form-control-feedback">
                                    <?php if($errors->first('category_id')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('category_id')); ?></span>
                            </div>
                            <div class="form-group <?php if($errors->first('brand_id')): ?> has-error <?php endif; ?>">
                                <label class="control-label text-semibold">Thương hiệu</label>
                                <select name="brand_id" class="form-control select2">
                                    <option value="">-- Chọn thương hiệu --</option>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($brand->id); ?>"
                                            <?php echo e((string)$brand->id === (string)old('brand_id', $product->brand_id ?? '') ? 'selected' : ''); ?>>
                                            <?php echo e($brand->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="form-control-feedback">
                                    <?php if($errors->first('brand_id')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('brand_id')); ?></span>
                            </div>
                            <?php echo $__env->make('backend.components.status_select', [
                                 'name'  => 'status',
                                 'label' => 'Trạng thái',
                                'value' => $product->status ?? 1,
                             ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('backend.components.status_select', [
                                  'name'  => 'is_featured',
                                  'label' => 'Nổi bật',
                                  'value' => $product->is_featured ?? 1,
                              ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Thông số sản phẩm</legend>
                            <div class="form-group">
                                <label class="control-label" for="code">Mã sản phẩm (code)</label>
                                <input type="text"
                                       class="form-control"
                                       name="code"
                                       value="<?php echo e(old('code', $product->code ?? '')); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="sku">Mã SKU</label>
                                <input type="text"
                                       class="form-control"
                                       name="sku"
                                       value="<?php echo e(old('sku', $product->sku ?? '')); ?>">
                            </div>
                            <div class="form-group <?php if($errors->first('quantity')): ?> has-error <?php endif; ?>">
                                <label class="control-label" for="quantity">Số lượng</label>
                                <input type="number"
                                       class="form-control"
                                       name="quantity"
                                       min="0"
                                       value="<?php echo e(old('quantity', $product->quantity ?? 0)); ?>">
                                <div class="form-control-feedback">
                                    <?php if($errors->first('quantity')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('quantity')); ?></span>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <?php if(!empty($product->qr_code ?? null)): ?>
                    <div class="panel panel-flat">
                        <div class="panel-body text-center">
                            <fieldset class="content-group">
                                <legend class="text-bold">QR CODE</legend>
                                <img src="<?php echo e(asset('storage/'.$product->qr_code)); ?>"
                                     alt="QR <?php echo e($product->name ?? ''); ?>"
                                     style="max-width: 100%; height: auto;">
                            </fieldset>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Hình ảnh</legend>
                            <?php echo $__env->make('backend.components.image', ['model' => $product ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Icon</legend>
                            <?php echo $__env->make('backend.components.icon', ['model' => $product ?? null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/products/form.blade.php ENDPATH**/ ?>