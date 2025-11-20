

document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper is not loaded');
        return;
    }

    var container = document.querySelector('.custom-swiper-navigation');
    if (!container) return;

    var wrapper = container.querySelector('.swiper-wrapper');
    if (!wrapper) return;
    var slidesCount = wrapper.children.length;

    var prevBtn = container.parentElement.querySelector('.custom-swiper-button-prev');
    var nextBtn = container.parentElement.querySelector('.custom-swiper-button-next');

    function hideAllNav() {
        if (prevBtn) {
            prevBtn.classList.add('swiper-button-disabled');
        }
        if (nextBtn) {
            nextBtn.classList.add('swiper-button-disabled');
        }
    }
    var swiper = new Swiper(container, {
        slidesPerView: 1.2,
        spaceBetween: 16,
        navigation: {
            prevEl: prevBtn,
            nextEl: nextBtn,
        },
        watchOverflow: true,
        breakpoints: {
            768: {
                slidesPerView: 3,
                spaceBetween: 16
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 16
            }
        },
        on: {
            init: function (sw) {
                if (slidesCount <= sw.params.slidesPerView) {
                    hideAllNav();
                }
            }
        }
    });
});
