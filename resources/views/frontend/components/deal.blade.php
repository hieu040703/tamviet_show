@for($j=0;$j <=3; $j++)
    <div data-collection-code="top-san-ban-chay-toan-quoc">
        <div class="pb-4 md:container">
            <div>
                <div class="block-title flex items-center space-x-1 p-4 md:px-0">
                    <div class="flex flex-1">
                        <h4 class="font-semibold line-clamp-1 text-base md:text-[20px]">
                            Top bán chạy toàn quốc
                        </h4>
                    </div>
                    <div>
                        <a class="relative flex justify-center border-0 bg-transparent text-sm font-normal text-hyperLink outline-none md:hover:text-primary-600 md:text-base"
                           href="/collection/top-san-ban-chay-toan-quoc">
                            Xem thêm
                        </a>
                    </div>
                </div>
            </div>

            <div>
                <div class="md:-ml-1">
                    <div class="relative flex h-full w-full items-center">
                        <div
                            class="swiper swiper-horizontal custom-swiper-navigation w-full product-playlist !px-4 sm:rounded-lg md:!px-1">
                            <div class="swiper-wrapper">
                                @for ($i = 0; $i < 15; $i++)
                                    <div class="swiper-slide !h-auto !w-[178px] pb-[1px] md:!w-[202.6px]">
                                        <div class="mr-[10px] md:mr-4 h-full relative !max-h-[460px]">
                                            <div class="product-card flex h-full flex-col">
                                                <div
                                                    class="flex h-full flex-1 flex-col overflow-hidden rounded-lg border bg-white pb-[1px] shadow-sm">
                                                    <div class="product-card-image">
                                                        <a href="#">
                                                            <img class="max-h-[100%] max-w-[100%] object-contain"
                                                                 src="https://production-cdn.pharmacity.io/digital/256x256/plain/e-com/images/product/20250522031736-0-OL00037.jpg?versionId=68Y6wJisC630yTtV_LxjvhsYEh7NpDhf"
                                                                 alt="Sản phẩm top bán chạy {{ $i+1 }}"
                                                                 width="500" height="500">
                                                            <span
                                                                class="absolute bottom-0 left-0 flex h-[26px] w-full"></span>
                                                        </a>
                                                    </div>
                                                    <div class="flex flex-1 flex-col p-2 font-medium">
                                                        <a href="#">
                                                            <div>
                                                                <h3 class="line-clamp-2 h-10 text-sm font-semibold">
                                                                    Sản phẩm top bán chạy {{ $i+1 }}
                                                                </h3>
                                                            </div>
                                                        </a>
                                                        <div class="my-1 items-center whitespace-nowrap">
                                                            <del class="block h-5 text-sm font-semibold text-neutral-600">
                                                                200.000&nbsp;₫
                                                            </del>
                                                            <span
                                                                class="mt-[2px] block h-6 text-base font-bold text-primary-500">
                                                            160.000&nbsp;₫/Hộp
                                                        </span>
                                                        </div>
                                                        <div class="flex flex-1 flex-col justify-end">
                                                            <div class="flex items-end justify-center">
                                                                <button type="button"
                                                                        class="relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 w-full text-sm px-4 py-2 h-9 items-center rounded-lg mt-2">
                                                                    <span>Chọn sản phẩm</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>

                        <button data-area="left" data-size="sm" type="button"
                                class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm text-inherit border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 custom-swiper-button-prev h-10 w-10 p-[10px]">
                        <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-8 h-8">
                            <svg viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                        </button>

                        <button data-area="right" data-size="sm" type="button"
                                class="relative flex justify-center outline-none font-semibold border-neutral-200 text-sm bg-transparent data-[size=sm]:text-sm text-inherit border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 custom-swiper-button-next h-10 w-10 p-[10px]">
                        <span
                            class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-8 h-8">
                            <svg viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.2137 11.2862L8.21971 2.29524C7.82506 1.90159 7.18567 1.90159 6.79002 2.29524C6.39537 2.68889 6.39537 3.32829 6.79002 3.72194L15.0706 11.9995L6.79102 20.2771C6.39637 20.6707 6.39637 21.3101 6.79102 21.7048C7.18567 22.0984 7.82606 22.0984 8.22071 21.7048L17.2147 12.7139C17.6032 12.3243 17.6032 11.6749 17.2137 11.2862Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <div class="bg-neutral-100 h-3"></div>
    </div>
@endfor

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productPlaylists = document.querySelectorAll('.product-playlist');

        function updateButtons(swiper, el, customPrevBtn, customNextBtn) {
            const prevBtn = el.querySelector('.swiper-button-prev');
            const nextBtn = el.querySelector('.swiper-button-next');

            const canScroll = swiper.slides.length > swiper.params.slidesPerView;
            const showLeft = canScroll && !swiper.isBeginning;
            const showRight = canScroll && !swiper.isEnd;

            [prevBtn, customPrevBtn].forEach(function (btn) {
                if (!btn) return;
                if (showLeft) btn.classList.remove('hidden');
                else btn.classList.add('hidden');
            });

            [nextBtn, customNextBtn].forEach(function (btn) {
                if (!btn) return;
                if (showRight) btn.classList.remove('hidden');
                else btn.classList.add('hidden');
            });
        }

        productPlaylists.forEach(function (el) {
            const wrapper = el.closest('[data-collection-code="top-san-ban-chay-toan-quoc"]');
            const customNextBtn = wrapper ? wrapper.querySelector('.custom-swiper-button-next') : null;
            const customPrevBtn = wrapper ? wrapper.querySelector('.custom-swiper-button-prev') : null;

            const swiper = new Swiper(el, {
                slidesPerView: 2,
                spaceBetween: 10,
                navigation: {
                    nextEl: el.querySelector('.swiper-button-next'),
                    prevEl: el.querySelector('.swiper-button-prev'),
                },
                breakpoints: {
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 12,
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 14,
                    },
                    1024: {
                        slidesPerView: 6,
                        spaceBetween: 16,
                    },
                },
                on: {
                    init: function (sw) {
                        updateButtons(sw, el, customPrevBtn, customNextBtn);
                    },
                    slideChange: function (sw) {
                        updateButtons(sw, el, customPrevBtn, customNextBtn);
                    },
                    resize: function (sw) {
                        updateButtons(sw, el, customPrevBtn, customNextBtn);
                    },
                },
            });

            if (customNextBtn) {
                customNextBtn.addEventListener('click', function () {
                    swiper.slideNext();
                });
            }

            if (customPrevBtn) {
                customPrevBtn.addEventListener('click', function () {
                    swiper.slidePrev();
                });
            }
        });
    });
</script>
