(function () {
    const root = document.getElementById('category-page');
    if (!root) return;

    const FILTER_URL    = root.dataset.filterUrl;
    const LOAD_MORE_URL = root.dataset.loadMoreUrl;
    const INITIAL_LIMIT = parseInt(root.dataset.initialLimit || '0', 10) || 12;

    const productWrapper  = document.getElementById('product-list-wrapper');
    const brandSearch     = document.getElementById('brand-search');
    const brandList       = document.getElementById('brand-list');
    const resetBtn        = document.getElementById('btn-filter-reset');
    const loadMoreWrapper = document.getElementById('loadMoreWrapper');
    function getSelectedBrands() {
        return Array.from(document.querySelectorAll('.js-filter-brand:checked'))
            .map(function (el) {
                return el.value;
            });
    }

    function getActiveSort() {
        const active = document.querySelector('.js-sort-btn.active');
        return active ? active.dataset.sort : null;
    }

    function setActiveSort(btn) {
        const buttons = document.querySelectorAll('.js-sort-btn');

        buttons.forEach(function (b) {
            b.classList.remove('active');
            // về trạng thái default
            b.classList.remove('border-primary-500', 'text-primary-500');
            b.classList.add('border-neutral-700', 'text-neutral-700');
        });

        if (btn) {
            btn.classList.add('active');
            // trạng thái chọn
            btn.classList.remove('border-neutral-700', 'text-neutral-700');
            btn.classList.add('border-primary-500', 'text-primary-500');
        }
    }

    function buildQuery() {
        const params = new URLSearchParams();
        const brands = getSelectedBrands();
        const sort   = getActiveSort();

        brands.forEach(function (id) {
            params.append('brands[]', id);
        });

        if (sort) {
            params.set('sort', sort);
        }

        return params;
    }
    async function fetchProducts() {
        const params = buildQuery();
        params.set('limit', INITIAL_LIMIT);

        const url = FILTER_URL + '?' + params.toString();

        try {
            const res  = await fetch(url, {
                headers: {'X-Requested-With': 'XMLHttpRequest'}
            });
            const data = await res.json();

            if (productWrapper && data.html !== undefined) {
                productWrapper.innerHTML = data.html;
            }

            if (loadMoreWrapper) {
                if (data.has_more) {
                    loadMoreWrapper.classList.remove('hidden');
                    if (!loadMoreWrapper.querySelector('#loadMoreBtn')) {
                        loadMoreWrapper.innerHTML =
                            '<button id="loadMoreBtn" data-offset="' + INITIAL_LIMIT + '" class="px-4 py-2 border border-primary-500 text-primary-500 rounded-lg text-sm md:h-12 md:w-[256px] md:text-base">Xem thêm</button>';
                    } else {
                        const btn = loadMoreWrapper.querySelector('#loadMoreBtn');
                        btn.dataset.offset = INITIAL_LIMIT;
                    }
                } else {
                    loadMoreWrapper.classList.add('hidden');
                    loadMoreWrapper.innerHTML = '';
                }
            }

        } catch (e) {
            console.error('Filter error', e);
        }
    }

    function filterBrands() {
        if (!brandSearch || !brandList) return;
        const keyword = brandSearch.value.toLowerCase().trim();
        const items   = brandList.querySelectorAll('label');
        items.forEach(function (label) {
            const text = label.getAttribute('data-name') || label.textContent.toLowerCase();
            if (!keyword || text.indexOf(keyword) !== -1) {
                label.style.display = '';
            } else {
                label.style.display = 'none';
            }
        });
    }
    function bindLoadMore() {
        const btn       = document.getElementById('loadMoreBtn');
        const listInner = document.getElementById('product-list-inner');
        if (!btn || !listInner) return;

        btn.addEventListener('click', async function () {
            const currentOffset = parseInt(this.dataset.offset || INITIAL_LIMIT, 10);
            const params        = buildQuery();
            params.set('offset', currentOffset);
            params.set('limit', INITIAL_LIMIT);
            const url = LOAD_MORE_URL + '?' + params.toString();

            try {
                const res  = await fetch(url, {
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                });
                const data = await res.json();
                if (data.html) {
                    listInner.insertAdjacentHTML('beforeend', data.html);
                }
                const nextOffset = currentOffset + INITIAL_LIMIT;
                this.dataset.offset = nextOffset;
                if (!data.has_more) {
                    this.remove();
                }
            } catch (err) {
                console.error('Load more error', err);
            }
        });
    }
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('js-filter-brand')) {
            fetchProducts().then(bindLoadMore);
        }
    });
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.js-sort-btn');
        if (btn) {
            setActiveSort(btn);
            fetchProducts().then(bindLoadMore);
        }
    });
    if (brandSearch) {
        brandSearch.addEventListener('input', filterBrands);
    }
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            document.querySelectorAll('.js-filter-brand').forEach(function (cb) {
                cb.checked = false;
            });
            if (brandSearch) {
                brandSearch.value = '';
                filterBrands();
            }
            const defaultSort = document.querySelector('.js-sort-btn[data-sort="name_asc"]');
            setActiveSort(defaultSort);
            fetchProducts().then(bindLoadMore);
        });
    }
    const firstSortBtn = document.querySelector('.js-sort-btn[data-sort="name_asc"]');
    if (firstSortBtn) {
        setActiveSort(firstSortBtn);
    }
    bindLoadMore();
    if (loadMoreWrapper) {
        const observer = new MutationObserver(function () {
            bindLoadMore();
        });
        observer.observe(loadMoreWrapper, {childList: true});
    }
})();
