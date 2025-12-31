(function () {
    // Chuyển chuỗi thành slug (bỏ dấu, ký tự lạ, khoảng trắng -> "-")
    function toSlug(str) {
        if (!str) return "";
        let s = String(str)
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')  // bỏ dấu
            .replace(/đ/gi, m => (m === 'đ' ? 'd' : 'D'))      // đ -> d
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')                       // ký tự lạ -> -
            .replace(/-+/g, '-')                                // gộp -
            .replace(/^-|-$/g, '');                             // cắt - đầu/cuối
        return s;
    }
    window.toSlug = toSlug; // nếu cần gọi ngoài

    // debounce đơn giản
    function debounce(fn, wait) {
        let t; return function () { clearTimeout(t); t = setTimeout(() => fn.apply(this, arguments), wait); };
    }

    // Khi người dùng gõ tay vào slug, coi như manual -> khóa auto
    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('js-slug-target')) {
            e.target.dataset.manual = '1';
        }
    });

    // Double click vào slug để mở khóa auto rồi sync lại theo Title
    document.addEventListener('dblclick', function (e) {
        if (!e.target.classList.contains('js-slug-target')) return;
        delete e.target.dataset.manual;
        const form = e.target.closest('form') || document;
        const source = form.querySelector('.js-slug-source[data-target="#' + e.target.id + '"]');
        if (source) {
            e.target.value = toSlug(source.value || '');
        }
    });

    // Nút "Tạo lại" (không cần viết thêm ở Blade ngoài data-target)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.js-slug-regen');
        if (!btn) return;
        const targetSel = btn.getAttribute('data-target');
        const target = document.querySelector(targetSel);
        if (!target) return;

        const form = target.closest('form') || document;
        const source = form.querySelector('.js-slug-source[data-target="' + targetSel + '"]');
        if (!source) return;

        delete target.dataset.manual;             // mở khóa auto
        target.value = toSlug(source.value || ''); // sync lại
    });

    // Bind tự động: khi gõ Title thì set Slug nếu chưa manual
    function bindAutoSlug() {
        const sources = document.querySelectorAll('.js-slug-source');
        sources.forEach(src => {
            const targetSel = src.getAttribute('data-target');
            if (!targetSel) return;
            const target = document.querySelector(targetSel);
            if (!target) return;

            const handler = debounce(function () {
                if (target.dataset.manual === '1') return;
                target.value = toSlug(src.value || '');
            }, 80);

            src.addEventListener('input', handler);
            src.addEventListener('paste', handler);

            // Lúc load trang:
            // - Nếu slug rỗng (trang thêm hoặc edit chưa set), tự fill theo Title
            // - Nếu slug có sẵn (trang sửa), giữ nguyên (đã có data-manual="1" ở Blade)
            if (!target.value) handler();
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bindAutoSlug);
    } else {
        bindAutoSlug();
    }
})();
