@php
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
@endphp

<div>
    <div class="bg-divider h-[1px] mb-4"></div>
    <ul class="space-y-2 text-sm font-normal">
        @php
            $isActivePersonal = $currentRoute === 'account.personal-info';
        @endphp
        <li>
            <a
                href="{{ route('account.personal-info') }}"
                class="mb-2 group flex items-center px-4 py-3 font-semibold hover:bg-neutral-200 dark:text-white dark:hover:bg-neutral-700
                    {{ $isActivePersonal ? 'bg-primary-50 text-primary-500' : 'text-neutral-900' }}"
            >
                <span
                    class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6"
                >
                    <svg viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M12 7.09923C10.5053 7.09923 9.29339 8.31114 9.29339 9.80584V11.5001C9.29339 12.9948 10.5053 14.2067 12 14.2067C13.4947 14.2067 14.7066 12.9948 14.7066 11.5001V9.80584C14.7066 8.31114 13.4947 7.09923 12 7.09923ZM7.92976 9.80584C7.92976 7.55803 9.75219 5.7356 12 5.7356C14.2478 5.7356 16.0703 7.55803 16.0703 9.80584V11.5001C16.0703 13.7479 14.2478 15.5703 12 15.5703C9.75219 15.5703 7.92976 13.7479 7.92976 11.5001V9.80584Z"
                              fill="currentColor"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M6.31036 18.8101C7.36688 17.5511 8.95451 16.7478 10.7293 16.7478H13.2707C15.0372 16.7478 16.6369 17.5756 17.6885 18.8127L16.6496 19.6959C15.8375 18.7406 14.6079 18.1114 13.2707 18.1114H10.7293C9.37494 18.1114 8.16373 18.7228 7.35492 19.6866L6.31036 18.8101Z"
                              fill="currentColor"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M12 2.86364C7.23027 2.86364 3.36364 6.73027 3.36364 11.5C3.36364 16.2697 7.23027 20.1364 12 20.1364C16.7697 20.1364 20.6364 16.2697 20.6364 11.5C20.6364 6.73027 16.7697 2.86364 12 2.86364ZM2 11.5C2 5.97715 6.47715 1.5 12 1.5C17.5228 1.5 22 5.97715 22 11.5C22 17.0228 17.5228 21.5 12 21.5C6.47715 21.5 2 17.0228 2 11.5Z"
                              fill="currentColor"/>
                    </svg>
                </span>
                <span class="ml-3 text-base">Thông tin cá nhân</span>
            </a>
        </li>

        @php
            $isActiveContactHistory = $currentRoute === 'account.contact-history';
        @endphp
        <li>
            <a
                href="{{ route('account.contact-history') }}"
                class="mb-2 group flex items-center px-4 py-3 font-semibold hover:bg-neutral-200 dark:text-white dark:hover:bg-neutral-700
                    {{ $isActiveContactHistory ? 'bg-primary-50 text-primary-500' : 'text-neutral-900' }}"
            >
                <span
                    class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6"
                >
                    <svg viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M7 11H17V12.5H7V11Z"
                              fill="currentColor"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M7 15H17V16.5H7V15Z"
                              fill="currentColor"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M3 4H6.03464V5.37182H4.37182V20.6282H19.6282V5.37182H17.9654V4H21V22H3V4Z"
                              fill="currentColor"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M7 2H17V8H13.0086V7.35294C13.0086 6.84364 12.5574 6.43137 12 6.43137C11.4426 6.43137 10.9914 6.84364 10.9914 7.35294V8H7V2ZM8.41631 3.29412V6.70588H9.68007C9.98292 5.79769 10.9068 5.13725 12 5.13725C13.0932 5.13725 14.0171 5.79769 14.3199 6.70588H15.5837V3.29412H8.41631Z"
                              fill="currentColor"/>
                    </svg>
                </span>
                <span class="ml-3 text-base">Lịch sử liên hệ</span>
            </a>
        </li>
    </ul>
</div>
@push('scripts')
    <script src="{{ asset('frontend/assets/js/profile.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/contact-history.js') }}"></script>
@endpush
