<div class="<?php echo e($hidden ?? null); ?>">
    <div class="w-full bg-neutral-200">
        <div class="hidden h-2 bg-primary-500 md:block"></div>
        <footer class="container pb-24 pt-4 text-sm md:pb-6">
            <?php echo $__env->make('frontend.layouts.partials.footer-menu-follow', ['menuKey' => 'footer-menu'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="mt-3 w-full border-t-[1px] border-neutral-300 pt-3 text-xs md:mt-1"
            >
                <h4 class="text-[14px] leading-[20px] font-semibold">
                    <?php echo e($system['homepage_company'] ?? 'CÔNG TY CỔ PHẦN ĐẦU TƯ & THƯƠNG MẠI QUỐC TẾ TÂM VIỆT'); ?>

                </h4>
                <div class="lg:flex">
                    <div class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink mt-1 lg:w-[45%]"
                    >
                        <p>GCNDKDN: <?php echo e($system['contact_address'] ?? '0108893581 do sở KH &amp; ĐT TP. Hà Nội cấp ngày
                            10/09/2019.'); ?>

                        </p>
                        <p>Trụ sở: <?php echo e($system['contact_office'] ?? '139 Đa Lộc, Thiên Lộc, Thành phố Hà Nội'); ?>

                        </p>
                        <p>Điện thoại: <?php echo e($system['contact_hotline'] ??'092.686.5566'); ?> -
                            Email: <?php echo e($system['contact_email'] ?? 'duoctbyt@tamvietmed.com'); ?></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/layouts/partials/footer.blade.php ENDPATH**/ ?>