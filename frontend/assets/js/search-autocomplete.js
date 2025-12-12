document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#boxSearchContainer form');
    const input = form.querySelector('input[name="keyword"]');
    const resultsBox = document.getElementById('searchResults');
    const searchButton = document.querySelector('[data-search-trigger] button');
    let timer = null;

    function ensureHtml(url) {
        if (!url) return '#';
        try {
            url = new URL(url, location.origin).toString()
        } catch (e) {
        }
        if (/\.(html)(?:$|\?)/i.test(url)) return url;
        if (url.indexOf('?') !== -1) {
            const p = url.split('?');
            return p[0].replace(/\/$/, '') + '.html?' + p[1]
        }
        return url.replace(/\/$/, '') + '.html'
    }

    function escapeHtml(s) {
        return String(s || '').replace(/[&<>"'`=\/]/g, function (c) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '/': '&#x2F;',
                '`': '&#x60;',
                '=': '&#x3D;'
            }[c]
        })
    }

    function block(title, items, type) {
        if (!items || !items.length) return '';
        let h = `<div class="search-block"><p class="text-sm font-semibold mb-1">${title}</p><div class="grid gap-1">`;
        items.forEach(function (i) {
            const url = ensureHtml(i.canonical ? i.canonical : i.url);
            const thumb = i.image ? `<div class="thumb"><img src="${i.image}" alt=""></div>` : `<div class="thumb"><span style="font-size:11px;color:#059669">${title[0]}</span></div>`;
            h += `<a href="${url}">${thumb}<div class="search-result-meta"><span class="search-result-name">${escapeHtml(i.name)}</span></div></a>`
        });
        return h + '</div></div>'
    }

    function render(data, keyword) {
        const ok = (data.products && data.products.length) || (data.categories && data.categories.length) || (data.brands && data.brands.length) || (data.post_catalogues && data.post_catalogues.length) || (data.posts && data.posts.length);
        if (!ok) {
            resultsBox.innerHTML = `<div class="search-empty">Không tìm thấy kết quả cho “<b>${escapeHtml(keyword)}</b>”.</div>`;
            resultsBox.classList.remove('hidden');
            return
        }
        let h = `<div class="search-dropdown p-3 grid gap-2">`;
        h += block('Sản phẩm', data.products, 'Sản phẩm');
        h += block('Danh mục', data.categories, 'Danh mục');
        h += block('Thương hiệu', data.brands, 'Thương hiệu');
        h += block('Nhóm bài viết', data.post_catalogues, 'Nhóm bài viết');
        h += block('Bài viết', data.posts, 'Bài viết');
        h += '</div>';
        resultsBox.innerHTML = h;
        resultsBox.classList.remove('hidden')
    }

    function doSearch(kw) {
        fetch('/ajax/search?keyword=' + encodeURIComponent(kw)).then(r => r.json()).then(res => {
            if (res.status === 'success') render(res.data, kw)
        }).catch(() => {
        })
    }

    function debounce() {
        clearTimeout(timer);
        const kw = input.value.trim();
        if (!kw) {
            resultsBox.classList.add('hidden');
            resultsBox.innerHTML = '';
            return
        }
        timer = setTimeout(function () {
            doSearch(kw)
        }, 250)
    }

    input.addEventListener('input', debounce);
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        debounce()
    });
    if (searchButton) searchButton.addEventListener('click', function (e) {
        e.preventDefault();
        debounce()
    });
    document.addEventListener('click', function (e) {
        const c = document.querySelector('[data-search-trigger]');
        if (!c.contains(e.target) && !resultsBox.contains(e.target)) resultsBox.classList.add('hidden')
    })
});
