<div class="fixed top-0 z-10 h-11 w-full bg-white md:hidden">
    <div class="flex px-4 py-1">
        <div class="flex items-center justify-center">
            <button data-size="sm" type="button"
                    data-back-button="true"
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
        <div class="flex flex-1 justify-end">
            <?php echo $__env->make('frontend.components.cart-icon-mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <button data-size="sm" type="button" data-go-home
                    class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 text-neutral-900 -mr-2 h-9 items-center p-2">
    <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M12 2L22 10.8894L21.2004 12L12 3.82146L2.79963 12L2 10.8894L12 2Z"
                  fill="currentColor"></path>
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M9 14H15V21H13.5V15.3333H10.5V21H9V14Z"
                  fill="currentColor"></path>
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M5.33333 12V19.5C5.33333 20.1904 5.93019 20.75 6.66667 20.75H17.3333C18.0698 20.75 18.6667 20.1904 18.6667 19.5V12H20V19.5C20 20.8808 18.8062 22 17.3333 22H6.66667C5.19381 22 4 20.8808 4 19.5V12H5.33333Z"
                  fill="currentColor"></path>
        </svg>
    </span>
            </button>

        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/product/partials/product-mobile-header.blade.php ENDPATH**/ ?>