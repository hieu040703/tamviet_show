@extends('frontend.layout')

@section('content')
    <div id="mainContent" class="z-20 mx-auto bg-white pt-11 md:pt-0">
        <div class="hidden md:block">
            <div class="container flex flex-col bg-white md:pt-6">

                <div
                    class="fixed left-0 top-0 z-10 h-11 w-full bg-white block md:static md:z-auto md:block md:h-auto md:w-auto">
                    <div class="z-50 grid w-full content-start gap-4 bg-white px-4 py-2.5 md:py-0 md:px-0 md:z-auto">
                        <div class="flex">
                            <div class="flex w-6 items-center md:hidden">
                                <button data-size="sm" type="button"
                                        class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0 text-neutral-900">
                                    <span
                                        class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                        <svg viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <div class="grid flex-1 items-center text-center md:text-start">
                                <h1
                                    class="text-[24px] font-bold leading-[32px] flex-1 max-md:text-base max-md:font-semibold md:flex">
                                    Danh mục
                                </h1>
                            </div>
                            <div class="md:hidden w-10"></div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 pb-4 pt-4 md:grid-cols-[repeat(auto-fill,136px)] md:pb-6">
                    @forelse(($categories ?? []) as $cate)
                        @php
                            $cateImage = $cate->icon ? asset('storage/' . $cate->icon) : asset('backend/img/not-found.jpg');
                            $cateLink = $cate->link ?? (function_exists('router_link') ? router_link('categories', $cate->id) : '#');
                        @endphp
                        <a
                            class="grid w-fit content-start justify-center justify-items-center gap-2"
                            href="{{ $cateLink }}"
                        >
                            <span
                                class="relative h-[calc(76rem/16)] w-[calc(76rem/16)] overflow-hidden rounded-full border border-primary-50 md:h-[calc(136rem/16)] md:w-[calc(136rem/16)]">
                                <img
                                    class="h-full w-full object-cover"
                                    src="{{ $cateImage }}"
                                    alt="{{ $cate->name }}"
                                    loading="lazy"
                                    width="500"
                                    height="500"
                                >
                            </span>
                            <p title="{{ $cate->name }}"
                               class="line-clamp-3 text-center text-sm font-medium text-neutral-900 md:line-clamp-2 md:text-base">
                                {{ $cate->name }}
                            </p>
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>

        <div class="bg-neutral-100 h-3 hidden md:block"></div>

        <div id="category-page"
             class="pb-[92px] pt-4 md:pb-0 md:pt-0"
             data-filter-url="{{ route('ajax.category.filter.all') }}"
             data-load-more-url="{{ route('ajax.category.loadMore.all') }}"
             data-initial-limit="{{ (int) $perPage }}">
            <div
                class="container relative grid grid-cols-1 items-start gap-3 pb-4 md:grid-cols-[calc(193rem/16),1fr]">
                <form id="search-filter-bar"
                      class="md:sticky md:top-0 md:mb-10 md:pt-3.5 md:transition-all hidden md:grid md:first:[&>div]:mt-0 md:first:[&>div]:pt-4"
                      style="--header-position-start-sticky: 0px;">
                    <div
                        class="hidden md:grid z-[9] -ms-3 -mt-[calc(30rem/16)] grid-flow-col items-center justify-between gap-3 bg-white pb-4 pe-3 ps-3 pt-[calc(30rem/16)] md:z-0">
                        <p class="text-normal font-semibold text-neutral-900">Bộ lọc</p>
                        <button
                            class="relative justify-center border-0 bg-transparent text-sm font-normal text-hyperLink outline-none md:hover:text-primary-600 md:text-base inline"
                            type="button"
                            id="btn-filter-reset">
                            Thiết lập lại
                        </button>
                    </div>

                    <div class="grid gap-0">
                        <div class="bg-neutral-100 me-2 hidden h-[1px] md:block"></div>
                        <div class="grid md:relative">
                            <div dir="ltr"
                                 class="relative overflow-hidden h-full max-h-[calc(60dvh)] pb-2 pe-3 md:max-h-[calc(100dvh-var(--header-position-start-sticky)-52px)] [&>div]:relative"
                                 style="position: relative; --radix-scroll-area-corner-width: 0px; --radix-scroll-area-corner-height: 0px; --header-position-start-sticky: 0px;">
                                <style>[data-radix-scroll-area-viewport] {
                                        scrollbar-width: none;
                                        -ms-overflow-style: none;
                                        -webkit-overflow-scrolling: touch;
                                    }

                                    [data-radix-scroll-area-viewport]::-webkit-scrollbar {
                                        display: none
                                    }</style>
                                <div data-radix-scroll-area-viewport="" class="h-full w-full rounded-[inherit]"
                                     style="overflow: hidden scroll;">
                                    <div style="min-width: 100%; display: table;">
                                        <div class="grid gap-4 py-6 md:pt-4">
                                            <div class="space-y-2">
                                                <div class="grid gap-3 md:gap-4">
                                                    <div class="flex items-start justify-between">
                                                        <p class="text-base font-semibold md:text-sm">Thương hiệu</p>
                                                    </div>

                                                    <div class="relative flex">
                                                        <input
                                                            id="brand-search"
                                                            class="w-full border text-neutral-900 rounded-lg focus:ring-neutral-500 focus:border-neutral-700 outline-none p-2.5 h-9 truncate border-neutral-700 text-base font-medium placeholder:text-neutral-700 md:text-sm"
                                                            placeholder="Nhập tên thương hiệu"
                                                            inputmode="text"
                                                            type="text"
                                                            value="">
                                                    </div>

                                                    <div
                                                        class="items-center col-span-1 grid grid-cols-2 gap-2.5 md:grid-cols-1 md:gap-4"
                                                        id="brand-list">
                                                        @foreach($brands as $brand)
                                                            <label
                                                                class="group cursor-pointer items-start w-full grid md:flex"
                                                                data-name="{{ mb_strtolower($brand->name) }}">
                                                            <span class="whitespace-nowrap">
                                                                <input
                                                                    class="js-filter-brand peer absolute opacity-0"
                                                                    type="checkbox"
                                                                    value="{{ $brand->id }}">
                                                                <span
                                                                    class="rounded items-center justify-center border border-neutral-300 text-white/100 group-hover:border-primary-500 cursor-pointer peer-checked:bg-primary-500 peer-checked:border-primary-500 before:contents[' '] before:h-[6px] before:-rotate-45 before:w-[10px] before:border-white before:border-2 before:border-r-0 before:border-t-0 before:mb-[2px] peer-disabled:bg-neutral-600 peer-disabled:border-neutral-600 w-4 h-4 hidden md:flex md:mt-[2px]">
                                                                </span>
                                                            </span>
                                                                <span
                                                                    class="text-sm text-neutral-900 border m-0 md:ms-2 w-full py-2.5 px-2 bg-neutral-100 rounded-sm truncate md:bg-transparent md:p-0 flex justify-center md:block md:border-none md:rounded-none">
                                                                <div class="truncate">{{ $brand->name }}</div>
                                                            </span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @include('frontend.layouts.partials.header-mobile',['model' => $title])
                <div class="flex flex-col space-y-4">
                    <div
                        class="sticky grid grid-flow-col items-start justify-start gap-3 md:z-0 md:-ms-3 md:-mt-4 md:me-0 md:pt-6 top-[44px] z-[9] -m-4 bg-white px-4 py-4 md:relative md:top-0 md:!m-0 md:px-0 md:pb-2 md:ps-0">
                        <p class="hidden pt-2 text-sm font-medium text-neutral-900 md:block">Sắp xếp theo: </p>
                        <div class="relative overflow-hidden">
                            <div
                                class="swiper swiper-horizontal swiper-free-mode sort-option-playlist w-full swiper-backface-hidden">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide mr-2 !w-fit md:mr-3">
                                        <div>
                                            <button data-size="sm" type="button"
                                                    class="js-sort-btn relative flex justify-center outline-none font-semibold !bg-white bg-white border border-solid text-sm px-4 py-2 h-9 items-center rounded-lg gap-1 border-neutral-700 text-neutral-700"
                                                    data-sort="name_asc">
                                                <span>Tên A-Z</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="swiper-slide mr-2 !w-fit md:mr-3">
                                        <div>
                                            <button data-size="sm" type="button"
                                                    class="js-sort-btn relative flex justify-center outline-none font-semibold !bg-white bg-white border border-solid text-sm px-4 py-2 h-9 items-center rounded-lg gap-1 border-neutral-700 text-neutral-700"
                                                    data-sort="name_desc">
                                                <span>Tên Z-A</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-prev swiper-button-disabled swiper-button-lock"></div>
                                <div class="swiper-button-next swiper-button-disabled swiper-button-lock"></div>
                            </div>
                        </div>
                    </div>

                    <div id="product-list-wrapper">
                        @include('frontend.components.product-list', ['products' => $products])
                    </div>

                    @if($hasMore)
                        <div class="flex justify-center pt-4" id="loadMoreWrapper">
                            <button id="loadMoreBtn"
                                    data-offset="{{ $perPage }}"
                                    class="px-4 py-2 border border-primary-500 text-primary-500 rounded-lg text-sm md:h-12 md:w-[256px] md:text-base">
                                Xem thêm
                            </button>
                        </div>
                    @else
                        <div id="loadMoreWrapper" class="hidden"></div>
                    @endif
                </div>
            </div>
            <a class="fixed right-0 z-[50] m-5 flex h-12 w-12 cursor-pointer items-center justify-center rounded-full bg-primary-500 md:h-14 md:w-14 !h-0 !w-0 bottom-16"
               style="transition: 0.3s;">
                <span
                    class="p-icon align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6 mb-1 text-white hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M11.286 7.292l-8.99 8.994a1.013 1.013 0 000 1.43 1.008 1.008 0 001.426 0l8.277-8.28 8.278 8.279a1.009 1.009 0 001.428 0 1.013 1.013 0 000-1.43l-8.991-8.994a1.019 1.019 0 00-1.428.001z"></path>
                    </svg>
                </span>
            </a>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('frontend/assets/js/category-filter-all.js') }}"></script>
@endpush
