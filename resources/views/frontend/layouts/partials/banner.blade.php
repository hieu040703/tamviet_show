<div class="md:container md:mb-4 home-hero">
    <div class="gid gap-4 md:flex md:aspect-[1200/302]">
        <div class="w-full md:w-[calc(100%-389px-16px)]">
            <div class="relative flex h-full w-full items-center">
                <div
                    class="swiper custom-swiper-navigation w-full banner aspect-banner-image-mobile h-full overflow-hidden md:rounded-xl">
                    <div class="swiper-wrapper">
                        {{-- SLIDE 1 --}}
                        @if(!empty($homeMainBanner))
                            @foreach($homeMainBanner->items as $MainBannerItem)
                                <div class="swiper-slide relative h-full w-full">
                                    <picture>
                                        <source media="(max-width:767px)"
                                                srcset="{{asset($MainBannerItem->image) ? asset('storage/' .$MainBannerItem->image)  : asset('frontend/assets/image/banner/banner-1.png') }}">
                                        <img class="h-full w-full md:rounded-xl md:object-[unset]"
                                             src="{{asset($MainBannerItem->image) ? asset('storage/' .$MainBannerItem->image)  : asset('frontend/assets/image/banner/banner-1.png') }}"
                                             alt="{{$MainBannerItem->name ?? ''}}"
                                             loading="eager">
                                    </picture>
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide relative h-full w-full">
                                <picture>
                                    <source media="(max-width:767px)"
                                            srcset="{{asset('frontend/assets/image/banner/banner-1.png') }}">
                                    <img class="h-full w-full md:rounded-xl md:object-[unset]"
                                         src="{{asset('frontend/assets/image/banner\banner-1.png')}}"
                                         loading="eager">
                                </picture>
                            </div>
                        @endif
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div
                            class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"></div>
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
                    <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-8 h-8">
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

        <div class="hidden w-full grid-rows-2 gap-4 md:grid md:w-[389px]">
            @if(!empty($homeRightBanner) && $homeRightBanner->items->count())
                @foreach($homeRightBanner->items as $rightBannerItem)
                    <div class="h-full w-full">
                        <img
                            class="h-full w-full object-[unset] md:rounded-xl"
                            src="{{ !empty($rightBannerItem->image)
                            ? asset('storage/'.$rightBannerItem->image)
                            : asset('frontend/assets/image/banner/right/banner-1.png') }}"
                            alt="{{ $rightBannerItem->name ?? '' }}"
                            loading="lazy"
                            width="500"
                            height="500"
                        >
                    </div>
                @endforeach
            @else
                <div class="h-full w-full">
                    <img
                        class="h-full w-full object-[unset] md:rounded-xl"
                        src="{{ asset('frontend/assets/image/banner/banner-1.png') }}"
                        alt="Banner mặc định 1"
                        loading="lazy"
                        width="500"
                        height="500"
                    >
                </div>
                <div class="h-full w-full">
                    <img
                        class="h-full w-full object-[unset] md:rounded-xl"
                        src="{{ asset('frontend/assets/image/banner/banner-2.png') }}"
                        alt="Banner mặc định 2"
                        loading="lazy"
                        width="500"
                        height="500"
                    >
                </div>
            @endif
        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper === 'undefined') {
            console.warn('Swiper is not loaded');
            return;
        }
        const bannerEl = document.querySelector('.banner.aspect-banner-image-mobile');
        if (!bannerEl) return;
        const slides = bannerEl.querySelectorAll('.swiper-wrapper .swiper-slide');
        const totalSlides = slides.length;
        const wrapper = bannerEl.closest('.relative') || document;
        const customPrevBtn = wrapper.querySelector('.custom-swiper-button-prev');
        const customNextBtn = wrapper.querySelector('.custom-swiper-button-next');
        if (totalSlides <= 1) {
            if (customPrevBtn) customPrevBtn.classList.add('hidden');
            if (customNextBtn) customNextBtn.classList.add('hidden');
        }

        function updateNavState(swiper) {
            if (!customPrevBtn || !customNextBtn) return;
            const isBeginning = swiper.isBeginning;
            const isEnd = swiper.isEnd;

            customPrevBtn.disabled = isBeginning;
            customNextBtn.disabled = isEnd;

            customPrevBtn.classList.toggle('opacity-50', isBeginning);
            customPrevBtn.classList.toggle('pointer-events-none', isBeginning);

            customNextBtn.classList.toggle('opacity-50', isEnd);
            customNextBtn.classList.toggle('pointer-events-none', isEnd);
        }

        const swiper = new Swiper(bannerEl, {
            slidesPerView: 1,
            loop: false,
            watchOverflow: true,
            autoplay: false,
            pagination: {
                el: bannerEl.querySelector('.swiper-pagination'),
                clickable: true,
            },
            navigation: {
                prevEl: customPrevBtn,
                nextEl: customNextBtn,
            },
            on: {
                init(swiperInstance) {
                    if (swiperInstance.autoplay && swiperInstance.autoplay.stop) {
                        swiperInstance.autoplay.stop();
                    }
                    updateNavState(swiperInstance);
                },
                slideChange(swiperInstance) {
                    updateNavState(swiperInstance);
                }
            },
        });
    });
</script>
