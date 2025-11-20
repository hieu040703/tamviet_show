@if(!empty($menu) && $menu->items->count())
    <div class="relative text-sm text-white js-category-nav">
        <div class="swiper category-playlist w-full swiper-backface-hidden">
            <div class="swiper-wrapper">
                @foreach($menu->items as $item)
                    @php
                        @endphp
                    <div class="swiper-slide !w-fit md:mr-3 lg:mr-5">
                        <a class="flex items-center"
                           href="{{ router_link_from_canonical(optional($item->router)->canonical) }}">
                            <span class="text-base font-medium">
                                {{ $item->name }}
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
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
                <svg viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.2137 11.2862L8.21971 2.29524C7.82506 1.90159 7.18567 1.90159 6.79002 2.29524C6.39537 2.68889 6.39537 3.32829 6.79002 3.72194L15.0706 11.9995L6.79102 20.2771C6.39637 20.6707 6.39637 21.3101 6.79102 21.7048C7.18567 22.0984 7.82606 22.0984 8.22071 21.7048L17.2147 12.7139C17.6032 12.3243 17.6032 11.6749 17.2137 11.2862Z"
                        fill="currentColor"/>
                </svg>
            </span>
        </button>
    </div>
@endif
