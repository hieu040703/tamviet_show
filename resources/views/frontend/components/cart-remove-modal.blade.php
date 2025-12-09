<div id="cart-remove-modal"
     class="fixed left-1/2 top-1/2 z-[60] hidden
            w-[calc(100vw-32px)] max-w-lg
            -translate-x-1/2 -translate-y-1/2
            rounded-lg border bg-white p-6 shadow-lg">

    <div class="flex flex-col space-y-4 text-left">
        <h2 class="text-xl font-semibold leading-6" data-cart-remove-title>
            Xoá sản phẩm
        </h2>
        <p class="text-base text-neutral-900" data-cart-remove-message>
            Bạn có chắc chắn muốn xóa sản phẩm này?
        </p>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button"
                data-cart-remove-cancel
                class="relative flex justify-center outline-none font-semibold
                       bg-neutral-200 border-0 hover:bg-neutral-300 focus:ring-neutral-300
                       text-neutral-900 text-base px-6 py-3 h-13.5 items-center rounded-lg">
            Quay lại
        </button>

        <button type="button"
                data-cart-remove-confirm
                class="relative flex justify-center outline-none font-semibold
                       text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300
                       text-base px-6 py-3 h-13.5 items-center rounded-lg">
            Đồng ý
        </button>
    </div>
</div>
