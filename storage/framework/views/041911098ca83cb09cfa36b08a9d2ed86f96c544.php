<div class="z-[11] grid w-full grid-cols-1 md:z-[10] md:mt-4">
    <div id="boxSearchContainer" class="absolute bottom-[-20px] left-0 flex w-full px-4 transition-all md:relative md:!bottom-0 md:!w-full">
        <div class="w-full drop-shadow">
            <div class="mx-auto w-full">
                <div data-state="closed">
                    <div class="relative text-neutral-600" data-search-trigger>
                        <button data-size="sm" type="button" class="flex justify-center outline-none font-semibold text-sm absolute left-0 top-0 z-10 h-10 px-2 py-[10px] text-neutral-900">
                            <span class="p-icon-1 inline-flex justify-center w-6 h-6">
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5 15.4c.3-.3.8-.3 1.1 0l5.2 5.3c.3.3.3.8 0 1.1-.3.3-.8.3-1.1 0L15.5 16.5c-.3-.3-.3-.8 0-1.1z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 3.6c-3.8 0-6.9 3.1-6.9 6.9s3.1 6.9 6.9 6.9 6.9-3.1 6.9-6.9S14.3 3.6 10.5 3.6zM2 10.5C2 5.8 5.8 2 10.5 2 15.2 2 19 5.8 19 10.5c0 4.7-3.8 8.5-8.5 8.5C5.8 19 2 15.2 2 10.5z" fill="currentColor"></path>
                                </svg>
                            </span>
                        </button>

                        <form action="" method="GET" class="w-full">
                            <input type="search" name="keyword" enterkeyhint="search" class="w-full placeholder:text-neutral-600 outline-none p-3.5 search-input flex h-10 rounded-sm bg-white py-1 pl-10 text-sm font-medium text-neutral-700" placeholder="Bạn đang tìm gì hôm nay...">
                        </form>

                        <div id="searchResults" class="absolute left-0 right-0 mt-1 max-h-[calc(100vh-150px)] overflow-y-auto rounded-sm hidden"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('frontend/assets/js/search-autocomplete.js')); ?>"></script>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/components/search-box.blade.php ENDPATH**/ ?>