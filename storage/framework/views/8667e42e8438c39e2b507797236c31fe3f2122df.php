<div class="breadcrumb-line" style="margin-top: 48px;">
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo e(route('admin.backend.home')); ?>">
                <i class="icon-home2 position-left"></i> Home
            </a>
        </li>

        <?php if(isset($breadcrumb)): ?>
            <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stt => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    try {
                        $url = isset($value['params'])
                            ? route($value['route'], $value['params'])
                            : route($value['route']);
                    } catch (\Exception $e) {
                        $url = '#';
                    }
                ?>
                <?php if($stt == (count($breadcrumb) - 1)): ?>
                    <li class="active"><?php echo $value['name']; ?></li>
                <?php else: ?>
                    <li><a href="<?php echo e($url); ?>"><?php echo e($value['name']); ?></a></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/layouts/partials/page-header.blade.php ENDPATH**/ ?>