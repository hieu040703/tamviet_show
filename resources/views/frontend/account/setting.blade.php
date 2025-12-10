@extends('frontend.layout')

@section('content')
    <div id="account" class="h-[100vh] md:h-auto md:pt-0">
        <div class="mx-auto max-w-screen-xl md:container md:pb-4">
            <div class="md:mt-4 md:flex md:gap-4">
                <div class="flex-1 md:max-w-[calc(1200px-288px-16px)]">
                    <div>
                        <div>
                            <div class="fixed left-0 top-0 z-10 h-11 w-full bg-white md:hidden">
                                <div class="z-50 grid w-full content-start gap-4 bg-white px-4 py-2.5 md:py-4">
                                    <div class="flex">
                                        <div class="flex w-6 items-center">
                                            <button
                                                data-back-button="true"
                                                data-size="sm"
                                                type="button"
                                                class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0 text-neutral-900"
                                            >
                                                <span
                                                    class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                                    <svg
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path
                                                            d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                                            fill="currentColor"
                                                        ></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>

                                        <div class="grid flex-1 items-center text-center">
                                            <h4 class="truncate px-2 text-base font-semibold text-neutral-900 md:text-2xl md:font-bold">
                                                Cài đặt
                                            </h4>
                                        </div>

                                        <div class="w-6"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="block pt-11 md:hidden">
                                <div class="mt-3 flex flex-col items-center gap-[10px] bg-white p-3">
                                    <img
                                        class="h-[60px] w-[60px] rounded-lg"
                                        src="{{asset('frontend/assets/image/logo/Logo-header.png')}}"
                                        alt="apple icon"
                                        loading="lazy"
                                        width="500"
                                        height="500"
                                    >
                                </div>

                                <div class="mt-5">
                                    <div class="flex items-center justify-center gap-2 text-neutral-700">
                                        <span
                                            class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6 text-neutral-700">
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <g clip-path="url(#clip0_2140_11444)">
                                                    <path
                                                        d="M16.1406 17.3125V18.875C16.1406 20.5982 14.7388 22 13.0156 22H5.16406C3.44089 22 2.03906 20.5982 2.03906 18.875V5.125C2.03906 3.40182 3.44089 2 5.16406 2H13.0156C14.7388 2 16.1406 3.40182 16.1406 5.125V6.6875C16.1406 7.11902 15.7909 7.46875 15.3594 7.46875C14.9279 7.46875 14.5781 7.11902 14.5781 6.6875V5.125C14.5781 4.26349 13.8771 3.5625 13.0156 3.5625H5.16406C4.30255 3.5625 3.60156 4.26349 3.60156 5.125V18.875C3.60156 19.7365 4.30255 20.4375 5.16406 20.4375H13.0156C13.8771 20.4375 14.5781 19.7365 14.5781 18.875V17.3125C14.5781 16.881 14.9279 16.5312 15.3594 16.5312C15.7909 16.5312 16.1406 16.881 16.1406 17.3125ZM21.467 10.658L19.7176 8.90857C19.4124 8.60339 18.9177 8.60339 18.6127 8.90857C18.3075 9.21359 18.3075 9.70828 18.6127 10.0133L19.8571 11.2578H10.4766C10.045 11.2578 9.69531 11.6075 9.69531 12.0391C9.69531 12.4706 10.045 12.8203 10.4766 12.8203H19.8571L18.6127 14.0648C18.3075 14.3698 18.3075 14.8645 18.6127 15.1696C18.7653 15.3221 18.9652 15.3984 19.1651 15.3984C19.3651 15.3984 19.565 15.3221 19.7176 15.1696L21.467 13.4201C22.2286 12.6586 22.2286 11.4196 21.467 10.658Z"
                                                        fill="currentColor"
                                                    ></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_2140_11444">
                                                        <rect
                                                            width="20"
                                                            height="20"
                                                            fill="white"
                                                            transform="translate(2 2)"
                                                        ></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                        <button
                                            data-logout-button
                                            type="button"
                                            class="text-sm font-semibold">
                                            Đăng xuất
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ROUTES = window.APP_ROUTES || {};
            const breakpoint = (window.APP_ROUTES && window.APP_ROUTES.breakpoint) || 768;

            function redirectIfDesktop() {
                if (window.innerWidth >= breakpoint) {
                    window.location.href = ROUTES.home || '/';
                }
            }

            redirectIfDesktop();
            window.addEventListener('resize', redirectIfDesktop);
        });
    </script>
@endpush
