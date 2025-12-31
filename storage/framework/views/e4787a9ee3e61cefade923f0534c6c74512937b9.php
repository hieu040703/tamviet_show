<?php
    $block  = $homeCategories ?? [];
    $widget = $block['widget'] ?? null;
    $items  = collect($block['items'] ?? []);
?>

<?php if($widget && $items->isNotEmpty()): ?>
    <div>
        <div class="bg-neutral-100 h-3"></div>
        <div class="container pb-4 pt-4">
            <div class="grid grid-cols-2 gap-2 md:grid-cols-6 md:gap-4">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $image = $item->icon
                            ? asset('storage/'.$item->icon)
                            : asset('backend/img/not-found.jpg');
                    ?>

                    <a
                        href="<?php echo e(router_link('categories', $item->id)); ?>"
                        class="flex flex-col items-center gap-2 rounded-lg border p-3 text-center hover:shadow-sm transition"
                    >
                        <img
                            class="h-16 w-16 rounded-full object-cover"
                            src="<?php echo e($image); ?>"
                            alt="<?php echo e($item->name); ?>"
                            loading="lazy"
                        >

                        <p class="p-icon-1 line-clamp-2 text-sm font-semibold text-neutral-800">
                            <?php echo e($item->name); ?>

                        </p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="bg-neutral-100 h-3"></div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/components/featured-categories.blade.php ENDPATH**/ ?>