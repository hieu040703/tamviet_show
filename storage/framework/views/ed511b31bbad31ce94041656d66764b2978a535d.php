<div class="<?php echo e($hiddenHeader ?? null); ?>">
    <?php
        $logo = $system['homepage_logo'];
    ?>
    <nav id="mainNav" style="--background:hsl(var(--primary-500))"
         class="relative top-0 z-20 w-full pb-[25.64%] transition-[padding] max-md:min-h-[116px] md:relative md:!pb-0  md:!bg-none">
        <div class="absolute bottom-0 h-full w-full  md:static">
            <picture>
                <img
                    class="absolute bottom-0 h-[60px] w-full bg-primary-500 object-cover object-bottom data-[rank='default']:bottom-0 md:bottom-0 md:hidden"
                    src="<?php echo e(asset('frontend/assets/image/giaohang/giao-hang.png')); ?>"
                    alt="Customer ranking" loading="eager" width="500" height="500"
                    srcset="<?php echo e(asset('frontend/assets/image/giaohang/giao-hang.png')); ?>"
                    data-rank="default" decoding="async">
            </picture>

            <div class="hidden h-8 bg-primary-50 md:flex">
                <div class="container relative flex items-center justify-between space-x-6 py-1"
                >
                    <div class="flex gap-3">
                        <div data-state="closed" class="focus-visible:outline-none flex">
                            <div class="flex cursor-pointer items-center gap-1 whitespace-nowrap text-xs"
                            >
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-flow-col gap-4 text-xs">
               <span class="shrink-0 whitespace-nowrap">Hotline
                   <a rel="noopener noreferrer" href="tel:<?php echo e($system['contact_hotline'] ??'092.686.5566'); ?>">
                   <span class="ml-2 font-bold text-primary-500">092.686.5566</span>
                   </a>
               </span>
                        <?php echo $__env->make('frontend.layouts.partials.main-header', ['menuKey' => 'main-header'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
            <div class="md:bg-[var(--background-1)]">
                <div class="mx-auto w-full md:container md:relative md:pb-2 md:pt-3">
                    <div class="flex items-center md:mb-3">
                        <div class="flex w-full flex-col-reverse items-start md:flex-row">
                            <div class="hidden flex-shrink-0 md:flex md:w-[187px] md:justify-center">
                                <a href="/">
                                    <img class="w-auto h-[72px] cursor-pointer"
                                         src="<?php echo e(asset('storage/' . $logo)); ?>"
                                         alt="Tâm việt logo">
                                </a>
                            </div>
                            <?php echo $__env->make('frontend.components.search-box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div id="fixedNav"
                                 class="top-0 z-10 flex w-full min-w-[340px] flex-1 flex-row-reverse gap-3 px-4 py-3 text-right transition-colors md:bg-[var(--background-1)] md:static md:mx-0 md:min-w-[286px] md:flex-row md:pb-0 md:pl-1.5 md:pr-0 md:pt-0 md:mt-4">
                                <?php echo $__env->make('frontend.components.cart-icon-desktop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('frontend.components.header.account-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:bg-[var(--background)]">
                <div class="mx-auto w-full md:container md:relative md:pb-2 md:pt-3">
                    <div class="hidden grid-cols-[187px_1fr] items-center md:grid md:gap-4 lg:gap-4">
                        <?php echo $__env->make('frontend.components.category-nav',['menuKey' => 'main-menu'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('frontend.layouts.partials.menu', ['menuKey' => 'main-menu'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                </div>
            </div>
        </div>
    </nav>
</div>
<?php echo $__env->make('frontend.layouts.partials.mobile-menu',['menuKey' => 'main-menu'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const nav = document.getElementById("mainNav");
            if (!nav) return;
            const mobileOnly = window.matchMedia("(max-width: 767px)");
            const SCROLL_Y = 40;

            function handleScroll() {
                if (!mobileOnly.matches) {
                    nav.classList.remove("fixed-top", "box-search-fixed-top");
                    document.body.classList.remove("has-fixed-header");
                    return;
                }
                if (window.scrollY > SCROLL_Y) {
                    nav.classList.add("fixed-top", "box-search-fixed-top");
                    document.body.classList.add("has-fixed-header");
                } else {
                    nav.classList.remove("fixed-top", "box-search-fixed-top");
                    document.body.classList.remove("has-fixed-header");
                }
            }

            window.addEventListener("scroll", handleScroll, {passive: true});
            window.addEventListener("resize", handleScroll);
            handleScroll();
        });

    </script>
    <script src="<?php echo e(asset('frontend/assets/js/nav-category.js')); ?>"></script>
<?php $__env->stopPush(); ?>








<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/layouts/partials/header.blade.php ENDPATH**/ ?>