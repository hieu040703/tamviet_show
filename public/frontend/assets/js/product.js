document.addEventListener('DOMContentLoaded', function () {
    let thumbsSwiper = new Swiper('.product-media-slide-thumbnail', {
        spaceBetween: 12,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true
    });

    let mainSwiper = new Swiper('.product-media-slide', {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
            nextEl: '.product-media-slide .swiper-button-next',
            prevEl: '.product-media-slide .swiper-button-prev'
        },
        thumbs: {swiper: thumbsSwiper}
    });

    const counterEl = document.querySelector('.product-media-counter');
    if (counterEl) {
        const updateCounter = () => {
            const total = mainSwiper.slides.length;
            counterEl.textContent = (mainSwiper.realIndex + 1) + '/' + total;
        };
        updateCounter();
        mainSwiper.on('slideChange', updateCounter);
    }

    if (!window.productAlbumData) {
        window.productAlbumData = {
            defaultAlbum: [],
            productImage: '',
            variants: []
        };
    }

    const selectedAttributes = {};
    const selectedAttributeNames = {};
    const attributeBtns = document.querySelectorAll('.size-btn');
    const productTitle = document.getElementById('productTitle');
    const originalTitle = productTitle ? productTitle.textContent.trim() : '';

    function updateProductTitle() {
        if (!productTitle) return;

        const attributeText = Object.values(selectedAttributeNames).filter(Boolean).join(' - ');

        if (attributeText) {
            productTitle.textContent = originalTitle + ' - (' + attributeText + ')';
        } else {
            productTitle.textContent = originalTitle;
        }
    }

    function updateAlbum(album) {
        const mainWrapper = document.getElementById('mainSwiperWrapper');
        const thumbWrapper = document.getElementById('thumbSwiperWrapper');
        const notFoundImg = '/backend/img/not-found.jpg';

        if (!mainWrapper || !thumbWrapper) return;

        let images = [];
        if (album && album.length > 0) {
            images = album;
        } else if (window.productAlbumData.defaultAlbum.length > 0) {
            images = window.productAlbumData.defaultAlbum;
        } else if (window.productAlbumData.productImage) {
            images = [window.productAlbumData.productImage];
        } else {
            images = [notFoundImg];
        }

        const getImagePath = (img) => {
            if (!img) return notFoundImg;
            if (img.startsWith('http://') || img.startsWith('https://')) {
                return img;
            }
            if (img.startsWith('/')) {
                return img;
            }
            return '/storage/' + img;
        };

        const mainHTML = images.map((img, index) => `
            <div class="swiper-slide relative cursor-pointer">
                <img
                    class="h-full w-full object-cover"
                    src="${getImagePath(img)}"
                    alt="Product image ${index + 1}"
                    loading="lazy"
                    onerror="this.src='${notFoundImg}'"
                >
                <div class="absolute bottom-0 z-[1] flex h-12 w-full md:h-[54px]"></div>
            </div>
        `).join('');

        const thumbHTML = images.map((img, index) => `
            <div class="swiper-slide relative mr-3 aspect-square !w-[20%] cursor-pointer">
                <img
                    class="w-full h-full object-cover"
                    src="${getImagePath(img)}"
                    alt="Thumbnail ${index + 1}"
                    loading="lazy"
                    onerror="this.src='${notFoundImg}'"
                >
            </div>
        `).join('');

        mainWrapper.innerHTML = mainHTML;
        thumbWrapper.innerHTML = thumbHTML;

        if (mainSwiper) mainSwiper.destroy(true, true);
        if (thumbsSwiper) thumbsSwiper.destroy(true, true);

        thumbsSwiper = new Swiper('.product-media-slide-thumbnail', {
            spaceBetween: 12,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true
        });

        mainSwiper = new Swiper('.product-media-slide', {
            slidesPerView: 1,
            spaceBetween: 0,
            navigation: {
                nextEl: '.product-media-slide .swiper-button-next',
                prevEl: '.product-media-slide .swiper-button-prev'
            },
            thumbs: {swiper: thumbsSwiper}
        });

        if (counterEl) {
            const total = images.length;
            counterEl.textContent = total > 1 ? '1/' + total : '';

            mainSwiper.on('slideChange', function() {
                counterEl.textContent = (mainSwiper.realIndex + 1) + '/' + total;
            });
        }
    }

    function findMatchingVariant() {
        if (!window.productAlbumData || !window.productAlbumData.variants) {
            return null;
        }

        const variants = window.productAlbumData.variants;
        const selectedKeys = Object.keys(selectedAttributes);

        if (selectedKeys.length === 0) {
            return null;
        }

        return variants.find(variant => {
            if (!variant.attribute_values) return false;

            return selectedKeys.every(catalogueId => {
                const selectedValue = selectedAttributes[catalogueId];
                const variantValue = variant.attribute_values[catalogueId];
                return variantValue && variantValue.toString() === selectedValue.toString();
            });
        });
    }

    attributeBtns.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            try {
                const section = this.closest('.attribute-section');
                const catalogueId = section.dataset.catalogueId;
                const valueId = this.dataset.valueId;
                const valueName = this.dataset.valueName;
                const catalogueName = this.dataset.catalogueName;

                if (!catalogueId || !valueId) {
                    console.warn('Missing catalogueId or valueId');
                    return;
                }

                section.querySelectorAll('.size-btn').forEach(b => {
                    b.classList.remove('active-attribute');
                });

                this.classList.add('active-attribute');

                selectedAttributes[catalogueId] = valueId;
                selectedAttributeNames[catalogueId] = valueName;

                updateProductTitle();

                const matchedVariant = findMatchingVariant();

                console.log('Matched variant:', matchedVariant);

                if (matchedVariant && matchedVariant.album && matchedVariant.album.length > 0) {
                    console.log('Using variant album:', matchedVariant.album);
                    updateAlbum(matchedVariant.album);
                } else {
                    const variants = window.productAlbumData.variants;
                    const allButtons = section.querySelectorAll('.size-btn');
                    const buttonIndex = Array.from(allButtons).indexOf(this);

                    if (variants[buttonIndex] && variants[buttonIndex].album && variants[buttonIndex].album.length > 0) {
                        console.log('Using variant by index:', buttonIndex, variants[buttonIndex].album);
                        updateAlbum(variants[buttonIndex].album);
                    } else {
                        console.log('Using default album');
                        updateAlbum(window.productAlbumData.defaultAlbum);
                    }
                }
            } catch (error) {
                console.error('Error in attribute button click:', error);
            }
        });
    });

    const wrapper = document.querySelector('#product-description-wrapper .group');
    if (wrapper) {
        const content = document.getElementById('product-description-content');
        const overlay = wrapper.querySelector('[data-role="description-overlay"]');
        const buttons = document.querySelectorAll('[data-role="toggle-description"]');

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
                    b.textContent = b.classList.contains('md:hidden') ? 'Xem chi tiết' : 'Xem thêm';
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
            const finalUrl = urlBase + (urlBase.includes('?') ? '&' : '?') + 'qty=' + encodeURIComponent(qty);
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
