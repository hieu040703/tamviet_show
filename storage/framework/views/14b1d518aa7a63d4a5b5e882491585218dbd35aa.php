<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">

            <p style="margin: 0; padding: 5px 0;">
                <span class="text-semibold">
                    <?php echo e(($items->currentPage() - 1) * $items->perPage() + 1); ?>

                    -
                    <?php echo e(($items->currentPage() - 1) * $items->perPage() + $items->count()); ?>

                </span>
                trong
                <span class="text-semibold"><?php echo e($items->total()); ?></span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter"><i class="icon-more"></i></a>

                            <a href="<?php echo e(route('admin.banner_items.create')); ?>"
                               class="btn text-right"><i class="icon-plus3"></i></a>

                            <a href="<?php echo e(route('admin.banner_items.index')); ?>"
                               class="btn color-black"><i class="icon-cancel-circle2"></i></a>

                            <button type="submit" class="btn btn-sucess text-right">
                                <i class="icon-search4"></i>
                            </button>
                        </li>
                    </ul>

                    <div class="navbar-collapse collapse" id="navbar-filter">
                        <form action="" method="GET">
                            <ul class="nav navbar-nav">

                                <li style="padding-right:10px;">
                                    <select class="form-control" name="banner_id">
                                        <option value="">-- Chọn nhóm banner --</option>
                                        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($b->id); ?>"
                                                <?php echo e(request('banner_id') == $b->id ? 'selected' : ''); ?>>
                                                <?php echo e($b->name); ?> (<?php echo e($b->code); ?>)
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </li>

                                <li>
                                    <input type="text" name="keyword"
                                           value="<?php echo e(request('keyword')); ?>"
                                           class="form-control"
                                           placeholder="Tìm tiêu đề...">
                                </li>

                            </ul>

                            <div class="navbar-right hidden-xs">
                                <button type="submit" class="btn btn-sucess">
                                    <i class="icon-search4"></i>
                                </button>

                                <a href="<?php echo e(route('admin.banner_items.index')); ?>"
                                   class="btn color-black">
                                    <i class="icon-cancel-circle2"></i>
                                </a>

                                <a href="<?php echo e(route('admin.banner_items.create')); ?>"
                                   class="btn text-primary">
                                    <i class="icon-plus3"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="table-responsive" style="min-height:400px;">

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="20" class="text-center">STT</th>
                            <th width="100">Ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Link</th>
                            <th width="100" class="text-center">Thứ tự</th>
                            <th width="80" class="text-center">Trạng thái</th>
                            <th class="text-center" width="80">Thao tác</th>
                        </tr>
                        </thead>

                        <tbody id="sortable-banner"
                               data-sort-url="<?php echo e(route('ajax.banner_items.sort')); ?>"
                               data-token="<?php echo e(csrf_token()); ?>">
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stt => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr data-id="<?php echo e($item->id); ?>">
                                <td class="text-center">
                                    <?php echo e(($items->currentPage() - 1) * $items->perPage() + $stt + 1); ?>

                                </td>

                                <td class="text-center">
                                    <?php if($item->image): ?>
                                        <img src="<?php echo e(asset('storage/'.$item->image)); ?>"
                                             style="height:60px;border-radius:4px;">
                                    <?php else: ?>
                                        <span class="text-muted">Không có</span>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo e($item->title); ?></td>
                                <td><?php echo e($item->link); ?></td>

                                <td class="text-center">
                                    <input type="number"
                                           name="orders[<?php echo e($item->id); ?>]"
                                           class="form-control text-center"
                                           value="<?php echo e($item->sort_order); ?>">
                                </td>

                                <td class="text-center">
                                    <?php echo $__env->make('backend.components.status', [
                                        'model'   => $model,
                                        'field'   => 'status',
                                        'value'   => $item->status,
                                        'modelId' => $item->id
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>

                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li style="margin-right:10px;">
                                            <a href="<?php echo e(route('admin.banner_items.edit', $item->id)); ?>"
                                               class="text-blue">
                                                <i class="icon-pencil7"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST"
                                                  action="<?php echo e(route('admin.banner_items.delete', $item->id)); ?>"
                                                  onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button style="background:none;border:none;color:red;cursor:pointer;">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center">Không có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>

                    </table>

                    <div style="border-top:1px solid #ccc;"></div>

                    <div style="padding:10px 15px;text-align:center;">
                        <?php echo e($items->appends(request()->query())->links('pagination::bootstrap-4')); ?>

                    </div>

                </div>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(URL::asset('backend/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/plugins/forms/selects/select2.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/assets/js/bannerItem.js')); ?>">
    </script>
    <style>
        #sortable-banner tr {
            cursor: move;
        }

        .sortable-placeholder {
            height: 60px;
            background: #f5f5f5;
            border: 2px dashed #ccc;
            margin: 4px 0;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/banner_items/index.blade.php ENDPATH**/ ?>