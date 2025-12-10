<?php if(!empty($menu) && $menu->items->count()): ?>
    <div class="relative text-sm text-white js-category-nav">
        <div class="swiper category-playlist w-full swiper-backface-hidden">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $menu->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide !w-fit md:mr-3 lg:mr-5">
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
        <button
            type="button"
            class="js-category-overlay-prev
                   outline-none font-semibold text-sm border-0 hover:bg-0
                   absolute top-1/2 -translate-y-1/2 z-[1]
                   hidden h-5 py-[2px] px-0 w-10 bg-transparent
                   md:flex text-white hover:text-white focus:text-white
                   left-0 justify-start bg-gradient-to-r
                   from-primary-500 via-primary-500/90 to-transparent">
            <span class="p-icon inline-flex align-[-0.125em] max-h-full max-w-full w-6 h-6 rotate-180 justify-end">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.2137 11.2862L8.21971 2.29524C7.82506 1.90159 7.18567 1.90159 6.79002 2.29524C6.39537 2.68889 6.39537 3.32829 6.79002 3.72194L15.0706 11.9995L6.79102 20.2771C6.39637 20.6707 6.39637 21.3101 6.79102 21.7048C7.18567 22.0984 7.82606 22.0984 8.22071 21.7048L17.2147 12.7139C17.6032 12.3243 17.6032 11.6749 17.2137 11.2862Z"
                        fill="currentColor"/>
                </svg>
            </span>
        </button>
        <button
            type="button"
            class="js-category-overlay-next
                   outline-none font-semibold text-sm border-0 hover:bg-0
                   absolute top-1/2 -translate-y-1/2 z-[1]
                   hidden h-5 py-[2px] px-0 w-10 bg-transparent
                   md:flex text-white hover:text-white focus:text-white
                   right-0 justify-end bg-gradient-to-l
                   from-primary-500 via-primary-500/90 to-transparent">
            <span class="p-icon inline-flex max-h-full max-w-full w-6 h-6 justify-end">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.2137 11.2862L8.21971 2.29524C7.82506 1.90159 7.18567 1.90159 6.79002 2.29524C6.39537 2.68889 6.39537 3.32829 6.79002 3.72194L15.0706 11.9995L6.79102 20.2771C6.39637 20.6707 6.39637 21.3101 6.79102 21.7048C7.18567 22.0984 7.82606 22.0984 8.22071 21.7048L17.2147 12.7139C17.6032 12.3243 17.6032 11.6749 17.2137 11.2862Z"
                        fill="currentColor"/>
                </svg>
            </span>
        </button>
    </div>
<?php endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper === 'undefined') return;
        var nav = document.querySelector('.js-category-nav');
        if (!nav) return;
        var el = nav.querySelector('.category-playlist');
        if (!el) return;
        var customPrevBtn = nav.querySelector('.js-category-overlay-prev');
        var customNextBtn = nav.querySelector('.js-category-overlay-next');
        var slides = el.querySelectorAll('.swiper-wrapper .swiper-slide');
        var totalSlides = slides.length;
        if (totalSlides <= 1) {
            if (customPrevBtn) customPrevBtn.classList.add('swiper-nav-hidden');
            if (customNextBtn) customNextBtn.classList.add('swiper-nav-hidden');
        }

        function updateNav(swiper) {
            if (!customPrevBtn || !customNextBtn) return;
            customPrevBtn.classList.toggle('swiper-nav-hidden', swiper.isBeginning);
            customNextBtn.classList.toggle('swiper-nav-hidden', swiper.isEnd);
        }

        var swiper = new Swiper(el, {
            slidesPerView: 'auto',
            spaceBetween: 16,
            loop: false,
            watchOverflow: true,
            autoplay: false,
            navigation: {
                prevEl: customPrevBtn,
                nextEl: customNextBtn
            },
            on: {
                init: function (sw) {
                    updateNav(sw);
                },
                slideChange: function (sw) {
                    updateNav(sw);
                }
            }
        });
    });
</script>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/layouts/partials/menu.blade.php ENDPATH**/ ?>