
<?php if($menu && $menu->items): ?>
    <?php $__currentLoopData = $menu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a rel="noopener noreferrer"
           class="grid grid-flow-col items-center justify-start gap-1"
           href="<?php echo e($item->url ??'#'); ?>">
            <p title="Giới Thiệu" class="truncate"><?php echo e($item->name); ?></p>
            <div class="relative h-4 w-8">
                <img class="object-cover"
                     src="<?php echo e(asset('frontend/assets/image/post/new.png')); ?>"
                     alt="<?php echo e($item->name); ?>"
                     loading="lazy"
                     sizes="(max-width: 768px) 6rem, 6rem">
            </div>
        </a>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/layouts/partials/main-header.blade.php ENDPATH**/ ?>