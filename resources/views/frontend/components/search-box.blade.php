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
                        <!-- Nút kính lúp -->
                        <button data-size="sm" type="button"
                                class="flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 absolute left-0 top-0 z-10 h-10 px-2 py-[10px] text-neutral-900">
                            <span
                                class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
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

                        <!-- Form search -->
                        <form action="" method="GET" class="w-full">
                            <input
                                type="search"
                                name="keyword"
                                enterkeyhint="search"
                                class="w-full border-neutral-500 placeholder:text-neutral-600 focus:ring-neutral-500 focus:border-neutral-700 outline-none p-3.5 search-input flex h-10 items-center justify-start rounded-sm border-0 bg-white py-1 pl-10 text-start text-sm font-medium text-neutral-700 border-search-header"
                                placeholder="Bạn đang tìm gì hôm nay..."
                            >
                        </form>

                        <!-- Kết quả tìm kiếm (dropdown giống Pharmacity) -->
                        <div
                            id="searchResults"
                            class="absolute left-0 right-0 mt-1 max-h-[calc(100vh-150px)] overflow-y-auto rounded-sm bg-transparent hidden"
                        >
                            <!-- JS sẽ render nội dung vào đây -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#boxSearchContainer form');
        const input = form.querySelector('input[name="keyword"]');
        const resultsBox = document.getElementById('searchResults');
        const searchButton = document.querySelector('[data-search-trigger] button');

        let timer = null;

        function debounceSearch() {
            clearTimeout(timer);

            const keyword = input.value.trim();

            if (!keyword) {
                resultsBox.classList.add('hidden');
                resultsBox.innerHTML = '';
                return;
            }

            timer = setTimeout(function () {
                fetch('/ajax/search?keyword=' + encodeURIComponent(keyword))
                    .then(function (res) { return res.json(); })
                    .then(function (res) {
                        if (res.status !== 'success') {
                            resultsBox.classList.add('hidden');
                            resultsBox.innerHTML = '';
                            return;
                        }

                        renderResultDropdown(res.data, keyword);
                    })
                    .catch(function () {
                        resultsBox.classList.add('hidden');
                    });
            }, 250); // 250ms debounce
        }

        function renderBlock(title, items) {
            if (!items || !items.length) return '';

            let html = `
                <div class="mb-3">
                    <p class="text-sm font-semibold text-neutral-900 mb-1">${title}</p>
                    <div class="grid gap-1">
            `;

            items.forEach(function (item) {
                html += `
                    <a href="${item.url}"
                       class="flex items-center gap-2 rounded px-2 py-2 text-sm hover:bg-neutral-100">
                        ${item.image
                    ? `<div class="h-8 w-8 flex-shrink-0 overflow-hidden rounded bg-neutral-100">
                                   <img src="${item.image}" alt="${item.name}" class="h-full w-full object-cover">
                               </div>`
                    : `<div class="h-8 w-8 flex-shrink-0 rounded-full bg-primary-50 flex items-center justify-center text-[10px] text-primary-500 uppercase">
                                   ${title.charAt(0)}
                               </div>`
                }
                        <span class="flex-1 truncate text-neutral-900">${item.name}</span>
                    </a>
                `;
            });

            html += `</div></div>`;
            return html;
        }

        function renderResultDropdown(data, keyword) {
            let any =
                (data.products && data.products.length) ||
                (data.categories && data.categories.length) ||
                (data.brands && data.brands.length) ||
                (data.post_catalogues && data.post_catalogues.length) ||
                (data.posts && data.posts.length);

            if (!any) {
                resultsBox.innerHTML = `
                    <div class="bg-white rounded shadow-lg px-3 py-2 text-sm text-neutral-600">
                        Không tìm thấy kết quả cho "<span class="font-semibold">${keyword}</span>".
                    </div>
                `;
                resultsBox.classList.remove('hidden');
                return;
            }

            let html = `
                <div class="bg-white rounded shadow-lg p-3 grid gap-2">
            `;

            html += renderBlock('Sản phẩm', data.products);
            html += renderBlock('Danh mục', data.categories);
            html += renderBlock('Thương hiệu', data.brands);
            html += renderBlock('Nhóm bài viết', data.post_catalogues);
            html += renderBlock('Bài viết', data.posts);

            html += `</div>`;

            resultsBox.innerHTML = html;
            resultsBox.classList.remove('hidden');
        }

        // Gõ -> tìm
        input.addEventListener('input', debounceSearch);

        // Enter trong form
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            debounceSearch();
        });

        // Click nút kính lúp
        if (searchButton) {
            searchButton.addEventListener('click', function (e) {
                e.preventDefault();
                debounceSearch();
            });
        }

        // Ẩn dropdown khi click ra ngoài
        document.addEventListener('click', function (e) {
            const container = document.querySelector('[data-search-trigger]');
            const isClickInside =
                container.contains(e.target) || resultsBox.contains(e.target);

            if (!isClickInside) {
                resultsBox.classList.add('hidden');
            }
        });
    });
</script>

