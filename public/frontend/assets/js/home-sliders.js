// public/frontend/js/home-sliders.js

document.addEventListener('DOMContentLoaded', function () {
    initMainBanner();
    // Init cho Top bán chạy
    initCollectionSlider('[data-collection-code="top-san-ban-chay-toan-quoc"]');

    // Nếu sau này bạn có thêm:
    // initCollectionSlider('[data-collection-code="sieu-deals-online"]');
});

// --------- BANNER ---------
function initMainBanner() {
    const root = document.querySelector('.js-main-banner');
    if (!root) return;

    const swiperEl   = root.querySelector('.banner-swiper');
    const prevEl     = root.querySelector('.banner-prev');
    const nextEl     = root.querySelector('.banner-next');
    const pagination = root.querySelector('.banner-pagination');
    const customPrev = root.querySelector('.banner-custom-prev');
    const customNext = root.querySelector('.banner-custom-next');

    if (!swiperEl) return;

    const bannerSwiper = new Swiper(swiperEl, {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 5,
        pagination: {
            el: pagination,
            clickable: true,
        },
        navigation: {
            nextEl: nextEl,
            prevEl: prevEl,
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    });

    if (customPrev) customPrev.addEventListener('click', () => bannerSwiper.slidePrev());
    if (customNext) customNext.addEventListener('click', () => bannerSwiper.slideNext());
}

// --------- COLLECTION (Top sale / Siêu deal...) ---------
function initCollectionSlider(rootSelector) {
    const root = document.querySelector(rootSelector);
    if (!root) return;

    const swiperEl   = root.querySelector('.collection-swiper');
    const prevEl     = root.querySelector('.nav-prev');
    const nextEl     = root.querySelector('.nav-next');
    const customNext = root.querySelector('.collection-custom-next');

    if (!swiperEl) return;

    const slider = new Swiper(swiperEl, {
        loop: false,
        spaceBetween: 8,
        slidesPerView: 2,   // mobile

        breakpoints: {
            768: {
                slidesPerView: 'auto',
                slidesPerGroupAuto: true,
                spaceBetween: 16,
            }
        },

        navigation: {
            nextEl: nextEl,
            prevEl: prevEl,
        },
    });

    // nút tròn ngoài cùng bên phải
    if (customNext) {
        customNext.addEventListener('click', function () {
            slider.slideNext();
        });
    }

    // Ẩn/hiện nút khi ở đầu/cuối
    function updateButtons() {
        if (prevEl) {
            if (slider.isBeginning) {
                prevEl.style.opacity = '0';
                prevEl.style.pointerEvents = 'none';
            } else {
                prevEl.style.opacity = '1';
                prevEl.style.pointerEvents = '';
            }
        }

        const atEnd = slider.isEnd;

        if (nextEl) {
            if (atEnd) {
                nextEl.style.opacity = '0';
                nextEl.style.pointerEvents = 'none';
            } else {
                nextEl.style.opacity = '1';
                nextEl.style.pointerEvents = '';
            }
        }

        if (customNext) {
            if (atEnd) {
                customNext.style.opacity = '0';
                customNext.style.pointerEvents = 'none';
            } else {
                customNext.style.opacity = '1';
                customNext.style.pointerEvents = '';
            }
        }
    }

    updateButtons();
    slider.on('slideChange', updateButtons);
    slider.on('resize', updateButtons);
}
