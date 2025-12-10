<div class="<?php echo e($bottomNav ?? null); ?>">
    <div
        class="fixed bottom-0 z-20 grid h-16 w-full grid-cols-5 justify-items-stretch border-t border-t-neutral-200 bg-white md:hidden"
    >
        <a href="/"
           class="relative grid h-full grid-rows-2 justify-center border-0 px-1 py-2 text-center text-sm font-medium
               bg-transparent text-neutral-600 outline-none hover:bg-0 hover:text-neutral-600 focus:text-neutral-600
               focus:ring-primary-300 data-[size=sm]:text-sm <?php echo e(request()->routeIs('homepage.index') ? '!text-primary-500' : ''); ?>"
        >
        <span>
            <span
                class="p-icon inline-flex h-6 w-6 max-h-full max-w-full items-center justify-center align-[-0.125em]"
            >
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12 2L22 10.8894L21.2004 12L12 3.82146L2.79963 12L2 10.8894L12 2Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M9 14H15V21H13.5V15.3333H10.5V21H9V14Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M5.33333 12V19.5C5.33333 20.1904 5.93019 20.75 6.66667 20.75H17.3333C18.0698 20.75 18.6667 20.1904 18.6667 19.5V12H20V19.5C20 20.8808 18.8062 22 17.3333 22H6.66667C5.19381 22 4 20.8808 4 19.5V12H5.33333Z"
                        fill="currentColor"
                    ></path>
                </svg>
            </span>
        </span>
            <span class="text-xs">Trang chủ</span>
        </a>
        <a href="<?php echo e(route('category.index')); ?>"
           class="relative grid h-full grid-rows-2 justify-center border-0 px-1 py-2 text-center text-sm font-medium
               bg-transparent text-neutral-600 outline-none hover:bg-0 hover:text-neutral-600 focus:text-neutral-600
               focus:ring-primary-300 data-[size=sm]:text-sm <?php echo e(request()->routeIs('category.index') ? '!text-primary-500' : ''); ?>"
        >
        <span>
            <span
                class=" p-icon inline-flex h-6 w-6 max-h-full max-w-full items-center justify-center align-[-0.125em]"
            >
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M2 16.458H6.81928V21.1166H2V16.458ZM3.44578 17.9038V19.6709H5.37349V17.9038H3.44578Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M9.59033 9.22876H14.4096V13.8874H9.59033V9.22876ZM11.0361 10.6745V12.4416H12.9638V10.6745H11.0361Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M2 9.22876H6.81928V13.8874H2V9.22876ZM3.44578 10.6745V12.4416H5.37349V10.6745H3.44578Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M9.59033 2H14.4096V6.65863H9.59033V2ZM11.0361 3.44578V5.21285H12.9638V3.44578H11.0361Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M2 2H6.81928V6.65863H2V2ZM3.44578 3.44578V5.21285H5.37349V3.44578H3.44578Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M17.1807 2H22V6.65863H17.1807V2ZM18.6265 3.44578V5.21285H20.5542V3.44578H18.6265Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M9.59033 18.0642H14.4096V19.51H9.59033V18.0642Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.7229 16.458V21.1166H11.2771V16.458H12.7229Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M17.1807 18.0642H22V19.51H17.1807V18.0642Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M20.3132 16.458V21.1166H18.8675V16.458H20.3132Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M17.1807 10.8354H22V12.2812H17.1807V10.8354Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M20.3132 9.22876V13.8874H18.8675V9.22876H20.3132Z"
                        fill="currentColor"
                    ></path>
                </svg>
            </span>
        </span>
            <span class="text-xs">Danh mục</span>
        </a>
        <a
            rel="noopener noreferrer"
            target="_blank"
            href="/"
            class="relative grid h-full grid-rows-2 justify-center border-0 px-1 py-2 text-center text-sm font-medium
               bg-transparent text-neutral-600 outline-none hover:bg-0 hover:text-neutral-600 focus:text-neutral-600
               focus:ring-primary-300 data-[size=sm]:text-sm"
        >
        <span
            class="bottom-header mx-auto mt-[-30px] h-14 w-14 rounded-full bg-primary-500 p-3 text-xl text-white"
        >
            <span
                class="p-icon inline-flex h-8 w-8 max-h-full max-w-full items-center justify-center align-[-0.125em]"
            >
                <svg viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M13 2C8.03674 2 4 6.03674 4 11V15.8758C4 17.2541 5.12058 18.3747 6.49887 18.3747H8.93679C9.41915 18.3747 9.81038 17.9835 9.81038 17.5011V11.8126C9.81038 11.3303 9.41915 10.9391 8.93679 10.9391H5.74743C5.78029 6.96804 9.02138 3.74718 13 3.74718C16.9786 3.74718 20.2197 6.96804 20.2526 10.9391H17.0632C16.5809 10.9391 16.1896 11.3303 16.1896 11.8126V17.5011C16.1896 17.9835 16.5809 18.3747 17.0632 18.3747H19.5011C19.749 18.3747 19.9868 18.3373 20.2106 18.2692C20.2106 19.2889 19.8871 20.6907 18.6885 20.6907H17.9347C17.9034 20.2368 17.5251 19.8781 17.0632 19.8781H13C12.5176 19.8781 12.1264 20.2693 12.1264 20.7517V21.9707C12.1264 22.453 12.5176 22.8442 13 22.8442H17.0632C17.3737 22.8442 17.6465 22.6821 17.8014 22.4379H18.6885C21.2889 22.4379 22 19.7339 22 17.9074V11C22 6.03674 17.9633 2 13 2Z"
                        fill="currentColor"
                    ></path>
                </svg>
            </span>
        </span>
            <span class="text-xs">Tư vấn</span>
        </a>
        <a
            href="<?php echo e(route('account.contact-history')); ?>"
            data-requires-auth
            class="relative grid h-full grid-rows-2 justify-center border-0 px-1 py-2 text-center text-sm font-medium
               bg-transparent text-neutral-600 outline-none hover:bg-0 hover:text-neutral-600 focus:text-neutral-600
               focus:ring-primary-300 data-[size=sm]:text-sm <?php echo e(request()->routeIs('account.contact-history') ? '!text-primary-500' :''); ?>"
        >
        <span>
            <span
                class="p-icon inline-flex h-6 w-6 max-h-full max-w-full items-center justify-center align-[-0.125em]"
            >
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7 11H17V12.5H7V11Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7 15H17V16.5H7V15Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M3 4H6.03464V5.37182H4.37182V20.6282H19.6282V5.37182H17.9654V4H21V22H3V4Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7 2H17V8H13.0086V7.35294C13.0086 6.84364 12.5574 6.43137 12 6.43137C11.4426 6.43137 10.9914 6.84364 10.9914 7.35294V8H7V2ZM8.41631 3.29412V6.70588H9.68007C9.98292 5.79769 10.9068 5.13725 12 5.13725C13.0932 5.13725 14.0171 5.79769 14.3199 6.70588H15.5837V3.29412H8.41631Z"
                        fill="currentColor"
                    ></path>
                </svg>
            </span>
        </span>
            <span class="text-xs">Liên hệ</span>
        </a>
        <a
            href="<?php echo e(route('account.index')); ?>"
            data-requires-auth
            class="relative grid h-full grid-rows-2 justify-center border-0 px-1 py-2 text-center text-sm font-medium
               bg-transparent text-neutral-600 outline-none hover:bg-0 hover:text-neutral-600 focus:text-neutral-600
               focus:ring-primary-300 data-[size=sm]:text-sm <?php echo e(request()->routeIs('account.index') ? '!text-primary-500' :''); ?>"
        >
        <span>
            <span
                class="p-icon inline-flex h-6 w-6 max-h-full max-w-full items-center justify-center align-[-0.125em]"
            >
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12 7.09923C10.5053 7.09923 9.29339 8.31114 9.29339 9.80584V11.5001C9.29339 12.9948 10.5053 14.2067 12 14.2067C13.4947 14.2067 14.7066 12.9948 14.7066 11.5001V9.80584C14.7066 8.31114 13.4947 7.09923 12 7.09923ZM7.92976 9.80584C7.92976 7.55803 9.75219 5.7356 12 5.7356C14.2478 5.7356 16.0703 7.55803 16.0703 9.80584V11.5001C16.0703 13.7479 14.2478 15.5703 12 15.5703C9.75219 15.5703 7.92976 13.7479 7.92976 11.5001V9.80584Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M6.31036 18.8101C7.36688 17.5511 8.95451 16.7478 10.7293 16.7478H13.2707C15.0372 16.7478 16.6369 17.5756 17.6885 18.8127L16.6496 19.6959C15.8375 18.7406 14.6079 18.1114 13.2707 18.1114H10.7293C9.37494 18.1114 8.16373 18.7228 7.35492 19.6866L6.31036 18.8101Z"
                        fill="currentColor"
                    ></path>
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12 2.86364C7.23027 2.86364 3.36364 6.73027 3.36364 11.5C3.36364 16.2697 7.23027 20.1364 12 20.1364C16.7697 20.1364 20.6364 16.2697 20.6364 11.5C20.6364 6.73027 16.7697 2.86364 12 2.86364ZM2 11.5C2 5.97715 6.47715 1.5 12 1.5C17.5228 1.5 22 5.97715 22 11.5C22 17.0228 17.5228 21.5 12 21.5C6.47715 21.5 2 17.0228 2 11.5Z"
                        fill="currentColor"
                    ></path>
                </svg>
            </span>
        </span>
            <span class="text-xs">Tài khoản</span>
        </a>
    </div>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/layouts/partials/bottom-nav.blade.php ENDPATH**/ ?>