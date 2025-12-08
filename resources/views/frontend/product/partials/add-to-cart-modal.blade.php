@php
    $image = $product->image ? asset('storage/'.$product->image): asset('backend/img/not-found.jpg');
@endphp
<div id="addToCartModal"
     class="fixed inset-0 z-50 hidden md:hidden">
    <div class="absolute inset-0 bg-black/40" data-modal-close></div>
    <div
        class="fixed bottom-0 right-0 left-0 z-50 grid w-full gap-4 border bg-background pt-[4.5rem] rounded-t-lg animate-moveToTop overflow-x-hidden px-0 pb-0">
        <div class="absolute w-full flex-col space-y-1.5 pb-2 pt-6 h-12 flex justify-center my-1 px-4">
            <h2 class="font-semibold tracking-tight text-lg leading-[calc(27rem/16)] -mt-2">
                Chọn sản phẩm
            </h2>
        </div>

        <div class="p-4 pt-0">
            <div class="flex space-x-2">
                <div class="aspect-square">
                    <img
                        class="h-[68px] w-[68px] rounded-sm border border-neutral-100"
                        src="{{ $image }}"
                        alt="{{ $product->name ?? '' }}"
                        loading="lazy"
                        width="500"
                        height="500"
                    >
                </div>
                <div class="flex-1">
                    <h3 class="-mt-1 mb-1 line-clamp-3 text-sm font-semibold">
                        {{ $product->name ?? '' }}
                    </h3>
                </div>
            </div>

            <div class="bg-divider h-[1px] my-4"></div>
            <div class="grid gap-3">
                <p class="text-sm font-semibold text-neutral-900">Số lượng</p>
                <div class="space-y-2" data-qty="wrapper">
                    <div class="flex items-center gap-1">
                        <button data-size="sm" type="button" data-qty="minus"
                                class="relative flex justify-center outline-none font-semibold border-0 text-sm px-4 py-2 h-9 rounded-full data-[size=xs]:w-8 data-[size=xs]:h-8 data-[size=xs]:p-1.5 data-[size=sm]:w-9 data-[size=sm]:h-9 data-[size=sm]:p-2 data-[size=md]:w-12 data-[size=md]:h-12 data-[size=md]:p-2.5 data-[size=lg]:w-13.5 data-[size=lg]:h-13.5 data-[size=lg]:p-2.5 cursor-not-allowed hover:bg-neutral-100 hover:text-neutral-600 focus:ring-neutral-100 text-neutral-600 !h-6 !w-6 !p-1.5 bg-neutral-100"
                                disabled>
                            <span
                                class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 12">
                                    <g><path fill="currentColor"
                                             d="M11.091 5.215H.751v1.41h10.34v-1.41z"></path></g>
                                </svg>
                            </span>
                        </button>

                        <input inputmode="numeric" maxlength="3"
                               class="border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-sm h-9 none-spin w-[30px] border-0 p-0 text-center disabled:bg-transparent disabled:text-neutral-600"
                               autocomplete="false" type="text" value="1"
                               data-qty="input" data-min="1">

                        <button data-size="sm" type="button" data-qty="plus"
                                class="relative flex justify-center outline-none font-semibold border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm px-4 py-2 h-9 rounded-full data-[size=xs]:w-8 data-[size=xs]:h-8 data-[size=xs]:p-1.5 data-[size=sm]:w-9 data-[size=sm]:h-9 data-[size=sm]:p-2 data-[size=md]:w-12 data-[size=md]:h-12 data-[size=md]:p-2.5 data-[size=lg]:w-13.5 data-[size=lg]:h-13.5 data-[size=lg]:p-2.5 !h-6 !w-6 bg-neutral-400 !p-1.5">
                            <span
                                class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 12">
                                    <g><path fill="currentColor"
                                             d="M11.25 5.216H6.783V.75h-1.41v4.466H.909v1.41h4.465v4.465h1.41V6.626h4.465v-1.41z"></path></g>
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div class="h-5"></div>
                </div>
            </div>
            <div class="py-4">
                <button
                    type="button"
                    id="qtyModalPrimaryBtn"
                    data-url=""
                    data-action=""
                    class="relative flex justify-center items-center rounded-lg outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 text-base px-6 py-3 h-13.5 w-full">
                    <span id="qtyModalPrimaryLabel">Thêm vào giỏ</span>
                </button>
            </div>
        </div>

        <button
            type="button"
            data-modal-close
            class="fixed right-4 top-5 rounded-sm opacity-100 outline-0 ring-offset-background transition-opacity hover:opacity-80">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round" class="h-7 w-7">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
            <span class="sr-only">Close</span>
        </button>
    </div>
</div>
