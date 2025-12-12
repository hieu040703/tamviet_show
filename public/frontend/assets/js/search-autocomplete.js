document.addEventListener('DOMContentLoaded', function () {
    const desktopForm = document.querySelector('#boxSearchContainer form');
    const desktopInput = desktopForm ? desktopForm.querySelector('input[name="keyword"]') : null;
    const desktopResultsBox = document.getElementById('searchResults');
    const mobileInput = document.getElementById('search-input-mobile');
    const mobileResultsBox = document.getElementById('mobileSearchResultsHook');
    const mobileDialog = document.getElementById('mobile-search-dialog');

    function isMobile() {
        return window.matchMedia && window.matchMedia('(max-width: 767px)').matches;
    }

    function esc(s) {
        return String(s || '').replace(/[&<>"'`=\/]/g, c => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
            '/': '&#x2F;',
            '`': '&#x60;',
            '=': '&#x3D;'
        }[c]));
    }

    function ensureHtml(url) {
        if (!url) return '#';
        try {
            url = new URL(url, location.origin).toString();
        } catch (e) {
        }
        if (/\.(html)(?:$|\?)/i.test(url)) return url;
        if (url.indexOf('?') !== -1) {
            const p = url.split('?');
            return p[0].replace(/\/$/, '') + '.html?' + p[1];
        }
        return url.replace(/\/$/, '') + '.html';
    }

    function renderDesktop(data, kw) {
        if (!desktopResultsBox) return;
        const ok = (data.products && data.products.length) || (data.categories && data.categories.length) || (data.brands && data.brands.length) || (data.post_catalogues && data.post_catalogues.length) || (data.posts && data.posts.length);
        if (!ok) {
            desktopResultsBox.innerHTML = `<div class="search-empty">Không tìm thấy kết quả cho “<b>${esc(kw)}</b>”.</div>`;
            desktopResultsBox.classList.remove('hidden');
            return;
        }
        let h = `<div class="search-dropdown p-3 grid gap-2">`;
        const block = (title, items) => {
            if (!items || !items.length) return '';
            let s = `<div class="search-block"><p class="text-sm font-semibold mb-1">${title}</p><div class="grid gap-1">`;
            items.forEach(i => {
                const url = ensureHtml(i.canonical || i.url);
                const thumb = i.image ? `<div class="thumb"><img src="${esc(i.image)}" alt=""></div>` : `<div class="thumb"><span style="font-size:11px;color:#059669">${esc(title.charAt(0))}</span></div>`;
                s += `<a href="${url}">${thumb}<div class="search-result-meta"><span class="search-result-name">${esc(i.name)}</span></div></a>`;
            });
            s += `</div></div>`;
            return s;
        };
        h += block('Sản phẩm', data.products);
        h += block('Danh mục', data.categories);
        h += block('Thương hiệu', data.brands);
        h += block('Nhóm bài viết', data.post_catalogues);
        h += block('Bài viết', data.posts);
        h += '</div>';
        desktopResultsBox.innerHTML = h;
        desktopResultsBox.classList.remove('hidden');
    }

    function renderMobile(data, kw) {
        if (!mobileResultsBox) return;
        const has = (data.products?.length) || (data.posts?.length) || (data.categories?.length) || (data.brands?.length) || (data.post_catalogues?.length);
        if (!has) {
            mobileResultsBox.innerHTML = `<div style="padding:12px;color:#6b7280">Không tìm thấy kết quả cho “<b>${esc(kw)}</b>”.</div>`;
            return;
        }
        let html = '';
        const itemHtml = (label, it, letter) => {
            const url = ensureHtml(it.canonical || it.url);
            const img = it.image ? `<div style="width:56px;height:56px;border-radius:8px;overflow:hidden;background:#f3f4f6;flex-shrink:0"><img src="${esc(it.image)}" style="width:100%;height:100%;object-fit:cover"></div>` : `<div style="width:56px;height:56px;border-radius:8px;background:#eef2ff;display:grid;place-items:center;color:#0ea5a4">${esc(letter)}</div>`;
            return `<a class="result-item flex gap-3 p-2" href="${esc(url)}">${img}<div style="flex:1;min-width:0"><div style="font-size:12px;color:#6b7280;margin-bottom:6px">${esc(label)}</div><div class="line-clamp-2" style="font-size:15px">${esc(it.name)}</div></div></a>`;
        };
        if (data.products?.length) {
            html += `<div class="search-block"><div style="font-weight:700;margin-bottom:6px">Sản phẩm</div>`;
            data.products.forEach(p => html += itemHtml('Sản phẩm', p, 'S'));
            html += `</div>`;
        }
        if (data.posts?.length) {
            html += `<div class="search-block"><div style="font-weight:700;margin-bottom:6px">Bài viết</div>`;
            data.posts.forEach(p => html += itemHtml('Bài viết', p, 'B'));
            html += `</div>`;
        }
        if (data.categories?.length) {
            html += `<div class="search-block"><div style="font-weight:700;margin-bottom:6px">Danh mục</div>`;
            data.categories.forEach(c => html += itemHtml('Danh mục', c, 'D'));
            html += `</div>`;
        }
        if (data.brands?.length) {
            html += `<div class="search-block"><div style="font-weight:700;margin-bottom:6px">Thương hiệu</div>`;
            data.brands.forEach(b => html += itemHtml('Thương hiệu', b, 'T'));
            html += `</div>`;
        }
        if (data.post_catalogues?.length) {
            html += `<div class="search-block"><div style="font-weight:700;margin-bottom:6px">Nhóm bài viết</div>`;
            data.post_catalogues.forEach(pc => html += itemHtml('Nhóm bài viết', pc, 'N'));
            html += `</div>`;
        }
        mobileResultsBox.innerHTML = html;
    }

    function setLoadingDesktop() {
        if (desktopResultsBox) desktopResultsBox.innerHTML = `<div class="search-empty">Đang tìm...</div>`, desktopResultsBox.classList.remove('hidden');
    }

    function setLoadingMobile() {
        if (mobileResultsBox) mobileResultsBox.innerHTML = `<div style="padding:12px;color:#6b7280">Đang tìm...</div>`;
    }

    function doSearchRaw(kw) {
        return fetch('/ajax/search?keyword=' + encodeURIComponent(kw)).then(r => r.json());
    }

    let debounceTimer = null;

    function doSearch(kw, target) {
        if (!kw) {
            if (target === 'mobile' && mobileResultsBox) mobileResultsBox.innerHTML = '';
            if (target === 'desktop' && desktopResultsBox) {
                desktopResultsBox.classList.add('hidden');
                desktopResultsBox.innerHTML = '';
            }
            return;
        }
        if (debounceTimer) clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            if (target === 'mobile' || (typeof target === 'undefined' && isMobile())) {
                setLoadingMobile();
                if (desktopResultsBox) desktopResultsBox.classList.add('hidden');
            } else {
                setLoadingDesktop();
                if (mobileDialog && mobileDialog.dataset.state === 'open') {
                    mobileDialog.dataset.state = 'closed';
                    mobileDialog.style.display = 'none';
                    mobileDialog.classList.add('hidden');
                    mobileDialog.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = '';
                    document.documentElement.style.overflow = '';
                }
            }

            doSearchRaw(kw).then(res => {
                if (!(res && res.status === 'success')) {
                    if (target === 'mobile' || (typeof target === 'undefined' && isMobile())) {
                        if (mobileResultsBox) mobileResultsBox.innerHTML = `<div style="padding:12px;color:#ef4444">Có lỗi khi tìm, thử lại.</div>`;
                    } else {
                        if (desktopResultsBox) desktopResultsBox.innerHTML = `<div class="search-empty">Có lỗi khi tìm, thử lại.</div>`;
                    }
                    return;
                }
                if (target === 'mobile' || (typeof target === 'undefined' && isMobile())) {
                    renderMobile(res.data, kw);
                } else {
                    renderDesktop(res.data, kw);
                }
            }).catch(() => {
                if (target === 'mobile' || (typeof target === 'undefined' && isMobile())) {
                    if (mobileResultsBox) mobileResultsBox.innerHTML = `<div style="padding:12px;color:#ef4444">Có lỗi khi tìm, thử lại.</div>`;
                } else {
                    if (desktopResultsBox) desktopResultsBox.innerHTML = `<div class="search-empty">Có lỗi khi tìm, thử lại.</div>`;
                }
            });
        }, 200);
    }

    window.searchAutocomplete = {
        doSearch: doSearch
    };
    if (desktopInput) {
        desktopInput.addEventListener('input', function () {
            if (isMobile()) {
                const trigger = document.getElementById('open-mobile-search');
                if (trigger) trigger.click();
                return;
            }
            const kw = desktopInput.value.trim();
            doSearch(kw, 'desktop');
        });

        desktopForm.addEventListener('submit', function (e) {
            e.preventDefault();
            if (isMobile()) {
                const trigger = document.getElementById('open-mobile-search');
                if (trigger) trigger.click();
                return;
            }
            const kw = desktopInput.value.trim();
            doSearch(kw, 'desktop');
        });
        document.addEventListener('click', function (e) {
            const c = document.querySelector('[data-search-trigger]');
            if (!c) return;
            if (!c.contains(e.target) && desktopResultsBox && !desktopResultsBox.contains(e.target)) {
                desktopResultsBox.classList.add('hidden');
            }
        });
    }
    if (mobileInput) {
        mobileInput.addEventListener('input', function () {
            const v = mobileInput.value.trim();
            doSearch(v, 'mobile');
        });
        mobileInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const v = mobileInput.value.trim();
                if (v) doSearch(v, 'mobile');
            }
        }, {passive: false});
    }
});
