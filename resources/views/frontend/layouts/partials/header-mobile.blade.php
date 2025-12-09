<div
    class="fixed left-0 top-0 z-10 h-11 w-full bg-white block md:static md:z-auto md:block md:h-auto md:w-auto">
    <div class="z-50 grid w-full content-start gap-4 bg-white px-4 py-2.5 md:py-4 {{$shadowYPlus ?? null}}">
        <div class="flex">
            <div class="flex w-6 items-center md:hidden">
                <button
                    data-size="sm"
                    data-back-button="true"
                    type="button"
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
            <div class="grid flex-1 items-center text-center md:text-start">
                <h1
                    class="text-[24px] font-bold leading-[32px] flex-1 max-md:text-base max-md:font-semibold md:flex">
                    {{ $model->name ?? '' }}
                </h1>
            </div>

            <div class="md:hidden w-10">
                <div class="absolute top-2">
                    <div
                        class="relative flex h-9 w-9 items-center justify-center rounded-full border-0 bg-white p-2 md:!h-10 md:!w-10 md:bg-transparent md:text-white hover:md:bg-transparent hover:md:text-white focus:md:text-white">
                        <span
                            class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                            <svg viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M7.27236 19.3721C6.27946 19.3721 5.47455 20.1837 5.47455 21.1849C5.47455 22.1861 6.27946 22.9977 7.27236 22.9977C8.26526 22.9977 9.07017 22.1861 9.07017 21.1849C9.07017 20.1837 8.26526 19.3721 7.27236 19.3721ZM19.5774 19.3722C18.5845 19.3722 17.7796 20.1838 17.7796 21.185C17.7796 22.1862 18.5845 22.9978 19.5774 22.9978C20.5703 22.9978 21.3752 22.1862 21.3752 21.185C21.3752 20.1838 20.5703 19.3722 19.5774 19.3722Z"
                                      fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M1 1.0022H5.44999L6.08938 5.83638H22.9978L21.1882 14.9619C20.9305 16.2613 19.7991 17.1967 18.4853 17.1967H8.31206C6.9311 17.1967 5.76222 16.1657 5.58004 14.7841L3.98096 2.69416H1V1.0022ZM6.31317 7.52835L7.24327 14.5605C7.31441 15.1007 7.77167 15.5047 8.31206 15.5047H18.4853C18.999 15.5047 19.4419 15.1388 19.5428 14.6302C19.5428 14.6302 19.5428 14.6302 19.5428 14.6302L20.9511 7.52835H6.31317Z"
                                      fill="currentColor"></path>
                            </svg>
                        </span>

                        @include('frontend.components.cart-icon-mobile')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
