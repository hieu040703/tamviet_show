@php
    $block  = $homeProductCategories ?? [];
    $widget = $block['widget'] ?? null;
    $items  = collect($block['items'] ?? []);
@endphp

@if($widget && $items->isNotEmpty())
    <div>
        <div class="pb-4 md:container home-hero">
            <div class="block-title flex items-center space-x-1 p-4 md:px-0">
                <div class="flex flex-1">
                    <h4 class="font-semibold line-clamp-1 text-base md:text-[20px]">
                        {{ $widget->name ?? 'Danh mục sản phẩm' }}
                    </h4>
                </div>
            </div>
            <div class="md:-ml-1">
                <div class="relative flex h-full w-full items-center">
                    <div
                        class="swiper swiper-horizontal custom-swiper-navigation w-full product-playlist !px-4 sm:rounded-lg md:!px-1"
                    >
                        <div class="swiper-wrapper">
                            @foreach($items as $item)
                                @php
                                    $image = $item->image
                                        ? asset('storage/'.$item->image)
                                        : asset('backend/img/not-found.jpg');
                                @endphp

                                <div class="swiper-slide !h-auto !w-[178px] pb-[1px] md:!w-[202.6px]">
                                    <div class="mr-[10px] md:mr-4 h-full relative !max-h-[460px]">
                                        <div class="product-card flex h-full flex-col">
                                            <div
                                                class="flex h-full flex-1 flex-col overflow-hidden rounded-lg border bg-white pb-[1px] shadow-sm">
                                                <div class="product-card-image relative">
                                                    <a href="{{ router_link('products', $item->id) }}">
                                                        <img
                                                            class="max-h-[100%] max-w-[100%] object-contain"
                                                            src="{{ $image }}"
                                                            alt="{{ $item->name }}"
                                                            width="500"
                                                            height="500"
                                                            loading="lazy"
                                                            decoding="async"
                                                        >
                                                        <span
                                                            class="absolute bottom-0 left-0 flex h-[26px] w-full"
                                                        ></span>
                                                    </a>
                                                </div>
                                                <div class="flex flex-1 flex-col p-2 font-medium">
                                                    <a href="{{ router_link('products', $item->id) }}">
                                                        <h3 class="line-clamp-2 h-10 text-sm font-semibold">
                                                            {{ $item->name }}
                                                        </h3>
                                                    </a>
                                                    <div class="flex flex-1 flex-col justify-end">
                                                        <div class="flex items-end justify-center">
                                                            <button
                                                                type="button"
                                                                data-open-product-modal
                                                                data-product-id="{{ $item->id }}"
                                                                data-product-name="{{ $item->name }}"
                                                                data-product-image="{{ $image }}"
                                                                class="btn-choose-product relative z-10 flex justify-center items-center
                                                                   w-full h-9 mt-2 px-4 py-2 text-sm font-semibold text-white
                                                                   bg-primary-500 border-0 rounded-lg outline-none
                                                                   hover:bg-primary-600 focus:ring-primary-300">
                                                                <span>Chọn sản phẩm</span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <button
                        data-area="left"
                        data-size="sm"
                        type="button"
                        class="relative flex justify-center items-center h-10 w-10 p-[10px] text-sm font-semibold text-inherit bg-transparent border-0 outline-none hover:text-primary-500 focus:text-primary-500 custom-swiper-button-prev"
                    >
                        <span class="p-icon inline-flex justify-center max-h-full max-w-full w-8 h-8 align-[-0.125em]">
                            <svg viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                    fill="currentColor"
                                ></path>
                            </svg>
                        </span>
                    </button>
                    <button
                        data-area="right"
                        data-size="sm"
                        type="button"
                        class="relative flex justify-center items-center h-10 w-10 p-[10px] text-sm font-semibold text-inherit bg-transparent border-0 outline-none hover:text-primary-500 focus:text-primary-500 custom-swiper-button-next"
                    >
                        <span class="p-icon inline-flex justify-center max-h-full max-w-full w-8 h-8 align-[-0.125em]">
                            <svg viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.2137 11.2862L8.21971 2.29524C7.82506 1.90159 7.18567 1.90159 6.79002 2.29524C6.39537 2.68889 6.39537 3.32829 6.79002 3.72194L15.0706 11.9995L6.79102 20.2771C6.39637 20.6707 6.39637 21.3101 6.79102 21.7048C7.18567 22.0984 7.82606 22.0984 8.22071 21.7048L17.2147 12.7139C17.6032 12.3243 17.6032 11.6749 17.2137 11.2862Z"
                                    fill="currentColor"
                                ></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-neutral-100 h-3"></div>
    </div>
@endif

