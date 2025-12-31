@if(!empty($menu) && $menu->items->count())
    <div class="relative text-sm text-white js-category-nav">
        <div class="swiper category-playlist w-full swiper-backface-hidden">
            <div class="swiper-wrapper">
                @foreach($menu->items as $item)
                    <div class="swiper-slide !w-fit md:mr-4 lg:mr-6">
                        <a class="flex items-center"
                           href="{{ router_link_from_canonical(optional($item->router)->canonical) }}">
                            <span class="text-base font-medium">
                                {{ $item->name }}
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

