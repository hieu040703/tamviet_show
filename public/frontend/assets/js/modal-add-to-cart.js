document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('addToCartModal');
    if (!modal) return;
    const openBtns = document.querySelectorAll('[data-qty-modal-trigger]');
    const closeBtns = modal.querySelectorAll('[data-modal-close]');
    const primaryBtn = document.getElementById('qtyModalPrimaryBtn');
    const labelSpan = document.getElementById('qtyModalPrimaryLabel');
    const modalWrapper = modal.querySelector('[data-qty="wrapper"]');
    const modalQtyInput = modalWrapper ? modalWrapper.querySelector('[data-qty="input"]') : null;
    const modalMinusBtn = modalWrapper ? modalWrapper.querySelector('[data-qty="minus"]') : null;
    const modalPlusBtn = modalWrapper ? modalWrapper.querySelector('[data-qty="plus"]') : null;

    function getModalQty() {
        if (!modalQtyInput) return 1;
        let v = parseInt(modalQtyInput.value, 10);
        if (isNaN(v) || v < 1) v = 1;
        return v;
    }

    function setModalQty(v) {
        if (!modalQtyInput) return;
        if (isNaN(v) || v < 1) v = 1;
        modalQtyInput.value = v;
        if (modalMinusBtn) {
            modalMinusBtn.disabled = v <= 1;
        }
    }

    setModalQty(1);
    if (modalPlusBtn && modalQtyInput) {
        modalPlusBtn.addEventListener('click', function () {
            setModalQty(getModalQty() + 1);
        });
    }
    if (modalMinusBtn && modalQtyInput) {
        modalMinusBtn.addEventListener('click', function () {
            setModalQty(getModalQty() - 1);
        });
    }

    function openModal(trigger) {
        const label = trigger.dataset.label || 'Thêm vào giỏ';
        const url = trigger.dataset.url || '';
        const action = trigger.dataset.action || 'cart';
        labelSpan.textContent = label;
        primaryBtn.dataset.url = url;
        primaryBtn.dataset.action = action;
        setModalQty(1);
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        setModalQty(1);
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

        const action = this.dataset.action || 'cart';
        const urlBase = this.dataset.url || '';
        const qty = getModalQty();
        if (action === 'cart') {
            const desktopQtyInput = document.querySelector('.hidden.md\\:block [data-qty="input"]');
            if (desktopQtyInput) {
                desktopQtyInput.value = qty;
                const desktopMinusBtn = document.querySelector('.hidden.md\\:block [data-qty="minus"]');
                if (desktopMinusBtn) {
                    desktopMinusBtn.disabled = qty <= 1;
                }
            }
            const desktopAddBtn = document.querySelector('.js-add-to-cart');
            if (desktopAddBtn) {
                desktopAddBtn.click();
            }
            closeModal();
            return;
        }
        if (!urlBase) return;
        const finalUrl = urlBase + (urlBase.includes('?') ? '&' : '?') + 'qty=' + encodeURIComponent(qty);
        window.location.href = finalUrl;
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
});
