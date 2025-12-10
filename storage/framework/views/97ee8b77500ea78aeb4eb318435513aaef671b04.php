<div role="dialog" id="loginPopup"
     class="popup-hidden grid focus-visible:outline-0 md:block px-4 md:px-6 pt-28 pb-6 left-0 fixed bottom-0 right-0 top-0 z-50 w-full gap-4 border bg-background shadow-lg duration-200 md:left-[50%] md:h-fit md:max-h-[90%] md:w-full md:translate-x-[-50%] md:rounded-lg overflow-x-hidden border-white md:top-[15%] md:max-w-[413px] md:translate-y-0 md:border-neutral-200 md:pt-6"
     tabindex="-1" style="pointer-events: auto;">

    <div class="flex w-full flex-col space-y-1.5 px-4 pb-2 pt-6 md:px-6 md:pt-7 fixed left-0 top-0"></div>

    <button type="button"
            class="fixed right-2 top-5 rounded-sm opacity-100 outline-0 ring-offset-background transition-opacity hover:opacity-80 md:right-4 md:top-6 z-10">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
        </svg>
        <span class="sr-only">Close</span>
    </button>

    <div class="">
        <div class="absolute left-0 top-0 p-4 md:hidden">
            <a href="/">
                <img class="w-auto cursor-default h-[40px] md:mx-auto"
                     src="<?php echo e(asset('frontend/assets/image/logo/logo.png')); ?>"
                     alt="Tam việt Logo">
            </a>
        </div>

        <div class="mb-5">
            <h2 class="upper-title">XIN CHÀO,</h2>
            <p>Vui lòng nhập email hoặc số điện thoại để đăng nhập</p>
        </div>

        <form id="loginForm" class="space-y-4">
            <div>
                <label id="login_label" class="font-semibold">Email hoặc số điện thoại</label>
                <input id="login_input" type="text"
                       placeholder="Nhập email hoặc số điện thoại"
                       class="w-full border border-neutral-400 text-neutral-900 rounded-lg
                              placeholder:text-neutral-500 text-base p-3 mt-1 focus:border-primary-500 outline-none">
                <p id="login_error" class="text-sm font-normal text-red-500 hidden"></p>
            </div>

            <div>
                <label class="font-semibold">Mật khẩu</label>
                <input id="password_input" type="password"
                       placeholder="Nhập mật khẩu"
                       class="w-full border border-neutral-400 text-neutral-900 rounded-lg
                              placeholder:text-neutral-500 text-base p-3 mt-1 focus:border-primary-500 outline-none">
            </div>

            <p id="auth_error" class="text-sm font-normal text-red-500 hidden"></p>

            <button id="login_submit" data-size="md" type="submit" disabled
                    class="relative flex justify-center outline-none font-semibold border-0 w-full text-base px-5 py-2.5 h-12 items-center rounded-lg cursor-not-allowed bg-neutral-100 hover:bg-neutral-100 hover:text-neutral-600 focus:ring-neutral-100 text-neutral-600">
                <span>Tiếp tục</span>
            </button>
        </form>
        <div class="mt-4 text-center text-sm text-neutral-700">
            <span>Chưa có tài khoản?</span>
            <button type="button"
                    id="login_to_register"
                    class="ml-1 font-semibold text-primary-500 hover:text-primary-600 underline">
                Đăng ký ngay
            </button>
        </div>
    </div>
</div>

<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/components/login.blade.php ENDPATH**/ ?>