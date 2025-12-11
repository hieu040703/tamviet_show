@if (count($relatedPosts))
    <div class="w-full !max-w-[868px] pb-4 md:container md:pb-6">
        <div class="bg-neutral-100 h-3 md:hidden"></div>

        <div class="px-4 md:border-t md:px-0  mb-mobile">
            <h4 class="mb-4 mt-4 text-[20px] font-bold leading-[28px] md:mt-6">
                Các bài viết liên quan
            </h4>

            @php
                $suffix = config('apps.general.suffix', '');
            @endphp
            <div class="md:hidden">
                @foreach($relatedPosts as $item)
                    @php
                        $href  = $item->canonical ? url($item->canonical . $suffix) : '#';
                        $image = $item->image
                            ? asset('storage/' . $item->image)
                            : asset('backend/img/not-found.jpg');
                        $categoryName = optional($item->catalogue)->name;
                    @endphp

                    <div class="flex gap-x-2 border-b py-4 first:pt-0 last:border-b-0 lg:block lg:py-0">
                        <div class="mb-2 aspect-blog-image w-[92px] overflow-hidden lg:w-full">
                            <a href="{{ $href }}">
                                <img
                                    class="aspect-blog-image w-full rounded-sm object-cover"
                                    src="{{ $image }}"
                                    alt="{{ $item->name }}"
                                    loading="lazy"
                                    width="500"
                                    height="500"
                                >
                            </a>
                        </div>

                        <div class="flex-1">
                            @if($categoryName)
                                <a
                                    href="javascript:void(0)"
                                    class="mb-1 flex items-start rounded-sm bg-neutral-800 px-1 py-[2px] text-xs font-medium text-white"
                                >
                                    <div class="[&_a:not(.ignore-css_a)]:text-hyperLink">
                                        {{ $categoryName }}
                                    </div>
                                </a>
                            @endif

                            <a
                                href="{{ $href }}"
                                class="line-clamp-2 text-sm font-semibold first:mb-2"
                            >
                                <div class="[&_a:not(.ignore-css_a)]:text-hyperLink">
                                    {{ $item->name }}
                                </div>
                            </a>

                            <div class="[&_a:not(.ignore-css_a)]:text-hyperLink line-clamp-2 text-sm">
                                <p>{!! \Illuminate\Support\Str::limit(strip_tags($item->description), 200) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- DESKTOP: swiper --}}
            <div class="hidden md:block">
                <div class="relative flex h-full w-full items-center">
                    <div class="swiper custom-swiper-navigation w-full !mx-0 overflow-hidden !px-4 md:!px-0">
                        <div class="swiper-wrapper">
                            @foreach($relatedPosts as $item)
                                @php
                                    $href  = $item->canonical ? url($item->canonical . $suffix) : '#';
                                    $image = $item->image
                                        ? asset('storage/' . $item->image)
                                        : asset('backend/img/not-found.jpg');
                                    $categoryName = optional($item->catalogue)->name;
                                @endphp

                                <div class="swiper-slide mr-4 !w-[187px]">
                                    <div class="flex gap-x-2 border-b py-4 first:pt-0 last:border-b-0 lg:block lg:py-0">
                                        <div class="mb-2 aspect-blog-image w-[92px] overflow-hidden lg:w-full">
                                            <a href="{{ $href }}">
                                                <img
                                                    class="aspect-blog-image w-full rounded-sm object-cover"
                                                    src="{{ $image }}"
                                                    alt="{{ $item->name }}"
                                                    loading="lazy"
                                                    width="500"
                                                    height="500"
                                                >
                                            </a>
                                        </div>

                                        <div class="flex-1">
                                            @if($categoryName)
                                                <a
                                                    href="javascript:void(0)"
                                                    class="mb-1 inline-block rounded-sm bg-neutral-800 px-1 py-[2px] text-xs font-medium text-white"
                                                >
                                                    <div class="[&_a:not(.ignore-css_a)]:text-hyperLink">
                                                        {{ $categoryName }}
                                                    </div>
                                                </a>
                                            @endif

                                            <a
                                                href="{{ $href }}"
                                                class="line-clamp-2 text-sm font-semibold first:mb-2"
                                            >
                                                <div class="[&_a:not(.ignore-css_a)]:text-hyperLink">
                                                    {{ $item->name }}
                                                </div>
                                            </a>

                                            <div class="[&_a:not(.ignore-css_a)]:text-hyperLink line-clamp-2 text-sm">
                                                <p>{!! \Illuminate\Support\Str::limit(strip_tags($item->description), 200) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button
                        data-area="left"
                        data-size="sm"
                        type="button"
                        class="custom-swiper-button-prev relative -mt-14 flex h-10 w-10 justify-center p-[10px] text-sm text-inherit outline-none hover:bg-0 hover:text-primary-500 focus:text-primary-500 focus:ring-primary-300"
                    >
                        <span class="p-icon inline-flex h-8 w-8 max-h-full max-w-full justify-center align-[-0.125em]">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </span>
                    </button>

                    <button
                        data-area="right"
                        data-size="sm"
                        type="button"
                        class="custom-swiper-button-next relative -mt-14 flex h-10 w-10 justify-center border-0 p-[10px] text-sm text-inherit outline-none hover:bg-0 hover:text-primary-500 focus:text-primary-500"
                    >
                        <span class="p-icon inline-flex h-8 w-8 max-h-full max-w-full justify-center align-[-0.125em]">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M17.2137 11.2862L8.21971 2.29524C7.82506 1.90159 7.18567 1.90159 6.79002 2.29524C6.39537 2.68889 6.39537 3.32829 6.79002 3.72194L15.0706 11.9995L6.79102 20.2771C6.39637 20.6707 6.39637 21.3101 6.79102 21.7048C7.18567 22.0984 7.82606 22.0984 8.22071 21.7048L17.2147 12.7139C17.6032 12.3243 17.6032 11.6749 17.2137 11.2862Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@push('scripts')
    <script src="{{ asset('frontend/assets/js/related-posts-swiper.js') }}"></script>
@endpush
