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
            class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
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
                        @include('frontend.components.cart-icon-mobile')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
