@extends('frontend.layout')

@section('content')
    <div class="z-20 mx-auto bg-neutral-100">
        <div class="bg-white pt-11 md:pb-0 md:pt-4">
            @include('frontend.components.breadcrumb', ['items' => $breadcrumb ?? []])
            <div class="bg-neutral-100"></div>
            <div id="brand-page"
                 class="bg-white pb-[92px] pt-4 md:pb-0 md:pt-0 mt-30"
                 data-filter-url="{{ route('ajax.brand.filter', ['id' => $brand->id]) }}"
                 data-load-more-url="{{ route('ajax.brand.loadMore', ['id' => $brand->id]) }}"
                 data-initial-limit="{{ (int) $perPage }}">
                <div
                    class="container relative grid grid-cols-1 items-start gap-3 pb-4 md:grid-cols-[calc(193rem/16),1fr] mt-5">
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
                                     style="position: relative; --radix-scroll-area-corner-width: 0px; --radix-scroll-area-corner-height: 0px;">
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
                                                            <p class="text-base font-semibold md:text-sm">Danh mục</p>
                                                        </div>

                                                        <div class="relative flex">
                                                            <input
                                                                id="category-search"
                                                                class="w-full border text-neutral-900 rounded-lg focus:ring-neutral-500 focus:border-neutral-700 outline-none p-2.5 h-9 truncate border-neutral-700 text-base font-medium placeholder:text-neutral-700 md:text-sm"
                                                                placeholder="Nhập tên danh mục"
                                                                inputmode="text"
                                                                type="text"
                                                                value="">
                                                        </div>

                                                        <div
                                                            class="items-center col-span-1 grid grid-cols-2 gap-2.5 md:grid-cols-1 md:gap-4"
                                                            id="category-list">
                                                            @foreach($categories as $category)
                                                                <label
                                                                    class="group cursor-pointer items-start w-full grid md:flex"
                                                                    data-name="{{ mb_strtolower($category->name) }}">
                                                <span class="whitespace-nowrap">
                                                    <input
                                                        class="js-filter-category peer absolute opacity-0"
                                                        type="checkbox"
                                                        value="{{ $category->id }}">
                                                    <span
                                                        class="rounded items-center justify-center border border-neutral-300 text-white/100 group-hover:border-primary-500 cursor-pointer peer-checked:bg-primary-500 peer-checked:border-primary-500 before:contents[' '] before:h-[6px] before:-rotate-45 before:w-[10px] before:border-white before:border-2 before:border-r-0 before:border-t-0 before:mb-[2px] peer-disabled:bg-neutral-600 peer-disabled:border-neutral-600 w-4 h-4 hidden md:flex md:mt-[2px]">
                                                    </span>
                                                </span>
                                                                    <span
                                                                        class="text-sm text-neutral-900 border m-0 md:ms-2 w-full py-2.5 px-2 bg-neutral-100 rounded-sm truncate md:bg-transparent md:p-0 flex justify-center md:block md:border-none md:rounded-none">
                                                    <div class="truncate">{{ $category->name }}</div>
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
                    <div class="flex flex-col space-y-4">
                        <div
                            class="grid grid-cols-[100px,1fr] items-start gap-4 rounded-lg bg-white p-4 shadow-yPlus md:grid-cols-[136px,1fr]">
                            <div
                                class="relative h-[calc(100rem/16)] w-[calc(100rem/16)] overflow-hidden rounded-[10px] shadow-[0px_5.263157367706299px_21.052629470825195px_0px_#0000001F] md:h-[calc(136rem/16)] md:w-[calc(136rem/16)]">
                                <img class="h-full w-full object-cover"
                                     src="{{$brand->image ? asset('storage/'.$brand->image) :  asset('backend/img/not-found.jpg')}}"
                                     alt="GSK OTC" loading="lazy" sizes="(max-width: 768px) 13rem, 13rem"></div>
                            <div class="grid gap-1.5 md:gap-4 md:pt-1">
                                <h1 class="text-[20px] font-bold leading-[28px] truncate md:text-[24px] md:leading-[32px]">
                                    {{$brand->name ?? ''}}
                                </h1>
                                <div
                                    class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink line-clamp-2 text-sm md:line-clamp-none md:text-base">
                                    {!! $brand->description ?? '' !!}
                                </div>
                                <div class="block md:hidden"></div>
                            </div>
                        </div>
                        <div
                            class="sticky grid grid-flow-col items-start justify-start gap-3 md:z-0 top-[44px] z-[9] -m-4 bg-white px-4 py-4 md:relative md:top-0 md:m-0 md:mt-[1px] md:px-0 md:pb-2 md:ps-0 md:pt-6">
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
    </div>
@endsection

@push('styles')
    <style>
        .js-sort-btn.active {
            box-shadow: 0 0 0 1px rgba(37, 99, 235, 0.15);
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('frontend/assets/js/brand-filter.js') }}"></script>
@endpush
