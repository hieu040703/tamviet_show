<div
    role="dialog"
    id="product-modal"
    data-state="closed"
    class="fixed left-0 bottom-0 right-0 z-50 grid w-full gap-4
     border bg-background rounded-t-lg overflow-hidden
     px-0 pb-0 pt-14 md:px-0 md:pb-0 md:pt-16
     md:left-[50%] md:top-[50%] md:h-fit md:w-[calc(480rem/16)]
     md:translate-x-[-50%] md:translate-y-[-50%]
     md:gap-0 md:rounded-lg
     opacity-0 pointer-events-none transition-all duration-300
     data-[state=open]:opacity-100 data-[state=open]:pointer-events-auto
     md:data-[state=open]:animate-in md:data-[state=open]:fade-in-0
     md:data-[state=open]:zoom-in-95 md:data-[state=open]:slide-in-from-left-1/2
     md:data-[state=open]:slide-in-from-top-[48%]
     md:data-[state=closed]:animate-out md:data-[state=closed]:fade-out-0
     md:data-[state=closed]:zoom-out-95 md:data-[state=closed]:slide-out-to-left-1/2
     md:data-[state=closed]:slide-out-to-top-[48%] !w-[848px]"
    tabindex="-1"
>

<div
        class="absolute w-full flex-col space-y-1.5 flex mt-2 md:mt-0 justify-center px-4 py-2.5 md:pt-6 md:pb-4 md:px-4"
    >
        <h2
            class="tracking-tight text-xl leading-7 md:leading-6 me-6 font-semibold line-clamp-2"
            data-product-name-target
        >
            Chọn sản phẩm
        </h2>
    </div>

    <div class="mx-4 flex flex-row gap-4 pb-6">
        <img
            class="h-[410px] w-[410px] object-contain"
            data-product-image-target
            src=""
            alt=""
            loading="lazy"
        >

        <div class="flex flex-1 flex-col justify-between">
            <div>
                <span
                    class="rounded-sm font-medium bg-primary-50 mb-2 inline-flex items-start gap-1 p-1 text-xs text-blue-500 md:text-sm"
                >
                    Khuyến mãi hấp dẫn
                </span>

                <div class="mb-2 line-clamp-3 text-xl font-bold" data-product-name-text>
                    Tên sản phẩm
                </div>

                <div class="bg-divider h-[1px] my-4"></div>

                <div class="grid gap-3">
                    <p class="text-sm font-bold">Số lượng</p>
                    <div class="space-y-2">
                        <div class="flex items-center gap-1">
                            <button
                                type="button"
                                data-size="sm"
                                data-qty-minus
                                class="relative flex justify-center outline-none font-semibold border-0 text-sm px-4 py-2 h-9 rounded-full hover:bg-neutral-100 hover:text-neutral-600 text-neutral-600 !h-6 !w-6 !p-1.5 bg-neutral-100"
                            >
                                <span
                                    class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 12">
                                        <path fill="currentColor" d="M11.091 5.215H.751v1.41h10.34v-1.41z"></path>
                                    </svg>
                                </span>
                            </button>

                            <input
                                inputmode="numeric"
                                maxlength="3"
                                data-qty-input
                                class="border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-sm h-9 none-spin w-[40px] border-0 p-0 text-center"
                                autocomplete="off"
                                type="text"
                                value="1"
                            >

                            <button
                                type="button"
                                data-size="sm"
                                data-qty-plus
                                class="relative flex justify-center outline-none font-semibold border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm px-4 py-2 h-9 rounded-full !h-6 !w-6 bg-neutral-400 !p-1.5"
                            >
                                <span
                                    class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 12">
                                        <path fill="currentColor"
                                              d="M11.25 5.216H6.783V.75h-1.41v4.466H.909v1.41h4.465v4.465h1.41V6.626h4.465v-1.41z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>

                        <div class="h-5"></div>
                    </div>
                </div>
            </div>

            <div>
                <button
                    type="button"
                    data-buy-now
                    class="relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 w-full text-sm px-4 py-2 h-9 items-center rounded-lg"
                >
                    <span>Liên hệ</span>
                </button>

                <button
                    type="button"
                    data-add-to-cart
                    class="relative flex justify-center outline-none font-semibold bg-white border border-solid border-primary-500 text-primary-500 hover:border-primary-200 hover:text-primary-200 w-full text-sm px-4 py-2 h-9 items-center rounded-lg mt-3"
                >
                    <span>Thêm vào giỏ</span>
                </button>
            </div>
        </div>
    </div>

    <button
        type="button"
        data-close-product-modal
        class="fixed rounded-sm opacity-100 outline-0 ring-offset-background transition-opacity hover:opacity-80 md:right-4 md:top-6 [&>svg]:w-6 [&>svg]:h-6 right-4 top-5"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
        </svg>
        <span class="sr-only">Close</span>
    </button>
</div>

<div
    role="dialog"
    id="product-modal-mobile"
    data-state="closed"
    class="md:px-6 lef-0 fixed bottom-0 right-0 z-50 grid w-full gap-4 border bg-background pt-[4.5rem] md:pt-20 rounded-t-lg animate-moveToTop overflow-x-hidden px-0 pb-0 md:hidden hidden"
    tabindex="-1"
