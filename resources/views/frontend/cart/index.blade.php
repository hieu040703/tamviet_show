@extends('frontend.layout')

@section('content')
    @php
        $items = Cart::content();
        $cartCount = $items->sum('qty');
    @endphp
    <div class="fixed top-0 z-10 w-full bg-white md:hidden ">
        <div class="z-50 grid w-full content-start gap-4 bg-white px-4 py-2.5 md:py-4">
            <div class="grid grid-flow-col items-center justify-between gap-4">
                <button
                    data-back-button
                    type="button"
                    class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0 text-neutral-900">
                    <span class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6"><svg
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path
                                d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                fill="currentColor"></path></svg></span></button>
                <div class="grid-flow-col items-center justify-between gap-4 contents"><h1
                        class="text-base font-semibold text-neutral-900 md:text-2xl md:font-bold">Giỏ hàng</h1>

                    <button
                        data-cart-clear
                        class="relative flex justify-center border-0 bg-transparent
                         text-sm font-normal text-hyperLink outline-none md:hover:text-primary-600
                          md:text-base"
                        type="button">Xoá
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="mainContent"
         class="z-20 mx-auto min-h-screen bg-neutral-100 pb-[calc(144rem/16)] pt-[calc(44rem/16)] md:min-h-fit md:pb-0 md:pt-0">
        <div class="pt-2.5 md:pt-0">
            @if($items->count() > 0)
                <div
                    class="relative grid items-start gap-4 md:container md:grid-cols-1 md:pb-4 md:pt-6 lg:grid-cols-[min(75%,calc(896rem/16)),1fr]">

                    <div class="grid gap-4">
                        <div class="grid gap-6 rounded-sm bg-white p-4 md:p-6">
                            <div class="hidden md:grid grid-flow-col items-center justify-between gap-4">
                                <h1 class="text-base font-semibold text-neutral-900 md:text-2xl md:font-bold">
                                    Giỏ hàng (<span data-cart-selected-count-btn>{{ $cartCount }}</span>)
                                </h1>
                                <button
                                    type="button"
                                    data-cart-clear
                                    class="relative flex justify-center border-0 bg-transparent text-sm font-normal text-hyperLink outline-none md:hover:text-primary-600 md:text-base">
                                    Xoá
                                </button>

                            </div>

                            <div class="grid gap-2 md:gap-6">
                                <div
                                    class="hidden md:grid grid-cols-[calc(16rem/16)_1fr_calc(24rem/16)] items-center gap-4">
                                    <div class="h-4 w-4 [&>div]:flex [&>div]:h-4">
                                        <div>
                                            <label class="group inline-flex cursor-pointer md:w-4 md:h-4 items-center">
                                            <span class="whitespace-nowrap">
                                                <input class="peer absolute opacity-0" type="checkbox" checked
                                                       data-cart-select-all>
                                                <span
                                                    class="flex h-5 w-5 rounded items-center justify-center border border-neutral-300 text-white/100 group-hover:border-primary-500 cursor-pointer peer-checked:bg-primary-500 peer-checked:border-primary-500 before:contents[' '] before:h-[6px] before:-rotate-45 before:w-[10px] before:border-white before:border-2 before:border-r-0 before:border-t-0 before:mb-[2px] peer-disabled:bg-neutral-600 peer-disabled:border-neutral-600 md:h-4 md:w-4">
                                                </span>
                                            </span>
                                                <span class="ml-2"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between space-x-4">
                                        <div class="grid flex-1 items-start gap-2">
                                            <p class="text-sm leading-4 text-neutral-900">Sản phẩm</p>
                                        </div>
                                        <div class="flex justify-center space-x-4">
                                            <p class="w-[calc(160rem/16)] text-center text-sm text-neutral-900">
                                                Đơn giá
                                            </p>
                                            <p class="w-[calc(117rem/16)] text-center text-sm text-neutral-900">
                                                Số lượng
                                            </p>
                                            <p class="w-[calc(120rem/16)] text-end text-sm text-neutral-900">
                                                Thành tiền
                                            </p>
                                        </div>
                                    </div>

                                    <div class="w-4"></div>
                                </div>

                                <div class="bg-divider h-[1px] hidden w-full md:block"></div>

                                @foreach($items as $row)
                                    @php
                                        $imagePath = data_get($row->options, 'image');
                                        $image = $imagePath
                                            ? asset('storage/' . ltrim($imagePath, '/'))
                                            : asset('backend/img/not-found.jpg');
                                    @endphp

                                    <div
                                        class="grid items-start justify-start gap-2 py-4 md:gap-4 md:p-0 md:grid-cols-[calc(16rem/16)_1fr_calc(24rem/16)] grid-cols-[calc(16rem/16)_1fr]"
                                        data-cart-row
                                        data-cart-row-id="{{ $row->rowId }}">
                                        <div
                                            class="flex h-4 w-4 self-start pt-[calc(26rem/16)] [&>div]:flex [&>div]:h-4">
                                            <div class="space-y-2">
                                                <div>
                                                    <label class="group inline-flex cursor-pointer items-start w-4 h-4">
                                                    <span class="whitespace-nowrap">
                                                        <input class="peer absolute opacity-0 js-cart-item-checkbox"
                                                               type="checkbox"
                                                               checked>
                                                        <span
                                                            class="flex rounded items-center justify-center border border-neutral-300 text-white/100 group-hover:border-primary-500 cursor-pointer peer-checked:bg-primary-500 peer-checked:border-primary-500 before:contents[' '] before:h-[6px] before:-rotate-45 before:w-[10px] before:border-white before:border-2 before:border-r-0 before:border-t-0 before:mb-[2px] peer-disabled:bg-neutral-600 peer-disabled:border-neutral-600 h-4 w-4">
                                                        </span>
                                                    </span>
                                                        <span class="ml-2"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-2">
                                            <div class="grid grid-cols-[calc(68rem/16)_1fr] items-start gap-2">
                                                <div
                                                    class="relative h-[calc(68rem/16)] w-[calc(68rem/16)] rounded-sm border border-neutral-100 overflow-hidden">
                                                    <a href="#">
                                                        <img
                                                            class="object-contain w-full h-full"
                                                            src="{{ $image }}"
                                                            alt="{{ $row->name }}"
                                                            loading="lazy">
                                                    </a>
                                                </div>

                                                <div
                                                    class="flex h-full flex-col justify-between md:flex-row md:space-x-4">
                                                    <div class="grid flex-1 content-start gap-1">
                                                        <a href="#">
                                                            <p class="line-clamp-2 text-sm font-semibold text-neutral-900">
                                                                {{ $row->name }}
                                                            </p>
                                                        </a>
                                                    </div>

                                                    <div
                                                        class="flex h-fit items-center justify-between space-x-4 md:justify-center">
                                                        <div>
                                                            <div
                                                                class="flex flex-col justify-center md:w-[calc(160rem/16)] md:flex-row md:space-x-1">
                                                                <p class="text-base font-semibold md:text-sm text-neutral-900">
                                                                    Thương lượng
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="flex w-[calc(117rem/16)] items-center justify-end self-end md:justify-center md:self-center">
                                                            <div class="relative">
                                                                <div
                                                                    class="flex items-center gap-1 text-sm leading-4 h-[34px]">
                                                                    <button type="button"
                                                                            data-qty="minus"
                                                                            class="relative flex justify-center outline-none font-semibold border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm px-4 py-2 h-9 rounded-full data-[size=xs]:w-8 data-[size=xs]:h-8 data-[size=xs]:p-1.5 data-[size=sm]:w-9 data-[size=sm]:h-9 data-[size=sm]:p-2 data-[size=md]:w-12 data-[size=md]:h-12 data-[size=md]:p-2.5 data-[size=lg]:w-13.5 data-[size=lg]:h-13.5 data-[size=lg]:p-2.5 !h-6 !w-6 bg-neutral-400 !p-1.5 transition-colors disabled:!bg-neutral-100 disabled:!text-neutral-600">
                                                <span
                                                    class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         fill="none" viewBox="0 0 12 12">
                                                        <path fill="currentColor"
                                                              d="M11.091 5.215H.751v1.41h10.34v-1.41z"/>
                                                    </svg>
                                                </span>
                                                                    </button>

                                                                    <input inputmode="numeric" maxlength="2"
                                                                           class="border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none none-spin w-[30px] border-0 p-0 text-center disabled:bg-transparent disabled:text-neutral-600 text-sm leading-4 h-[34px]"
                                                                           type="text"
                                                                           value="{{ $row->qty }}"
                                                                           data-cart-qty-input>

                                                                    <button type="button"
                                                                            data-qty="plus"
                                                                            class="relative flex justify-center outline-none font-semibold border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm px-4 py-2 h-9 rounded-full data-[size=xs]:w-8 data-[size=xs]:h-8 data-[size=xs]:p-1.5 data-[size=sm]:w-9 data-[size=sm]:h-9 data-[size=sm]:p-2 data-[size=md]:w-12 data-[size=md]:h-12 data-[size=md]:p-2.5 data-[size=lg]:w-13.5 data-[size=lg]:h-13.5 data-[size=lg]:p-2.5 !h-6 !w-6 bg-neutral-400 !p-1.5 transition-colors disabled:!bg-neutral-100 disabled:!text-neutral-600">
                                                <span
                                                    class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         fill="none" viewBox="0 0 12 12">
                                                        <path fill="currentColor"
                                                              d="M11.25 5.216H6.783V.75h-1.41v4.466H.909v1.41h4.465v4.465h1.41V6.626h4.465v-1.41z"/>
                                                    </svg>
                                                </span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="hidden w-[calc(120rem/16)] items-center justify-end md:flex">
                                                            <p class="text-sm font-semibold text-neutral-900">
                                                                Thương lượng
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button"
                                                data-cart-remove
                                                class="hidden md:flex relative justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm text-inherit border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0 md:mt-1">
                                        <span
                                            class="p-icon inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                            <svg viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.4 5.03128H15.7333V4.49795C15.7333 3.61571 15.0156 2.89795 14.1333 2.89795H9.86668C8.98444 2.89795 8.26668 3.61571 8.26668 4.49795V5.03128H5.60001C4.71777 5.03128 4.00002 5.74904 4.00002 6.63128C4.00002 7.33983 4.46313 7.94189 5.10241 8.15167L6.0537 19.6352C6.12222 20.4579 6.82259 21.1024 7.64815 21.1024H16.3519C17.1775 21.1024 17.8778 20.4579 17.9464 19.635L18.8976 8.15163C19.5369 7.94189 20 7.33983 20 6.63128C20 5.74904 19.2822 5.03128 18.4 5.03128ZM9.33334 4.49795C9.33334 4.20387 9.5726 3.96461 9.86668 3.96461H14.1333C14.4274 3.96461 14.6667 4.20387 14.6667 4.49795V5.03128H9.33334V4.49795ZM16.8833 19.5467C16.8605 19.8209 16.6271 20.0357 16.3519 20.0357H7.64815C7.37299 20.0357 7.13953 19.8209 7.11674 19.5469L6.17936 8.23128H17.8207L16.8833 19.5467Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M9.86575 18.4026L9.33242 9.79821C9.31418 9.5042 9.0597 9.28059 8.76712 9.2989C8.47311 9.31714 8.24957 9.57022 8.26778 9.8642L8.80111 18.4687C8.81864 18.7514 9.05345 18.969 9.33291 18.969C9.64178 18.969 9.8847 18.7089 9.86575 18.4026Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M12 9.29785C11.7055 9.29785 11.4667 9.53664 11.4667 9.83118V18.4356C11.4667 18.7302 11.7055 18.969 12 18.969C12.2946 18.969 12.5334 18.7302 12.5334 18.4356V9.83118C12.5334 9.53664 12.2946 9.29785 12 9.29785Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M15.233 9.29889C14.9396 9.28065 14.6859 9.50419 14.6677 9.7982L14.1343 18.4026C14.1162 18.6966 14.3397 18.9497 14.6337 18.9679C14.9278 18.9861 15.1808 18.7625 15.199 18.4686L15.7323 9.86419C15.7505 9.57018 15.527 9.3171 15.233 9.29889Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        </button>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="sticky top-[calc(var(--header-position-start-sticky)+12px)] hidden gap-4 md:grid"
                             style="--header-position-start-sticky: 0px;">
                            <div>
                                <div class="rounded-sm bg-white md:p-4 p-3 grid gap-4">
                                    <div class="space-y-2">
                                        <p class="text-base font-semibold text-neutral-900">
                                            Thông tin giỏ hàng
                                        </p>

                                        <p class="text-sm text-neutral-700">
                                            Bạn đang có
                                            <span class="font-semibold" data-cart-selected-count>{{ $cartCount }}</span>
                                            sản phẩm trong giỏ hàng.
                                        </p>

                                        <p class="text-xs text-neutral-500 leading-relaxed">
                                            Giá sản phẩm, ưu đãi và phí vận chuyển sẽ được hiển thị
                                            ở bước <span class="font-semibold">xác nhận Liên hệ</span> tiếp theo.
                                        </p>
                                    </div>

                                    <a href="{{ route('checkout.index') }}"
                                       data-cart-checkout
                                       class="relative flex justify-center items-center w-full md:px-4 px-2 py-2.5 h-12 rounded-lg
                                          outline-none font-semibold text-white bg-primary-500 border-0
                                          hover:bg-primary-600 focus:ring-primary-300 text-base">
                                        Liên hệ
                                    </a>
                                    <div class="border-t border-neutral-200 pt-3 space-y-1 text-sm text-neutral-700">
                                        <p class="font-semibold">Liên hệ hỗ trợ</p>
                                        <p class="text-xs text-neutral-500">Hỗ trợ đặt hàng</p>
                                        <a href="tel:0921681688"
                                           class="text-primary-500 text-sm font-semibold hover:underline">
                                            0921681688
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="fixed bottom-0 z-20 grid w-full border-t border-t-neutral-200 bg-white md:hidden">
                    <div class="bg-divider h-[1px]"></div>
                    <div class="flex items-center justify-between p-4">
                        <div>
                            <label class="group inline-flex cursor-pointer items-center">
                            <span class="whitespace-nowrap">
                                <input class="peer absolute opacity-0" type="checkbox" data-cart-select-all>
                                <span
                                    class="flex h-5 w-5 rounded items-center justify-center border border-neutral-300 text-white/100 group-hover:border-primary-500 cursor-pointer peer-checked:bg-primary-500 peer-checked:border-primary-500 before:contents[' '] before:h-[6px] before:-rotate-45 before:w-[10px] before:border-white before:border-2 before:border-r-0 before:border-t-0 before:mb-[2px] peer-disabled:bg-neutral-600 peer-disabled:border-neutral-600 md:h-4 md:w-4">
                                </span>
                            </span>
                                <span class="ml-2 text-sm ">Tất cả</span>
                            </label>
                        </div>

                        <div class="flex items-center gap-3">
                            <p class="text-xs text-neutral-700" data-cart-mobile-count>
                                {{ $cartCount }} sản phẩm trong giỏ
                            </p>
                            <a href="{{ route('checkout.index') }}"
                               data-cart-checkout
                               class="relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 text-base py-2.5 h-12 items-center rounded-lg px-4">
                                Liên hệ
                            </a>
                        </div>

                    </div>
                </div>
            @else
                <div class="grid items-center justify-center justify-items-center gap-3 h-full p-4 md:p-10">
                    <div class="grid items-center justify-center justify-items-center text-center">
                        <div
                            class="m-auto block aspect-square mb-3 md:mb-4 w-[calc(120rem/16)] h-[calc(120rem/16)] md:w-[calc(190rem/16)] md:h-[calc(190rem/16)]">
                            <img class="max-h-[100%] max-w-[100%] object-contain"
                                 src="{{asset('frontend/assets/image/cart/empty-cart.png')}}"
                                 alt="" loading="lazy" width="500" height="500"></div>
                        <div class="grid justify-items-center gap-2">
                            <div class="text-base font-semibold text-neutral-900"><span>Chưa có sản phẩm nào</span>
                            </div>
                            <div class="flex justify-center text-sm">
                                <div class="grid w-screen justify-items-center gap-4 md:w-[calc(368rem/16)]"><span
                                        class="n text-base ">Hãy khám phá để mua sắm thêm</span><a
                                        class="relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 text-sm px-4 py-2 h-9 items-center rounded-lg w-fit"
                                        href="/"><span>Khám phá ngay</span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @include('frontend.components.cart-remove-modal')
        <form id="cart-checkout-form"
              action="{{ route('checkout.index') }}"
              method="GET"
              class="hidden">
            <input type="hidden" name="rows" id="checkout-rows-input">
        </form>
    </div>
@endsection
