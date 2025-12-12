<div role="dialog" id="mobile-search-dialog"
     aria-describedby="radix-:rpb:" aria-labelledby="radix-:rpa:"
     data-state="closed"
     class="hidden fixed inset-0 z-50 grid h-[100dvh] w-full content-start gap-4 bg-white px-4 py-4 shadow-lg duration-100"
     tabindex="-1" aria-hidden="true" style="display:none;">
    <div class="flex h-full w-full flex-col overflow-hidden rounded-md text-popover-foreground bg-transparent">
        <div class="grid grid-cols-[24px,1fr] items-center justify-start gap-4 py-1">
            <div>
                <button id="mobile-search-back" data-size="sm" type="button"
                        class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent border-0 h-6 p-0 text-neutral-900">
                    <span class="p-icon-1 inline-flex w-6 h-6" aria-hidden="true">
<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path
        d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
        fill="currentColor"></path></svg>
                    </span>
                </button>
            </div>

            <div
                class="grid grid-cols-1 items-center justify-start rounded-sm border border-neutral-200 px-3 py-2 text-neutral-600">
                <div class="relative flex">
                    <input id="search-input-mobile" enterkeyhint="search"
                           class="w-full border-neutral-500 text-neutral-900 rounded-lg focus:ring-neutral-500 focus:border-neutral-700 outline-none p-3.5 search-input h-5 truncate border-0 px-1 py-0 text-sm font-medium placeholder:text-neutral-700"
                           placeholder="Bạn đang tìm gì hôm nay..." inputmode="text" type="search" value="">
                </div>
            </div>
        </div>

        <div class="grid gap-2 bg-white mobile-search-area">
            <div class="grid gap-4">
                <div dir="ltr" class="relative overflow-hidden h-full"
                     style="max-height: calc(100dvh - 178px); position:relative;">
                    <div data-radix-scroll-area-viewport class="h-full w-full rounded-[inherit]"
                         style="overflow: auto;">
                        <div style="min-width:100%; display:table;">
                            <div class="grid gap-4 md:gap-3">
                                <div id="mobileSearchResultsHook"
                                     style="width:100%; margin-top:10px; box-sizing:border-box; display:block;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button id="search-reset-filter-mobile" class="absolute hidden opacity-0" aria-hidden="true"></button>
    </div>
</div>
<button id="open-mobile-search" class="hidden" aria-hidden="true"></button>
