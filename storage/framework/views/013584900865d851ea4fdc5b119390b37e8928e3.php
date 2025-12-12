<?php if(!empty($menu) && $menu->items->count()): ?>
    <div class="relative text-sm text-white js-category-nav">
        <div class="swiper category-playlist w-full swiper-backface-hidden">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $menu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide !w-fit md:mr-4 lg:mr-6">
                        <a class="flex items-center"
                           href="<?php echo e(router_link_from_canonical(optional($item->router)->canonical)); ?>">
                            <span class="text-base font-medium">
                                <?php echo e($item->name); ?>

                            </span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/layouts/partials/menu.blade.php ENDPATH**/ ?>