    <div
        class="fixed bottom-0 z-20 grid w-full gap-4 border-t border-t-neutral-200 bg-white p-4 md:hidden h-[86px] grid-cols-2">
        <button
            type="button"
            data-qty-modal-trigger
            data-label="Thêm vào giỏ"
            data-action="cart"
            data-product-id="<?php echo e($product->id); ?>"
            class="relative flex justify-center items-center rounded-lg outline-none font-semibold !bg-white bg-white border border-solid border-primary-500 text-primary-500 text-base px-6 py-3 h-13.5">
            <span>Thêm vào giỏ</span>
        </button>
        <button
            type="button"
            data-qty-modal-trigger
            data-label="Mua ngay"
            data-action="buy"
            data-url="<?php echo e(route('checkout.index', ['id' => $product->id])); ?>"
            class="relative flex justify-center items-center rounded-lg outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 text-base px-6 py-3 h-13.5">
            <span>Mua ngay</span>
        </button>
    </div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/product/partials/cta-mobile.blade.php ENDPATH**/ ?>