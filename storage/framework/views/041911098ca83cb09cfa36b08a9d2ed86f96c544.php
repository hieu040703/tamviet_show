<div class="z-[11] grid w-full grid-cols-1 md:z-[10] md:mt-4">
    <div id="boxSearchContainer"
         class="absolute bottom-[-20px] left-0 flex w-full px-4 transition-all md:relative md:!bottom-0 md:!w-full">
        <div style="--background:hsl(var(--primary-500))" id="hamburgerMenuSticked"
             class="hidden items-center bg-[var(--background)] pe-2">
            <button
                aria-haspopup="dialog"
                aria-expanded="false"
                aria-controls="mobile-menu"
                data-mobile-menu-toggle
            >
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
        <div class="w-full drop-shadow">
            <div class="mx-auto w-full ">
                <div type="button" aria-haspopup="dialog" aria-expanded="false"
                     aria-controls="radix-:rq9:" data-state="closed">
                    <div class="relative text-neutral-600" data-search-trigger>
                        <button data-size="sm" type="submit"
                                class="flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 absolute left-0 top-0 z-10 h-10 px-2 py-[10px] text-neutral-900">
                            <span
                                class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                <svg viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M15.5 15.4366C15.7936 15.143 16.2697 15.143 16.5634 15.4366L21.7798 20.7163C22.0734 21.01 22.0734 21.4861 21.7798 21.7797C21.4861 22.0734 21.01 22.0734 20.7164 21.7797L15.5 16.5C15.2064 16.2064 15.2064 15.7303 15.5 15.4366Z"
                                          fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M10.5 3.57732C6.67671 3.57732 3.57732 6.67671 3.57732 10.5C3.57732 14.3233 6.67671 17.4227 10.5 17.4227C14.3233 17.4227 17.4227 14.3233 17.4227 10.5C17.4227 6.67671 14.3233 3.57732 10.5 3.57732ZM2 10.5C2 5.80558 5.80558 2 10.5 2C15.1944 2 19 5.80558 19 10.5C19 15.1944 15.1944 19 10.5 19C5.80558 19 2 15.1944 2 10.5Z"
                                          fill="currentColor"></path>
                                </svg>
                            </span>
                        </button>

                        <form action="" method="GET" class="w-full">
                            <input
                                type="search"
                                name="keyword"
                                enterkeyhint="search"
                                class="w-full border-neutral-500 placeholder:text-neutral-600 focus:ring-neutral-500 focus:border-neutral-700 outline-none p-3.5 search-input flex h-10 items-center justify-start rounded-sm border-0 bg-white py-1 pl-10 text-start text-sm font-medium text-neutral-700"
                                placeholder="Bạn đang tìm gì hôm nay...">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/components/search-box.blade.php ENDPATH**/ ?>