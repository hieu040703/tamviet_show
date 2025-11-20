<div class="hidden md:block">
    <div
        class="sticky top-[calc(var(--header-position-start-sticky)+24px)] mb-4 grid h-fit content-between gap-2 rounded border border-neutral-300 p-4 md:mb-6"
        style="--header-position-start-sticky: 0px;">
        <div class="grid gap-3 transition-all">
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
        </div>
        <div class="grid gap-3">
            <button data-size="sm" type="button"
                    class="relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 text-sm px-4 py-2 h-9 items-center rounded-lg">
                <span>Mua ngay</span>
            </button>
            <button data-size="sm" type="button"
                    class="relative flex justify-center outline-none font-semibold !bg-white bg-white border border-solid border-primary-500 text-primary-500 disabled:border-neutral-200 disabled:text-neutral-600 hover:border-primary-200 hover:text-primary-200 disabled:!bg-white text-sm px-4 py-2 h-9 items-center rounded-lg">
                <span>Thêm vào giỏ</span>
            </button>
        </div>
    </div>
</div>
