document.addEventListener('DOMContentLoaded', function () {
    var thumbsSwiper = new Swiper('.product-media-slide-thumbnail', {
        spaceBetween: 12,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true
    });

    var mainSwiper = new Swiper('.product-media-slide', {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
            nextEl: '.product-media-slide .swiper-button-next',
            prevEl: '.product-media-slide .swiper-button-prev'
        },
        thumbs: {swiper: thumbsSwiper}
    });

    var counterEl = document.querySelector('.product-media-counter');
    if (counterEl) {
        var total = mainSwiper.slides.length;

        function updateCounter() {
            counterEl.textContent = (mainSwiper.realIndex + 1) + '/' + total;
        }

        updateCounter();
        mainSwiper.on('slideChange', updateCounter);
    }
    var wrapper = document.querySelector('#product-description-wrapper .group');
    if (wrapper) {
        var content = document.getElementById('product-description-content');
        var overlay = wrapper.querySelector('[data-role="description-overlay"]');
        var buttons = document.querySelectorAll('[data-role="toggle-description"]');

        function setState(isOpen) {
            if (isOpen) {
                wrapper.dataset.state = 'open';
                content.dataset.state = 'open';
                if (overlay) overlay.style.display = 'none';

                buttons.forEach(function (b) {
                    b.dataset.state = 'open';
                    b.setAttribute('aria-expanded', 'true');
                    b.textContent = 'Thu gọn';
                });
            } else {
                wrapper.dataset.state = 'closed';
                content.dataset.state = 'closed';
                if (overlay) overlay.style.display = '';

                buttons.forEach(function (b) {
                    b.dataset.state = 'closed';
                    b.setAttribute('aria-expanded', 'false');
                    b.textContent =
                        b.classList.contains('md:hidden') ? 'Xem chi tiết' : 'Xem thêm';
                });
            }
        }

        buttons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                setState(wrapper.dataset.state !== 'open');
            });
        });
    }

    const modal = document.getElementById('addToCartModal');
    if (modal) {
        const openBtns = document.querySelectorAll('[data-qty-modal-trigger]');
        const closeBtns = modal.querySelectorAll('[data-modal-close]');
        const primaryBtn = document.getElementById('qtyModalPrimaryBtn');
        const labelSpan = document.getElementById('qtyModalPrimaryLabel');
        const qtyInput = modal.querySelector('[data-qty-input]');

        function openModal(trigger) {
            const label = trigger.dataset.label || 'Thêm vào giỏ';
            const url = trigger.dataset.url || '#';
            const action = trigger.dataset.action || 'cart';
            labelSpan.textContent = label;
            primaryBtn.dataset.url = url;
            primaryBtn.dataset.action = action;
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        openBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                openModal(this);
            });
        });
        closeBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                closeModal();
            });
        });
        primaryBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const urlBase = this.dataset.url || '#';
            const qty = qtyInput ? (qtyInput.value || 1) : 1;
            const finalUrl =
                urlBase +
                (urlBase.includes('?') ? '&' : '?') +
                'qty=' + encodeURIComponent(qty);
            window.location.href = finalUrl;
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    }
    if (document.querySelector('.product-playlist')) {
        new Swiper('.product-playlist', {
            slidesPerView: 2,
            spaceBetween: 10,
            navigation: {
                nextEl: '.product-playlist .swiper-button-next',
                prevEl: '.product-playlist .swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 4,
                    spaceBetween: 16
                }
            }
        });
    }
});
