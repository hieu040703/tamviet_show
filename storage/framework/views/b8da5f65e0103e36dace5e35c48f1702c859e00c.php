<?php if($relatedProducts->isNotEmpty()): ?>
    <div class="pb-4 md:container">
        <div>
            <div class="block-title flex items-center p-4 md:px-0">
                <h4 class="font-semibold flex flex-1 text-base md:text-[20px]">
                    Sản phẩm cùng thương hiệu
                </h4>
            </div>
        </div>
        <div>
            <div class="md:-ml-1">
                <div class="relative flex h-full w-full items-center">
                    <div
                        class="swiper custom-swiper-navigation w-full product-playlist !px-4 sm:rounded-lg md:!px-1">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $image = $item->image
                                        ? asset('storage/'.$item->image)
                                        : asset('backend/img/not-found.jpg');
                                ?>
                                <div class="swiper-slide !h-auto !w-[178px] pb-[1px] md:!w-[202.6px]">
                                    <div class="mr-[10px] md:mr-4 h-full relative !max-h-[460px]">
                                        <div class="product-card flex h-full flex-col">
                                            <div
                                                class="flex h-full flex-1 flex-col overflow-hidden rounded-lg border bg-white pb-[1px] shadow-sm">
                                                <div class="product-card-image">
                                                    <a href="<?php echo e(router_link('products', $item->id) ?? '#'); ?>">
                                                        <img
                                                            class="max-h-[100%] max-w-[100%] object-contain"
                                                            src="<?php echo e($image); ?>"
                                                            alt="<?php echo e($item->name); ?>"
                                                            loading="lazy"
                                                            width="500"
                                                            height="500"
                                                        >
                                                        <span
                                                            class="absolute bottom-0 left-0 flex h-[26px] w-full"></span>
                                                    </a>
                                                </div>
                                                <div class="flex flex-1 flex-col p-2 font-medium">
                                                    <a href="<?php echo e(router_link('products', $item->id) ?? '#'); ?>">
                                                        <div data-state="closed">
                                                            <h3 class="line-clamp-2 h-10 text-sm font-semibold">
                                                                <?php echo e($item->name); ?>

                                                            </h3>
                                                        </div>
                                                    </a>
                                                    <div class="flex flex-1 flex-col justify-end">
                                                        <div class="flex items-end justify-center">
                                                            <button
                                                                data-open-product-modal
                                                                data-product-id="<?php echo e($item->id); ?>"
                                                                data-product-name="<?php echo e($item->name); ?>"
                                                                data-product-image="<?php echo e($image); ?>"
                                                                class="btn-choose-product relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 w-full
                                                                 text-sm px-4 py-2 h-9 items-center rounded-lg mt-2">
                                                                <span>Chọn sản phẩm</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/product/partials/related-brand.blade.php ENDPATH**/ ?>