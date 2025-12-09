document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const categoryPage = document.getElementById('category-page');
    if (!categoryPage) return;

    const filterUrl = categoryPage.dataset.filterUrl || '';
    const loadMoreUrl = categoryPage.dataset.loadMoreUrl || '';
    const initialLimit = parseInt(categoryPage.dataset.initialLimit || '20', 10);

    const brandSearchInput = document.getElementById('brand-search');
    const brandCheckboxes = document.querySelectorAll('.js-filter-brand');
    const sortButtons = document.querySelectorAll('.js-sort-btn');
    const productListWrapper = document.getElementById('product-list-wrapper');
    const loadMoreWrapper = document.getElementById('loadMoreWrapper');
    const resetBtn = document.getElementById('btn-filter-reset');

    let loadMoreBtn = document.getElementById('loadMoreBtn');
    let currentSort = 'name_asc';
    let isLoading = false;
    let hasMore = categoryPage.dataset.hasMore === '1';
    let offset = initialLimit;

    function setButtonLoading(button, loadingText) {
        if (!button) return;
        if (button.dataset.originalText == null) {
            button.dataset.originalText = button.textContent.trim();
        }
        if (loadingText) {
            button.disabled = true;
            button.classList.add('opacity-60', 'cursor-not-allowed');
            button.textContent = loadingText;
        } else {
            button.disabled = false;
            button.classList.remove('opacity-60', 'cursor-not-allowed');
            button.textContent = button.dataset.originalText || '';
        }
    }

    function refreshLoadMoreBtn() {
        loadMoreBtn = document.getElementById('loadMoreBtn');
    }

    function updateLoadMoreVisibility() {
        refreshLoadMoreBtn();
        if (!loadMoreWrapper || !loadMoreBtn) {
            if (loadMoreWrapper) loadMoreWrapper.classList.add('hidden');
            return;
        }
        if (!hasMore) {
            loadMoreWrapper.classList.add('hidden');
        } else {
            loadMoreWrapper.classList.remove('hidden');
        }
    }

    function updateSortUI() {
        sortButtons.forEach(btn => {
            const sortValue = btn.getAttribute('data-sort') || '';
            if (sortValue === currentSort) {
                btn.classList.add('border-primary-500', 'text-primary-500');
                btn.classList.remove('border-neutral-700', 'text-neutral-700');
            } else {
                btn.classList.remove('border-primary-500', 'text-primary-500');
                btn.classList.add('border-neutral-700', 'text-neutral-700');
            }
        });
    }

    function getFilters() {
        const brandKeyword = brandSearchInput ? brandSearchInput.value.trim() : '';
        const brands = [];
        brandCheckboxes.forEach(cb => {
            if (cb.checked) brands.push(cb.value);
        });
        return {
            sort: currentSort,
            brand_keyword: brandKeyword,
            brands: brands,
            brand_ids: brands
        };
    }

    async function applyFilter() {
        if (!filterUrl || isLoading) return;
        isLoading = true;
        refreshLoadMoreBtn();
        if (loadMoreBtn) setButtonLoading(loadMoreBtn, 'Đang tải...');

        const payload = Object.assign({}, getFilters(), {
            limit: initialLimit
        });

        try {
            const response = await fetch(filterUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                console.error('Lỗi filter sản phẩm:', response.status);
                return;
            }

            const data = await response.json();

            // GIỮ NGUYÊN <div class="product-list ... id="product-list-inner">
            const listEl = document.getElementById('product-list-inner');
            if (listEl && typeof data.html === 'string') {
                listEl.innerHTML = data.html;
            }

            hasMore = !!data.has_more;
            categoryPage.dataset.hasMore = hasMore ? '1' : '0';
            offset = initialLimit;

            // nếu cần, đảm bảo luôn có nút Xem thêm mới
            if (hasMore) {
                if (!document.getElementById('loadMoreBtn') && loadMoreWrapper) {
                    loadMoreWrapper.innerHTML =
                        '<button id="loadMoreBtn" class="px-4 py-2 border border-primary-500 text-primary-500 rounded-lg text-sm md:h-12 md:w-[256px] md:text-base">Xem thêm</button>';
                }
            } else if (loadMoreWrapper) {
                loadMoreWrapper.classList.add('hidden');
                loadMoreWrapper.innerHTML = '';
            }

            updateSortUI();
            updateLoadMoreVisibility();
            bindLoadMore();
        } catch (e) {
            console.error('applyFilter error:', e);
        } finally {
            isLoading = false;
            refreshLoadMoreBtn();
            if (loadMoreBtn) setButtonLoading(loadMoreBtn, null);
        }
    }

    async function loadMore() {
        refreshLoadMoreBtn();
        if (!loadMoreUrl || isLoading || !hasMore || !loadMoreBtn) return;

        isLoading = true;
        setButtonLoading(loadMoreBtn, 'Đang tải...');

        const currentOffset = offset;
        const payload = Object.assign({}, getFilters(), {
            offset: currentOffset,
            limit: initialLimit
        });

        try {
            const response = await fetch(loadMoreUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                console.error('Lỗi load thêm sản phẩm:', response.status);
                return;
            }

            const data = await response.json();
            const listEl = document.getElementById('product-list-inner');
            if (listEl && typeof data.html === 'string') {
                listEl.insertAdjacentHTML('beforeend', data.html);
            }

            hasMore = !!data.has_more;
            categoryPage.dataset.hasMore = hasMore ? '1' : '0';
            offset = currentOffset + initialLimit;

            if (!hasMore && loadMoreBtn) {
                loadMoreBtn.remove();
            }
            updateLoadMoreVisibility();
        } catch (e) {
            console.error('loadMore error:', e);
        } finally {
            isLoading = false;
            refreshLoadMoreBtn();
            if (loadMoreBtn) setButtonLoading(loadMoreBtn, null);
        }
    }

    sortButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const sortValue = this.getAttribute('data-sort') || '';
            if (!sortValue || sortValue === currentSort) return;
            currentSort = sortValue;
            applyFilter();
        });
    });

    if (brandSearchInput) {
        let timer = null;
        brandSearchInput.addEventListener('input', function () {
            if (timer) clearTimeout(timer);
            timer = setTimeout(function () {
                applyFilter();
            }, 400);
        });
    }

    brandCheckboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            applyFilter();
        });
    });

    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            if (brandSearchInput) brandSearchInput.value = '';
            brandCheckboxes.forEach(cb => cb.checked = false);
            currentSort = 'name_asc';
            applyFilter();
        });
    }

    function bindLoadMore() {
        refreshLoadMoreBtn();
        if (!loadMoreBtn) return;
        loadMoreBtn.onclick = function () {
            loadMore();
        };
    }

    updateSortUI();
    bindLoadMore();
    updateLoadMoreVisibility();
});

