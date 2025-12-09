@php
    $album = is_array($product->album ?? null) ? $product->album : (array) $product->album;
    $images = count($album) ? $album : [];
    if (!count($images) && !empty($product->image)) {
        $images = [$product->image];
    }
    $totalImages = count($images);
@endphp

<div>
    <div class="relative aspect-square overflow-y-hidden">
        <div class="relative flex h-full w-full items-center">
            <div
                class="swiper custom-swiper-navigation w-full product-media-slide"
                id="product-main-media"
            >
                <div class="swiper-wrapper">
                    @if($totalImages)
                        @foreach($images as $index => $img)
                            <div class="swiper-slide relative cursor-pointer">
                                <img
                                    class="h-full w-full"
                                    src="{{ asset('storage/'.$img) }}"
                                    alt="{{ $product->name }} - {{ $index+1 }}"
                                    loading="lazy"
                                >
                                <div class="absolute bottom-0 z-[1] flex h-12 w-full md:h-[54px]"></div>
                            </div>
                        @endforeach
                    @else
                        <div class="swiper-slide relative cursor-pointer">
                            <img
                                class="h-full w-full"
                                src="{{ asset('backend/img/not-found.jpg') }}"
                                alt="{{ $product->name }}"
                                loading="lazy"
                            >
                            <div class="absolute bottom-0 z-[1] flex h-12 w-full md:h-[54px]"></div>
                        </div>
                    @endif
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <span
            class="absolute bottom-3 right-4 z-[1] rounded-sm bg-neutral-700 px-1.5 py-0.5 text-xs text-white md:hidden product-media-counter">
            {{ max($totalImages,1) > 1 ? '1/'.$totalImages : '' }}
        </span>
    </div>

    <div class="mt-3 hidden md:block">
        <div class="relative flex h-full w-full items-center">
            <div
                class="swiper swiper-horizontal swiper-free-mode custom-swiper-navigation w-full product-media-slide-thumbnail swiper-thumbs"
                id="product-thumb-media"
            >
                <div class="swiper-wrapper">
                    @if($totalImages)
                        @foreach($images as $index => $img)
                            <div class="swiper-slide relative mr-3 aspect-square !w-[20%] cursor-pointer">
                                <img
                                    src="{{ asset('storage/'.$img) }}"
                                    alt="{{ $product->name }} - thumbnail {{ $index+1 }}"
                                    loading="lazy"
                                >
                            </div>
                        @endforeach
                    @else
                        <div class="swiper-slide relative mr-3 aspect-square !w-[20%] cursor-pointer">
                            <img
                                src="{{ asset('backend/img/not-found.jpg') }}"
                                alt="{{ $product->name }}"
                                loading="lazy"
                            >
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
