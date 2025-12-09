document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const desktopModal = document.getElementById("product-modal");
    const mobileModal = document.getElementById("product-modal-mobile");
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
    const ROUTES = window.APP_ROUTES || {};

    if (!desktopModal && !mobileModal) return;
    let overlay = document.getElementById("product-modal-overlay");
    if (!overlay) {
        overlay = document.createElement("div");
        overlay.id = "product-modal-overlay";
        overlay.className = "fixed inset-0 bg-black/40 z-40 hidden";
        overlay.style.display = "none";
        overlay.style.pointerEvents = "none";
        document.body.appendChild(overlay);
    }

    function isMobile() {
        return window.innerWidth < 768;
    }

    let currentProduct = null;

    function fillDesktop(product) {
        if (!desktopModal || !product) return;
        desktopModal.dataset.productId = product.id || "";

        const dImg = desktopModal.querySelector("[data-product-image-target]");
        const dTitle = desktopModal.querySelector("[data-product-name-target]");
        const dName = desktopModal.querySelector("[data-product-name-text]");
        const dQty = desktopModal.querySelector("[data-qty-input]");

        if (dImg) {
            dImg.src = product.image || "";
            dImg.alt = product.name || "";
        }
        if (dTitle) dTitle.textContent = product.name || "Sản phẩm";
        if (dName) dName.textContent = product.name || "Sản phẩm";
        if (dQty) dQty.value = product.qty || 1;
    }

    function fillMobile(product) {
        if (!mobileModal || !product) return;
        mobileModal.dataset.productId = product.id || "";

        const mImg = mobileModal.querySelector("[data-product-image-target-mobile]");
        const mName = mobileModal.querySelector("[data-product-name-text-mobile]");
        const mQty = mobileModal.querySelector("[data-qty-input-mobile]");
        const mPrice = mobileModal.querySelector("[data-product-price-mobile]");
        const mPriceOld = mobileModal.querySelector("[data-product-price-old-mobile]");
        const mPoint = mobileModal.querySelector("[data-product-point-mobile]");

        if (mImg) {
            mImg.src = product.image || "";
            mImg.alt = product.name || "";
        }
        if (mName) mName.textContent = product.name || "Sản phẩm";
        if (mPrice) mPrice.textContent = product.price || "";
        if (mPriceOld) mPriceOld.textContent = product.priceOld || "";
        if (mPoint) mPoint.textContent = product.point || "";
        if (mQty) mQty.value = product.qty || 1;
    }

    function showOverlay() {
        overlay.classList.remove("hidden");
        overlay.style.display = "block";
        overlay.style.opacity = "1";
        overlay.style.pointerEvents = "auto";
        body.style.overflow = "hidden";
    }

    function hideOverlay() {
        overlay.style.opacity = "0";
        setTimeout(() => {
            overlay.classList.add("hidden");
            overlay.style.display = "none";
            overlay.style.pointerEvents = "none";
        }, 300);

        body.style.overflow = "";
    }

    function openDesktop() {
        if (!desktopModal) return;
        desktopModal.classList.remove("hidden");
        setTimeout(() => {
            desktopModal.dataset.state = "open";
            desktopModal.style.opacity = "1";
            desktopModal.style.pointerEvents = "auto";
        }, 10);
        if (mobileModal) {
            mobileModal.dataset.state = "closed";
            mobileModal.style.opacity = "0";
            mobileModal.style.pointerEvents = "none";
        }
        showOverlay();
    }

    function openMobile() {
        if (!mobileModal) return;
        mobileModal.classList.remove("hidden");
        setTimeout(() => {
            mobileModal.dataset.state = "open";
            mobileModal.style.opacity = "1";
            mobileModal.style.pointerEvents = "auto";
        }, 10);

        if (desktopModal) {
            desktopModal.dataset.state = "closed";
            desktopModal.style.opacity = "0";
            desktopModal.style.pointerEvents = "none";
        }

        showOverlay();
    }

    function closeAll() {
        if (desktopModal) {
            desktopModal.dataset.state = "closed";
            desktopModal.style.opacity = "0";
            desktopModal.style.pointerEvents = "none";
            setTimeout(() => {
                desktopModal.classList.add("hidden");
            }, 300);
        }

        if (mobileModal) {
            mobileModal.dataset.state = "closed";
            mobileModal.style.opacity = "0";
            mobileModal.style.pointerEvents = "none";

            setTimeout(() => {
                mobileModal.classList.add("hidden");
            }, 300);
        }

        hideOverlay();
    }

    document.addEventListener("click", function (e) {
        const btn = e.target.closest("[data-open-product-modal]");
        if (!btn) return;

        const id = btn.dataset.productId;
        const name = btn.dataset.productName || "Sản phẩm";
        const image = btn.dataset.productImage || "";
        const price = btn.dataset.productPrice || "";
        const priceOld = btn.dataset.productPriceOld || "";
        const point = btn.dataset.productPoint || "";

        currentProduct = {
            id,
            name,
            image,
            price,
            priceOld,
            point,
            qty: 1,
        };

        fillDesktop(currentProduct);
        fillMobile(currentProduct);

        if (isMobile()) openMobile();
        else openDesktop();
    });

    overlay.addEventListener("click", closeAll);
    desktopModal?.querySelector("[data-close-product-modal]")?.addEventListener("click", closeAll);
    mobileModal?.querySelector("[data-close-mobile]")?.addEventListener("click", closeAll);

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") closeAll();
    });
    if (desktopModal) {
        const dInput = desktopModal.querySelector("[data-qty-input]");
        const dMinus = desktopModal.querySelector("[data-qty-minus]");
        const dPlus = desktopModal.querySelector("[data-qty-plus]");

        dMinus?.addEventListener("click", function () {
            let v = parseInt(dInput.value, 10) || 1;
            if (v > 1) v--;
            dInput.value = v;
            if (currentProduct) currentProduct.qty = v;
        });

        dPlus?.addEventListener("click", function () {
            let v = parseInt(dInput.value, 10) || 1;
            if (v < 999) v++;
            dInput.value = v;
            if (currentProduct) currentProduct.qty = v;
        });

        dInput?.addEventListener("input", function () {
            let v = dInput.value.replace(/\D/g, "");
            if (!v) v = "1";
            v = Math.min(999, Math.max(1, parseInt(v, 10)));
            dInput.value = v;
            if (currentProduct) currentProduct.qty = v;
        });
    }
    if (mobileModal) {
        const mInput = mobileModal.querySelector("[data-qty-input-mobile]");
        const mMinus = mobileModal.querySelector("[data-qty-minus-mobile]");
        const mPlus = mobileModal.querySelector("[data-qty-plus-mobile]");

        mMinus?.addEventListener("click", function () {
            let v = parseInt(mInput.value, 10) || 1;
            if (v > 1) v--;
            mInput.value = v;
            if (currentProduct) currentProduct.qty = v;
        });

        mPlus?.addEventListener("click", function () {
            let v = parseInt(mInput.value, 10) || 1;
            if (v < 999) v++;
            mInput.value = v;
            if (currentProduct) currentProduct.qty = v;
        });

        mInput?.addEventListener("input", function () {
            let v = mInput.value.replace(/\D/g, "");
            if (!v) v = "1";
            v = Math.min(999, Math.max(1, parseInt(v, 10)));
            mInput.value = v;
            if (currentProduct) currentProduct.qty = v;
        });
    }
    if (desktopModal) {
        const addBtn = desktopModal.querySelector("[data-add-to-cart]");
        const qtyInput = desktopModal.querySelector("[data-qty-input]");
        const buyNowBtn = desktopModal.querySelector("[data-buy-now]");
        const checkoutUrl = ROUTES.checkout || "/checkout.html";

        addBtn?.addEventListener("click", async function () {
            const id = desktopModal.dataset.productId;
            const qty = parseInt(qtyInput.value, 10) || 1;
            await sendAddToCart(id, qty);
            closeAll();
        });

        buyNowBtn?.addEventListener("click", async function () {
            const id = desktopModal.dataset.productId;
            const qty = parseInt(qtyInput.value, 10) || 1;
            const data = await sendAddToCart(id, qty);
            if (data && data.row_id) {
                window.location.href = checkoutUrl + "?rows=" + encodeURIComponent(data.row_id);
            } else {
                window.location.href = checkoutUrl;
            }
        });
    }
    if (mobileModal) {
        const addBtn = mobileModal.querySelector("[data-add-to-cart-mobile]");
        const qtyInput = mobileModal.querySelector("[data-qty-input-mobile]");
        const buyNowBtn = mobileModal.querySelector("[data-buy-now-mobile]");
        const checkoutUrl = ROUTES.checkout || "/checkout.html";

        addBtn?.addEventListener("click", async function () {
            const id = mobileModal.dataset.productId;
            const qty = parseInt(qtyInput.value, 10) || 1;
            await sendAddToCart(id, qty);
            closeAll();
        });

        buyNowBtn?.addEventListener("click", async function () {
            const id = mobileModal.dataset.productId;
            const qty = parseInt(qtyInput.value, 10) || 1;
            const data = await sendAddToCart(id, qty);
            if (data && data.row_id) {
                window.location.href = checkoutUrl + "?rows=" + encodeURIComponent(data.row_id);
            } else {
                window.location.href = checkoutUrl;
            }
        });
    }

    async function sendAddToCart(id, qty) {
        if (!ROUTES.addToCart) return null;

        try {
            const res = await fetch(ROUTES.addToCart, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
                body: JSON.stringify({
                    product_id: id,
                    quantity: qty,
                    qty: qty,
                }),
            });

            if (!res.ok) throw new Error("Add to cart failed");

            const data = await res.json();

            if (typeof data.cart_count !== "undefined") {
                const count = parseInt(data.cart_count, 10) || 0;
                const badges = document.querySelectorAll("[data-cart-count],[data-cart-count-mobile]");
                badges.forEach(function (badge) {
                    badge.textContent = count;
                    if (count > 0) {
                        badge.classList.remove("hidden");
                    } else {
                        badge.classList.add("hidden");
                    }
                });
            }

            const cartToast = document.getElementById("tv-cart-toast");
            const cartToastMessage = document.getElementById("tv-cart-toast-message");
            if (cartToast && cartToastMessage) {
                cartToastMessage.textContent = "Sản phẩm đã được thêm vào Giỏ hàng";
                cartToast.style.display = "block";
                setTimeout(function () {
                    cartToast.style.display = "none";
                }, 2000);
            }
            return data;
        } catch (err) {
            console.error(err);
            return null;
        }
    }


    window.addEventListener("resize", function () {
        if (!currentProduct) return;

        const desktopOpen = desktopModal && desktopModal.dataset.state === "open";
        const mobileOpen = mobileModal && mobileModal.dataset.state === "open";

        if (isMobile() && desktopOpen) {
            fillMobile(currentProduct);
            openMobile();
        } else if (!isMobile() && mobileOpen) {
            fillDesktop(currentProduct);
            openDesktop();
        }
    });
});
