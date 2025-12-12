@php
    $cartCount = $cartCount ?? \Cart::count();
@endphp

<div class=" grid-cols-2 justify-items-end gap-2">

    <a href="{{ route('cart.index') }}"
       class="relative flex h-9 w-9 items-center justify-center rounded-full border-0 bg-white p-2 md:!h-10 md:!w-10 md:bg-transparent md:text-white hover:md:bg-transparent hover:md:text-white focus:md:text-white">
        <span
            class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    fill-rule="evenodd" clip-rule="evenodd"
                    d="M7.27236 19.3721C6.27946 19.3721 5.47455 20.1837 5.47455 21.1849C5.47455 22.1861 6.27946 22.9977 7.27236 22.9977C8.26526 22.9977 9.07017 22.1861 9.07017 21.1849C9.07017 20.1837 8.26526 19.3721 7.27236 19.3721ZM19.5774 19.3722C18.5845 19.3722 17.7796 20.1838 17.7796 21.185C17.7796 22.1862 18.5845 22.9978 19.5774 22.9978C20.5703 22.9978 21.3752 22.1862 21.3752 21.185C21.3752 20.1838 20.5703 19.3722 19.5774 19.3722Z"
                    fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M1 1.0022H5.44999L6.08938 5.83638H22.9978L21.1882 14.9619C20.9305 16.2613 19.7991 17.1967 18.4853 17.1967H8.31206C6.9311 17.1967 5.76222 16.1657 5.58004 14.7841L3.98096 2.69416H1V1.0022ZM6.31317 7.52835L7.24327 14.5605C7.31441 15.1007 7.77167 15.5047 8.31206 15.5047H18.4853C18.999 15.5047 19.4419 15.1388 19.5428 14.6302L20.9511 7.52835H6.31317Z"
                      fill="currentColor"></path>
           </svg>
        </span>

        <div
            data-cart-count-mobile
            class="absolute -right-0.5 top-0 inline-flex h-[18px] min-w-[18px] items-center justify-center rounded-full border border-white bg-orange-500 px-1 text-xs font-bold text-white dark:border-neutral-900 md:right-0 md:h-5 md:min-w-[20px] {{ $cartCount ? '' : 'hidden' }}">
            {{ $cartCount }}
        </div>
    </a>
</div>
