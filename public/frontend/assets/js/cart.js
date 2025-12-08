document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const ROUTES = window.APP_ROUTES || {};

    const cartToast = document.getElementById('tv-cart-toast');
    const cartToastMessage = document.getElementById('tv-cart-toast-message');
    let cartToastTimer = null;

    function showCartToast(message) {
        if (!cartToast) return;
        if (cartToastMessage && message) {
            cartToastMessage.textContent = message;
        }
        cartToast.style.display = 'block';
        if (cartToastTimer) {
            clearTimeout(cartToastTimer);
        }
        cartToastTimer = setTimeout(function () {
            cartToast.style.display = 'none';
        }, 2500);
    }

    function updateHeaderCartCount(count) {
        const badges = document.querySelectorAll('[data-cart-count],[data-cart-count-mobile]');
        if (!badges.length) return;

        badges.forEach(function (badge) {
            badge.textContent = count;
            if (count > 0) {
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        });
    }


    function getCurrentHeaderCartCount() {
        const firstBadge = document.querySelector('[data-cart-count]');
        if (!firstBadge) return 0;
        const v = parseInt(firstBadge.textContent, 10);
        if (isNaN(v) || v < 0) return 0;
        return v;
    }

    (function handlePdpQuantity() {
        const qtyWrapper = document.querySelector('[data-qty="wrapper"]');
        if (!qtyWrapper) return;

        const input = qtyWrapper.querySelector('[data-qty="input"]');
        const btnMinus = qtyWrapper.querySelector('[data-qty="minus"]');
        const btnPlus = qtyWrapper.querySelector('[data-qty="plus"]');
        if (!input) return;

        const min = parseInt(input.dataset.min || '1', 10);
        const max = 99;

        function clamp(v) {
            v = parseInt(v, 10);
            if (isNaN(v) || v < min) v = min;
            if (v > max) v = max;
            return v;
        }

        function updateMinusState() {
            if (!btnMinus) return;
            const v = clamp(input.value);
            btnMinus.disabled = v <= min;
            if (v <= min) {
                btnMinus.classList.add('cursor-not-allowed');
            } else {
                btnMinus.classList.remove('cursor-not-allowed');
            }
        }

        if (btnPlus) {
            btnPlus.addEventListener('click', function () {
                let v = clamp(input.value);
                if (v < max) {
                    v = v + 1;
                    input.value = v;
                    updateMinusState();
                }
            });
        }

        if (btnMinus) {
            btnMinus.addEventListener('click', function () {
                let v = clamp(input.value);
                if (v > min) {
                    v = v - 1;
                    input.value = v;
                    updateMinusState();
                }
            });
        }

        input.addEventListener('input', function () {
            input.value = clamp(input.value);
            updateMinusState();
        });

        input.addEventListener('blur', function () {
            input.value = clamp(input.value);
            updateMinusState();
        });

        input.value = clamp(input.value);
        updateMinusState();
    })();

    (function handlePdpAddToCart() {
        const addToCartBtn = document.querySelector('.js-add-to-cart');
        if (!addToCartBtn) return;

        const qtyInput = document.querySelector('[data-qty="input"]');
        const addToCartUrl = ROUTES.addToCart;
        if (!addToCartUrl) return;

        addToCartBtn.addEventListener('click', async function () {
            const productId = this.dataset.productId;
            let qty = 1;

            if (qtyInput) {
                qty = parseInt(qtyInput.value, 10);
                if (isNaN(qty) || qty < 1) qty = 1;
                if (qty > 99) qty = 99;
            }

            try {
                const res = await fetch(addToCartUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: qty,
                        qty: qty,
                    }),
                });

                if (!res.ok) {
                    throw new Error('Request failed with status ' + res.status);
                }

                const data = await res.json();
                console.log('ajax add response', data);

                let newCount = null;

                if (typeof data.cart_count !== 'undefined') {
                    newCount = parseInt(data.cart_count, 10);
                } else if (typeof data.count !== 'undefined') {
                    newCount = parseInt(data.count, 10);
                } else if (typeof data.cartCount !== 'undefined') {
                    newCount = parseInt(data.cartCount, 10);
                }

                if (newCount !== null && !isNaN(newCount)) {
                    updateHeaderCartCount(newCount);
                } else {
                    const current = getCurrentHeaderCartCount();
                    updateHeaderCartCount(current + qty);
                }

                showCartToast('Sản phẩm đã được thêm vào Giỏ hàng');
            } catch (e) {
                console.error(e);
                showCartToast('Có lỗi khi thêm vào Giỏ hàng, vui lòng thử lại.');
            }
        });
    })();

    (function handleCartPage() {
        const rows = Array.from(document.querySelectorAll('[data-cart-row]'));
        if (!rows.length) return;

        const elCountText = document.querySelector('[data-cart-selected-count]');
        const elCountBtn = document.querySelector('[data-cart-selected-count-btn]');
        const checkboxAllList = Array.from(document.querySelectorAll('[data-cart-select-all]'));
        const clearBtn = document.querySelector('[data-cart-clear]');
        const modal = document.getElementById('cart-remove-modal');
        const modalTitle = modal?.querySelector('[data-cart-remove-title]');
        const modalMsg = modal?.querySelector('[data-cart-remove-message]');
        const modalCancel = modal?.querySelector('[data-cart-remove-cancel]');
        const modalOk = modal?.querySelector('[data-cart-remove-confirm]');
        const checkoutButtons = Array.from(document.querySelectorAll('[data-cart-checkout]'));
        let removeMode = null;

        function openConfirmAll() {
            removeMode = 'all';
            if (!modal) return;
            if (modalTitle && modalMsg) {
                modalTitle.textContent = 'Xoá tất cả sản phẩm';
                modalMsg.textContent = 'Bạn có chắc chắn muốn xoá toàn bộ sản phẩm trong giỏ hàng?';
            }
            modal.classList.remove('hidden');
        }

        function closeConfirm() {
            if (!modal) return;
            modal.classList.add('hidden');
            removeMode = null;
        }

        if (modalCancel) {
            modalCancel.addEventListener('click', function () {
                closeConfirm();
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeConfirm();
            }
        });

        function getRowQty(row) {
            const input = row.querySelector('[data-cart-qty-input]');
            if (!input) return 0;
            let v = parseInt(input.value, 10);
            if (isNaN(v) || v < 1) v = 1;
            if (v > 99) v = 99;
            input.value = v;
            return v;
        }

        function isRowChecked(row) {
            const cb = row.querySelector('.js-cart-item-checkbox');
            return cb && cb.checked;
        }

        function calcSelectedCount() {
            return rows.reduce(function (sum, row) {
                if (!row.isConnected) return sum;
                return sum + (isRowChecked(row) ? getRowQty(row) : 0);
            }, 0);
        }

        function syncCheckoutButton(count) {
            checkoutButtons.forEach(function (btn) {
                if (count > 0) {
                    btn.classList.remove(
                        'cursor-not-allowed',
                        'bg-neutral-100',
                        'hover:bg-neutral-100',
                        'hover:text-neutral-600',
                        'focus:ring-neutral-100',
                        'text-neutral-600',
                        'pointer-events-none'
                    );
                    btn.classList.add(
                        'bg-primary-500',
                        'hover:bg-primary-600',
                        'focus:ring-primary-300',
                        'text-white'
                    );
                } else {
                    btn.classList.add(
                        'cursor-not-allowed',
                        'bg-neutral-100',
                        'hover:bg-neutral-100',
                        'hover:text-neutral-600',
                        'focus:ring-neutral-100',
                        'text-neutral-600',
                        'pointer-events-none'
                    );
                    btn.classList.remove(
                        'bg-primary-500',
                        'hover:bg-primary-600',
                        'focus:ring-primary-300',
                        'text-white'
                    );
                }
            });
        }

        function syncSelectedCount() {
            const count = calcSelectedCount();
            if (elCountText) elCountText.textContent = count;
            if (elCountBtn) elCountBtn.textContent = count;
            const mobileSpan = document.querySelector('[data-cart-mobile-count]');
            if (mobileSpan) {
                mobileSpan.textContent = count + ' sản phẩm trong giỏ';
            }
            syncCheckoutButton(count);
        }

        function syncSelectAllState() {
            if (!checkboxAllList.length) return;
            const aliveRows = rows.filter(function (r) {
                return r.isConnected;
            });
            if (!aliveRows.length) {
                checkboxAllList.forEach(function (cb) {
                    cb.checked = false;
                });
                return;
            }
            const allChecked = aliveRows.every(function (r) {
                return isRowChecked(r);
            });
            checkboxAllList.forEach(function (cb) {
                cb.checked = allChecked;
            });
        }

        checkboxAllList.forEach(function (cb) {
            cb.addEventListener('change', function (e) {
                const checked = e.target.checked;
                rows.forEach(function (row) {
                    if (!row.isConnected) return;
                    const rowCb = row.querySelector('.js-cart-item-checkbox');
                    if (rowCb) rowCb.checked = checked;
                });
                checkboxAllList.forEach(function (other) {
                    if (other !== e.target) other.checked = checked;
                });
                syncSelectedCount();
            });
        });

        async function sendUpdate(row) {
            const url = ROUTES.cartUpdate;
            if (!url) return;

            const rowId = row.dataset.cartRowId;
            if (!rowId) return;

            const qty = getRowQty(row);

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        row_id: rowId,
                        quantity: qty,
                    }),
                });

                if (!res.ok) return;

                const data = await res.json();

                if (typeof data.cart_count !== 'undefined') {
                    const newCount = parseInt(data.cart_count, 10);
                    if (!isNaN(newCount)) {
                        updateHeaderCartCount(newCount);
                    }
                }

                showCartToast('Đã cập nhật số lượng sản phẩm');
            } catch (e) {
                console.error(e);
            }
        }

        async function sendRemove(row) {
            const url = ROUTES.cartRemove;
            if (!url) return;

            const rowId = row.dataset.cartRowId;
            if (!rowId) return;

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ row_id: rowId }),
                });

                if (!res.ok) return;

                const data = await res.json();

                if (typeof data.cart_count !== 'undefined') {
                    const newCount = parseInt(data.cart_count, 10);
                    if (!isNaN(newCount)) {
                        updateHeaderCartCount(newCount);
                    }
                }

                showCartToast('Đã xoá sản phẩm khỏi giỏ hàng');

                if (data.cart_count === 0) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 400);
                }
            } catch (e) {
                console.error(e);
            }
        }

        async function sendClear() {
            const url = ROUTES.cartClear;
            if (!url) return;

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({}),
                });

                if (!res.ok) return;

                const data = await res.json();

                if (typeof data.cart_count !== 'undefined') {
                    const newCount = parseInt(data.cart_count, 10);
                    if (!isNaN(newCount)) {
                        updateHeaderCartCount(newCount);
                    }
                }

                showCartToast('Đã xoá toàn bộ giỏ hàng');

                setTimeout(function () {
                    window.location.reload();
                }, 400);
            } catch (e) {
                console.error(e);
            }
        }

        if (modalOk) {
            modalOk.addEventListener('click', async function () {
                if (removeMode === 'all') {
                    const aliveRows = rows.filter(function (r) {
                        return r.isConnected;
                    });
                    aliveRows.forEach(function (r) {
                        r.remove();
                    });
                    syncSelectedCount();
                    syncSelectAllState();
                    await sendClear();
                }
                closeConfirm();
            });
        }

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                openConfirmAll();
            });
        }

        rows.forEach(function (row) {
            const cb = row.querySelector('.js-cart-item-checkbox');
            const input = row.querySelector('[data-cart-qty-input]');
            const btnMinus = row.querySelector('[data-qty="minus"]');
            const btnPlus = row.querySelector('[data-qty="plus"]');
            const btnRemove = row.querySelector('[data-cart-remove]');

            if (cb) {
                cb.addEventListener('change', function () {
                    syncSelectedCount();
                    syncSelectAllState();
                });
            }

            if (btnPlus && input) {
                btnPlus.addEventListener('click', function () {
                    let v = getRowQty(row);
                    if (v < 99) {
                        v++;
                        input.value = v;
                        if (isRowChecked(row)) syncSelectedCount();
                        sendUpdate(row);
                    }
                });
            }

            if (btnMinus && input) {
                btnMinus.addEventListener('click', function () {
                    let v = getRowQty(row);
                    if (v > 1) {
                        v--;
                        input.value = v;
                        if (isRowChecked(row)) syncSelectedCount();
                        sendUpdate(row);
                    }
                });
            }

            if (input) {
                input.addEventListener('input', function () {
                    getRowQty(row);
                    if (isRowChecked(row)) syncSelectedCount();
                });

                input.addEventListener('blur', function () {
                    getRowQty(row);
                    if (isRowChecked(row)) syncSelectedCount();
                    sendUpdate(row);
                });
            }

            if (btnRemove) {
                btnRemove.addEventListener('click', async function (e) {
                    e.preventDefault();
                    const wasChecked = isRowChecked(row);
                    getRowQty(row);
                    row.remove();
                    if (wasChecked) syncSelectedCount();
                    syncSelectAllState();
                    await sendRemove(row);
                });
            }
        });

        checkoutButtons.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                const count = calcSelectedCount();
                if (count === 0) {
                    e.preventDefault();
                    return;
                }

                const selectedRowIds = rows
                    .filter(function (row) {
                        return row.isConnected && isRowChecked(row);
                    })
                    .map(function (row) {
                        return row.dataset.cartRowId;
                    });

                if (!selectedRowIds.length) {
                    e.preventDefault();
                    return;
                }

                const form = document.getElementById('cart-checkout-form');
                const input = document.getElementById('checkout-rows-input');
                if (!form || !input) return;

                e.preventDefault();
                input.value = selectedRowIds.join(',');
                form.submit();
            });
        });

        syncSelectedCount();
        syncSelectAllState();
    })();
});
