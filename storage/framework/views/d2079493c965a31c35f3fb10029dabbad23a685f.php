<?php
    $album = is_array($product->album ?? null) ? $product->album : (array) $product->album;
    $images = count($album) ? $album : [];
    if (!count($images) && !empty($product->image)) {
        $images = [$product->image];
    }
    $totalImages = count($images);
?>

<div>
    <div class="relative aspect-square overflow-y-hidden">
        <div class="relative flex  w-full items-center">
            <div
                class="swiper custom-swiper-navigation w-full product-media-slide"
                id="product-main-media"
            >
                <div class="swiper-wrapper">
                    <?php if($totalImages): ?>
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide relative cursor-pointer">
                                <img
                                    class="h-full w-full"
                                    src="<?php echo e(asset('storage/'.$img)); ?>"
                                    alt="<?php echo e($product->name); ?> - <?php echo e($index+1); ?>"
                                    loading="lazy"
                                >
                                <div class="absolute bottom-0 z-[1] flex h-12 w-full md:h-[54px]"></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="swiper-slide relative cursor-pointer">
                            <img
                                class="h-full w-full"
                                src="<?php echo e(asset('backend/img/not-found.jpg')); ?>"
                                alt="<?php echo e($product->name); ?>"
                                loading="lazy"
                            >
                            <div class="absolute bottom-0 z-[1] flex h-12 w-full md:h-[54px]"></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <span
            class="absolute bottom-3 right-4 z-[1] rounded-sm bg-neutral-700 px-1.5 py-0.5 text-xs text-white md:hidden product-media-counter">
            <?php echo e(max($totalImages,1) > 1 ? '1/'.$totalImages : ''); ?>

        </span>
    </div>

    <div class="mt-3 hidden md:block">
        <div class="relative flex h-full w-full items-center">
            <div
                class="swiper swiper-horizontal swiper-free-mode custom-swiper-navigation w-full product-media-slide-thumbnail swiper-thumbs"
                id="product-thumb-media"
            >
                <div class="swiper-wrapper">
                    <?php if($totalImages): ?>
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide relative mr-3 aspect-square !w-[20%] cursor-pointer">
                                <img
                                    src="<?php echo e(asset('storage/'.$img)); ?>"
                                    alt="<?php echo e($product->name); ?> - thumbnail <?php echo e($index+1); ?>"
                                    loading="lazy"
                                >
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="swiper-slide relative mr-3 aspect-square !w-[20%] cursor-pointer">
                            <img
                                src="<?php echo e(asset('backend/img/not-found.jpg')); ?>"
                                alt="<?php echo e($product->name); ?>"
                                loading="lazy"
                            >
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/product/partials/album.blade.php ENDPATH**/ ?>