<?php
    $block  = $homeCategories ?? [];
    $widget = $block['widget'] ?? null;
    $items  = collect($block['items'] ?? []);
?>

<?php if($widget && $items->isNotEmpty()): ?>
    <div>
        <div class="bg-neutral-100 h-3"></div>
        <div class="container pb-4">
            <h4 class="font-semibold p-4 px-0 text-base md:text-[20px]">
                <?php echo e($widget->name ?? 'Danh mục nổi bật'); ?>

            </h4>

            <div class="grid grid-cols-2 gap-2 md:grid-cols-5 md:gap-4">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $image = $item->image ? asset('storage/'.$item->image) : asset('backend/img/not-found.jpg');
                    ?>

                    <a
                        class="flex items-center gap-2 rounded-lg border p-2"
                        href="<?php echo e(router_link('categories', $item->id)); ?>"
                    >
                        <img
                            href="<?php echo e(router_link('categories', $item->id)); ?>"
                            class="h-14 w-14 rounded-full object-cover"
                            src="<?php echo e($image); ?>"
                            alt="<?php echo e($item->name); ?>"
                            loading="lazy"
                            width="500"
                            height="500"
                        >
                        <p class="line-clamp-2 text-sm">
                            <?php echo e($item->name); ?>

                        </p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/components/featured-categories.blade.php ENDPATH**/ ?>