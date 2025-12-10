<div class="hiddenAtNavFixed relative flex-1 md:flex md:justify-end">
    <span
        class="border-color-white absolute bottom-[6px] left-0 top-[6px] hidden border-l-[1px] md:inline-block"></span>

    @auth('web')
        @php
            $user = auth('web')->user();
            $avatar = $user && $user->avatar ? asset($user->avatar) : asset('backend/img/not-found.jpg');
            $displayName = $user && $user->name ? $user->name : 'Khách hàng';
            $logo = $system['homepage_logo'];

        @endphp

        <div class="flex h-full items-center gap-2 md:hidden">
            <div id="hamburgerMenu">
                <button type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="mobile-menu"
                        data-mobile-menu-toggle="" class="inline-flex items-center justify-center">
                    <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-neutral-50">
                            <path
                                d="M21.2188 11.2222H2.78125C2.34977 11.2222 2 11.5704 2 11.9999C2 12.4295 2.34977 12.7777 2.78125 12.7777H21.2188C21.6502 12.7777 22 12.4295 22 11.9999C22 11.5704 21.6502 11.2222 21.2188 11.2222Z"
                                fill="currentColor"></path>
                            <path
                                d="M21.2188 5H2.78125C2.34977 5 2 5.34821 2 5.77777C2 6.20733 2.34977 6.55554 2.78125 6.55554H21.2188C21.6502 6.55554 22 6.20733 22 5.77777C22 5.34821 21.6502 5 21.2188 5Z"
                                fill="currentColor"></path>
                            <path
                                d="M21.2188 17.4446H2.78125C2.34977 17.4446 2 17.7928 2 18.2223C2 18.6519 2.34977 19.0001 2.78125 19.0001H21.2188C21.6502 19.0001 22 18.6519 22 18.2223C22 17.7928 21.6502 17.4446 21.2188 17.4446Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                </button>
            </div>
            <a href="/">
                <img class="cursor-default my-auto h-[36px] w-[90px]"
                     src="{{ asset('storage/' . $logo) }}"
                     alt="Tâm việt Logo">
            </a>
        </div>
        <div class="hidden md:inline-flex relative" data-account-wrapper>
            <button
                data-size="sm"
                type="button"
                class="relative md:ml-2 flex justify-center outline-none font-semibold bg-white border border-neutral-200 hover:bg-bg-white hover:text-primary-500 focus:text-primary-500 text-sm px-4 py-2 h-9 items-center rounded-full"
                data-account-trigger
            >
                <img
                    class="rounded-full w-6 h-6 object-cover"
                    src="{{ $avatar }}"
                    alt="avatar"
                    loading="lazy"
                    width="500"
                    height="500"
                >
                <div class="ml-1 line-clamp-1 flex-1 text-left font-bold">Chào, {{ $displayName }}</div>
                <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-4 h-4">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.7138 16.7077L21.7048 7.71374C22.0984 7.31909 22.0984 6.6797 21.7048 6.28406C21.3111 5.88941 20.6717 5.88941 20.2781 6.28406L12.0005 14.5646L3.72293 6.28505C3.32928 5.89041 2.68989 5.89041 2.29524 6.28505C1.90159 6.6797 1.90159 7.32009 2.29524 7.71474L11.2861 16.7087C11.6757 17.0973 12.3251 17.0973 12.7138 16.7077Z"
                            fill="currentColor"
                        ></path>
                    </svg>
                </span>
            </button>

            <div
                class="mt-16 absolute right-0 top-[calc(100%+8px)] z-50 hidden w-72 rounded-md bg-white text-sm text-neutral-900 shadow-md border"
                data-account-menu
            >
                <ul class="list-none">
                    <li class="cursor-pointer">
                        <a
                            class="border-b flex items-center px-4 py-3 font-semibold text-neutral-900 hover:bg-neutral-200"
                            href="{{route('account.personal-info')}}"
                        >
                            <span class="p-icon inline-flex justify-center max-h-full max-w-full w-6 h-6">
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
                            <span class="ml-3 text-base">Thông tin cá nhân</span>
                        </a>
                    </li>
                    <li class="cursor-pointer">
                        <a
                            class="border-b flex items-center px-4 py-3 font-semibold text-neutral-900 hover:bg-neutral-200"
                            href="{{route('account.contact-history')}}"
                        >
                            <span class="p-icon inline-flex justify-center max-h-full max-w-full w-6 h-6">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 11H17V12.5H7V11Z"
                                          fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 15H17V16.5H7V15Z"
                                          fill="currentColor"></path>
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
                            <span class="ml-3 text-base">Lịch sử liên hệ</span>
                        </a>
                    </li>
                    <li>
                        <button
                            type="button"
                            class="w-full cursor-pointer px-6 py-4 text-start text-base font-semibold text-neutral-700 hover:bg-neutral-200"
                            data-logout-button
                        >
                            Đăng xuất
                        </button>

                    </li>
                </ul>
            </div>
        </div>
    @else
        <div class="hidden md:ml-2 md:inline-flex">
            <button
                data-size="sm"
                type="button"
                class="relative justify-center outline-none font-semibold bg-single border border-neutral-200 hover:bg-bg-white hover:text-primary-500 focus:text-primary-500 text-sm px-4 py-2 h-9 items-center rounded-full btn-login flex"
            >
                <span
                    class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full m-[-1] mr-1 h-6 w-6 px-0">
                    <svg viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.0711 4.92895C18.1823 3.0402 15.6711 2 13 2C10.3289 2 7.8177 3.0402 5.92891 4.92895C4.0402 6.8177 3 9.32891 3 12C3 14.6711 4.0402 17.1823 5.92891 19.0711C7.8177 20.9598 10.3289 22 13 22C15.6711 22 18.1823 20.9598 20.0711 19.0711C21.9598 17.1823 23 14.6711 23 12C23 9.32891 21.9598 6.8177 20.0711 4.92895ZM13 20.8281C10.3879 20.8281 8.03762 19.6874 6.41984 17.8785C7.42277 15.2196 9.99016 13.3281 13 13.3281C11.0584 13.3281 9.48438 11.7541 9.48438 9.8125C9.48438 7.87086 11.0584 6.29688 13 6.29688C14.9416 6.29688 16.5156 7.87086 16.5156 9.8125C16.5156 11.7541 14.9416 13.3281 13 13.3281C16.0098 13.3281 18.5772 15.2196 19.5802 17.8785C17.9624 19.6874 15.6121 20.8281 13 20.8281Z"
                            fill="currentColor"
                        ></path>
                    </svg>
                </span>
                <span id="openLogin">Đăng nhập /</span>
                <span id="openRegister" class="ml-1">Đăng ký</span>
            </button>
        </div>

        <div class="flex h-full items-center gap-2 md:hidden">
            <div id="hamburgerMenu">
                <button
                    type="button"
                    aria-haspopup="dialog"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    data-mobile-menu-toggle
                    class="inline-flex items-center justify-center"
                >
                    <span class="p-icon p-icon-header inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-neutral-50">
                            <path
                                d="M21.2188 11.2222H2.78125C2.34977 11.2222 2 11.5704 2 11.9999C2 12.4295 2.34977 12.7777 2.78125 12.7777H21.2188C21.6502 12.7777 22 12.4295 22 11.9999C22 11.5704 21.6502 11.2222 21.2188 11.2222Z"
                                fill="currentColor"></path>
                            <path
                                d="M21.2188 5H2.78125C2.34977 5 2 5.34821 2 5.77777C2 6.20733 2.34977 6.55554 2.78125 6.55554H21.2188C21.6502 6.55554 22 6.20733 22 5.77777C22 5.34821 21.6502 5 21.2188 5Z"
                                fill="currentColor"></path>
                            <path
                                d="M21.2188 17.4446H2.78125C2.34977 17.4446 2 17.7928 2 18.2223C2 18.6519 2.34977 19.0001 2.78125 19.0001H21.2188C21.6502 19.0001 22 18.6519 22 18.2223C22 17.7928 21.6502 17.4446 21.2188 17.4446Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                </button>
            </div>

            <a class="logo-mobile-header" href="/">
                <img
                    class="cursor-default my-auto h-[36px] w-[90px] ml-20"
                    src="{{ asset('storage/' . $logo) }}"
                    alt="Tâm việt logo"
                >
            </a>
        </div>
    @endauth
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var wrapper = document.querySelector('[data-account-wrapper]');
        if (!wrapper) return;

        var trigger = wrapper.querySelector('[data-account-trigger]');
        var menu = wrapper.querySelector('[data-account-menu]');

        function closeMenu() {
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        }

        if (trigger && menu) {
            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
        }

        document.addEventListener('click', function (e) {
            if (wrapper && !wrapper.contains(e.target)) {
                closeMenu();
            }
        });

        window.addEventListener('resize', closeMenu);
        window.addEventListener('scroll', closeMenu, {passive: true});

        var logoutButtons = document.querySelectorAll('[data-logout-button]');
        var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        var ROUTES = window.APP_ROUTES || {};

        function showToast(message) {
            var toast = document.getElementById('tv-cart-toast');
            var text = document.getElementById('tv-cart-toast-message');
            if (!toast) return;
            if (text && message) {
                text.textContent = message;
            }
            toast.style.display = 'block';
            setTimeout(function () {
                toast.style.display = 'none';
            }, 2500);
        }

        logoutButtons.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                if (!ROUTES.logout) {
                    window.location.reload();
                    return;
                }

                fetch(ROUTES.logout, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || ''
                    },
                    body: JSON.stringify({})
                })
                    .then(function (res) {
                        return res.json();
                    })
                    .then(function (data) {
                        closeMenu();
                        if (data && data.success) {
                            showToast('Đăng xuất thành công');
                            var redirectUrl = data.redirect || '/';
                            setTimeout(function () {
                                window.location.href = redirectUrl;
                            }, 800);
                        } else {
                            showToast('Có lỗi xảy ra, vui lòng thử lại');
                        }
                    })
                    .catch(function () {
                        closeMenu();
                        showToast('Có lỗi xảy ra, vui lòng thử lại');
                    });
            });
        });
    });
</script>