>


    <div class="absolute w-full flex-col space-y-1.5 pb-2 pt-6 md:px-6 md:pt-7 h-12 flex justify-center my-1 px-4">
        <h2
            class="font-semibold tracking-tight text-lg leading-[calc(27rem/16)] -mt-2"
            data-product-name-target-mobile
        >
            Chọn sản phẩm
        </h2>
    </div>

    <div class="p-4 pt-0">
        <div class="flex space-x-2">
            <div class="aspect-square">
                <img
                    class="h-[68px] w-[68px] rounded-sm border border-neutral-100 object-contain bg-white"
                    src=""
                    alt=""
                    loading="lazy"
                    data-product-image-target-mobile
                >
            </div>
            <div class="flex-1">
                <h3
                    class="my-1 line-clamp-3 text-sm font-semibold"
                    data-product-name-text-mobile
                ></h3>
                <div class="flex flex-row items-center md:mb-1">
                    <del class="ml-1 text-sm font-semibold text-neutral-600 md:ml-2 md:text-xl"
                         data-product-price-old-mobile></del>
                </div>
                <div class="text-xl font-bold text-primary-500 md:mb-2 md:text-[28px]" data-product-price-mobile></div>
                <span class="text-[14px] leading-[20px] font-semibold text-gold-500" data-product-point-mobile></span>
            </div>
        </div>

        <div class="bg-divider h-[1px] my-4"></div>
        <div class="mb-3"></div>

        <div class="grid gap-3">
            <p class="text-sm font-bold">Số lượng</p>
            <div class="space-y-2">
                <div class="flex items-center gap-1">
                    <button
                        data-size="sm"
                        type="button"
                        data-qty-minus-mobile
                        class="relative flex justify-center outline-none font-semibold border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm px-4 py-2 h-9 rounded-full data-[size=xs]:w-8 data-[size=xs]:h-8 data-[size=xs]:p-1.5 data-[size=sm]:w-9 data-[size=sm]:h-9 data-[size=sm]:p-2 data-[size=md]:w-12 data-[size=md]:h-12 data-[size=md]:p-2.5 data-[size=lg]:w-13.5 data-[size=lg]:h-13.5 data-[size=lg]:p-2.5 !h-6 !w-6 bg-neutral-400 !p-1.5"
                    >
                        <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 12">
                                <path fill="currentColor" d="M11.091 5.215H.751v1.41h10.34v-1.41z"></path>
                            </svg>
                        </span>
                    </button>

                    <input
                        inputmode="numeric"
                        maxlength="3"
                        data-qty-input-mobile
                        class="border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-sm h-9 none-spin w-[30px] border-0 p-0 text-center disabled:bg-transparent disabled:text-neutral-600"
                        autocomplete="off"
                        type="text"
                        value="1"
                    >

                    <button
                        data-size="sm"
                        type="button"
                        data-qty-plus-mobile
                        class="relative flex justify-center outline-none font-semibold border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm px-4 py-2 h-9 rounded-full data-[size=xs]:w-8 data-[size=xs]:h-8 data-[size=xs]:p-1.5 data-[size=sm]:w-9 data-[size=sm]:h-9 data-[size=sm]:p-2 data-[size=md]:w-12 data-[size=md]:h-12 data-[size=md]:p-2.5 data-[size=lg]:w-13.5 data-[size=lg]:h-13.5 data-[size=lg]:p-2.5 !h-6 !w-6 bg-neutral-400 !p-1.5"
                    >
                        <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 12">
                                <path fill="currentColor"
                                      d="M11.25 5.216H6.783V.75h-1.41v4.466H.909v1.41h4.465v4.465h1.41V6.626h4.465v-1.41z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="h-5"></div>
            </div>
        </div>

        <div class="flex justify-between gap-4 py-4">
            <button
                data-size="lg"
                type="button"
                data-add-to-cart-mobile
                class="relative flex justify-center outline-none font-semibold bg-white border border-solid border-primary-500 text-primary-500 disabled:border-neutral-200 disabled:text-neutral-600 hover:border-primary-200 hover:text-primary-200 disabled:bg-white text-base px-6 py-3 h-13.5 items-center rounded-lg w-full"
            >
                <span>Thêm vào giỏ</span>
            </button>

            <button
                data-size="lg"
                type="button"
                data-buy-now-mobile
                class="relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 text-base px-6 py-3 h-13.5 items-center rounded-lg w-full"
            >
                <span>Liên hệ</span>
            </button>
        </div>
    </div>

    <button
        type="button"
        data-close-mobile
        class="fixed rounded-sm opacity-100 outline-0 ring-offset-background transition-opacity hover:opacity-80 md:right-4 md:top-6 [&>svg]:w-6 [&>svg]:h-6 right-4 top-5"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
        </svg>
        <span class="sr-only">Close</span>
    </button>
</div>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('frontend/assets/js/product-modal.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/components/product-modal.blade.php ENDPATH**/ ?>