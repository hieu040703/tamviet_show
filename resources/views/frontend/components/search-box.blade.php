<div class="z-[11] grid w-full grid-cols-1 md:z-[10] md:mt-4">
    <div id="boxSearchContainer"
         class="absolute bottom-[-20px] left-0 flex w-full px-4 transition-all md:relative md:!bottom-0 md:!w-full">
        <div class="w-full drop-shadow">
            <div class="mx-auto w-full">
                <div data-state="closed">
                    <div class="relative text-neutral-600" data-search-trigger>
                        <button data-size="sm" type="button"
                                class="flex justify-center outline-none font-semibold text-sm absolute left-0 top-0 z-10 h-10 px-2 py-[10px] text-neutral-900">
                            <span class="p-icon-1 inline-flex justify-center w-6 h-6">
                              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path
                                      fill-rule="evenodd" clip-rule="evenodd"
                                      d="M15.5 15.4366C15.7936 15.143 16.2697 15.143 16.5634 15.4366L21.7798 20.7163C22.0734 21.01 22.0734 21.4861 21.7798 21.7797C21.4861 22.0734 21.01 22.0734 20.7164 21.7797L15.5 16.5C15.2064 16.2064 15.2064 15.7303 15.5 15.4366Z"
                                      fill="currentColor"></path><path fill-rule="evenodd" clip-rule="evenodd"
                                                                       d="M10.5 3.57732C6.67671 3.57732 3.57732 6.67671 3.57732 10.5C3.57732 14.3233 6.67671 17.4227 10.5 17.4227C14.3233 17.4227 17.4227 14.3233 17.4227 10.5C17.4227 6.67671 14.3233 3.57732 10.5 3.57732ZM2 10.5C2 5.80558 5.80558 2 10.5 2C15.1944 2 19 5.80558 19 10.5C19 15.1944 15.1944 19 10.5 19C5.80558 19 2 15.1944 2 10.5Z"
                                                                       fill="currentColor"></path></svg>
                            </span>
                        </button>

                        <form action="" method="GET" class="w-full" id="boxSearchForm">
                            <input id="search-input-desktop" type="search" name="keyword" enterkeyhint="search"
                                   class="w-full placeholder:text-neutral-600 outline-none p-3.5 search-input flex h-10 rounded-sm bg-white py-1 pl-10 text-sm font-medium text-neutral-700"
                                   placeholder="Bạn đang tìm gì hôm nay...">
                        </form>

                        <div id="searchResults"
                             class="absolute left-0 right-0 mt-1 max-h-[calc(100vh-150px)] overflow-y-auto rounded-sm hidden"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('frontend/assets/js/mobile-search.js') }}"></script>
<script src="{{ asset('frontend/assets/js/search-autocomplete.js') }}"></script>
