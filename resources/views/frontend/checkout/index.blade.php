@extends('frontend.layout')

@section('content')
    @php
        $cartCount = count($items ?? []);
        $customer = auth('web')->user();
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
                <h1 class="text-base font-semibold text-neutral-900 md:text-2xl md:font-bold">Thanh toán</h1>
                <div class="w-6"></div>
            </div>
        </div>
    </div>
    <div id="mainContent"
         class="z-20 mx-auto min-h-screen bg-neutral-100 pb-[calc(144rem/16)] pt-[calc(44rem/16)] md:min-h-fit md:pb-6 md:pt-0">
        <div class="pt-2.5 md:pt-0">
            <div
                    class="relative grid gap-2.5 md:container md:grid-cols-1 md:items-start md:gap-4 md:pt-6 lg:grid-cols-[min(75%,calc(896rem/16)),1fr]">

                <div class="contents content-start gap-4 rounded-sm md:grid">
                    <form id="checkoutForm"
                          method="POST"
                          action="{{ route('checkout.store') }}"
                          class="order-2 grid content-start gap-6 rounded-sm bg-white p-4 md:order-1 md:p-6">
                        @csrf
                        <input type="hidden" name="rows" value="{{ request('rows') }}">
                        <p class="hidden text-2xl font-bold text-neutral-900 md:block">
                            Liên hệ
                        </p>

                        <div class="grid gap-4">
                            @foreach($items as $row)
                                @php
                                    $imagePath = data_get($row->options, 'image');
                                    $image = $imagePath
                                        ? asset('storage/' . $imagePath)
                                        : asset('backend/img/not-found.jpg');
                                @endphp
                                <div class="grid grid-flow-col">
                                    <div class="grid grid-cols-[calc(68rem/16)_1fr] items-start gap-2">
                                        <div
                                                class="relative h-[calc(68rem/16)] w-[calc(68rem/16)] rounded-sm border border-neutral-100 overflow-hidden">
                                            <a href="#">
                                                <img class="h-full w-full object-contain"
                                                     src="{{ $image }}"
                                                     alt="{{ $row->name }}"
                                                     loading="lazy">
                                            </a>
                                        </div>
                                        <div class="flex flex-col justify-between md:flex-row md:space-x-4">
                                            <div class="grid flex-1 gap-1">
                                                <p class="text-sm font-semibold text-neutral-900 line-clamp-2">
                                                    <a href="#">{{ $row->name }}</a>
                                                </p>
                                                <p class="text-sm text-neutral-700">
                                                    Số lượng: x{{ $row->qty }}
                                                </p>
                                                <p class="text-xs text-neutral-500">
                                                    Giá: Thương lượng
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-divider h-[1px] w-full"></div>
                            @endforeach
                        </div>

                        <div class="flex items-center space-x-6 space-y-0">
                            <label class="w-fit shrink-0 text-sm font-semibold text-neutral-900">
                                Ghi chú
                            </label>
                            <div class="flex-1">
                                <div class="relative flex">
                                    <input maxlength="150"
                                           class="border-neutral-500 text-neutral-900 placeholder:text-neutral-600 focus:ring-neutral-500 focus:border-neutral-700 outline-none h-5 w-full rounded-none border-0 p-0 text-right text-xs font-normal leading-5 md:h-12 md:rounded-lg md:border md:p-3.5 md:text-left md:text-sm"
                                           placeholder="Nhập ghi chú ở đây"
                                           inputmode="text"
                                           type="text"
                                           name="note"
                                           value="">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="space-y-2">
                                <div class="mb-4 flex h-12 w-full items-center rounded bg-blue-50 p-3">
                                    <h4 class="text-[14px] font-semibold leading-[20px]">
                                        Thông tin người đặt hàng
                                    </h4>
                                </div>
                                <input type="hidden" name="customer_id" value="{{$customer->id ?? ''}}">
                                <div class="grid gap-4 md:grid-cols-2">
                                    <div class="space-y-2">
                                        <label class="w-fit font-semibold">
                                            <span class="mr-1 text-red-500">*</span>Họ và Tên
                                        </label>
                                        <div class="relative flex">
                                            <input maxlength="50"
                                                   class="w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 focus:ring-neutral-500 focus:border-neutral-700 outline-none p-3.5 h-12 text-base font-medium placeholder:font-medium"
                                                   placeholder="Nhập họ và tên"
                                                   inputmode="text"
                                                   type="text"
                                                   name="name"
                                                   value="{{$customer->name ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="w-fit font-semibold">
                                            <span class="mr-1 text-red-500">*</span>Số điện thoại
                                        </label>
                                        <div class="relative flex">
                                            <input inputmode="numeric"
                                                   class="w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 focus:ring-neutral-500 focus:border-neutral-700 outline-none p-3.5 h-12 text-base font-medium placeholder:font-medium"
                                                   placeholder="Nhập số điện thoại"
                                                   type="text"
                                                   name="phone"
                                                   value="{{$customer->phone ?? ''}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 flex h-12 w-full items-center rounded bg-blue-50 p-3 mt-4">
                                    <h4 class="text-[14px] font-semibold leading-[20px]">
                                        Địa chỉ nhận hàng
                                    </h4>
                                </div>
                                <div class="space-y-2">
                                    <label class="w-fit font-semibold">
                                        <span class="mr-1 text-red-500">*</span>Địa chỉ
                                    </label>
                                    <div class="relative flex">
                                        <input maxlength="300"
                                               class="w-full border border-neutral-500 text-neutral-900 rounded-lg placeholder:text-neutral-600 font-semibold focus:ring-neutral-500 focus:border-neutral-700 outline-none text-base p-3.5 h-12"
                                               placeholder="Nhập số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố"
                                               inputmode="text"
                                               type="text"
                                               name="address"
                                               value="{{$customer->address ?? ''}}">
                                    </div>
                                </div>

                                <div class="space-y-2 mt-4">
                                    <div class="border-t border-dashed pt-4 text-sm">
                                        <label class="group inline-flex cursor-pointer items-start">
                                            <span class="whitespace-nowrap">
                                                <input class="peer absolute opacity-0"
                                                       type="checkbox"
                                                       name="save_info"
                                                       value="1">
                                                <span
                                                        class="h-5 w-5 rounded items-center justify-center border border-neutral-300 text-white/100 group-hover:border-primary-500 cursor-pointer peer-checked:bg-primary-500 peer-checked:border-primary-500 before:contents[' '] before:h-[6px] before:-rotate-45 before:w-[10px] before:border-white before:border-2 before:border-r-0 before:border-t-0 before:mb-[2px] peer-disabled:bg-neutral-600 peer-disabled:border-neutral-600 flex bg-white">
                                                </span>
                                            </span>
                                            <span class="ml-2">
                                                <span class="inline">
                                                    Lưu lại thông tin cho lần mua hàng sau
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <div class="sticky top-[calc(var(--header-position-start-sticky)+12px)] hidden md:grid gap-4"
                         style="--header-position-start-sticky: 0px;">
                        <div>
                            <div class="rounded-sm bg-white p-3 grid gap-4">
                                <div class="space-y-2">
                                    <p class="text-base font-semibold text-neutral-900">
                                        Thông tin liên hệ
                                    </p>
                                    <p class="text-sm text-neutral-700">
                                        Bạn đang gửi yêu cầu liên hệ cho
                                        <span class="font-semibold">{{ $cartCount }}</span> sản phẩm.
                                    </p>
                                </div>
                                <button type="submit"
                                        form="checkoutForm"
                                        class="relative flex justify-center items-center w-full px-4 py-2.5 h-12 rounded-lg outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 text-base">
                                    Gửi yêu cầu liên hệ
                                </button>

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
                <div class="flex items-center justify-between p-4">
                    <div class="text-xs text-neutral-700">
                        {{ $cartCount }} sản phẩm đã chọn
                    </div>
                    <button type="submit"
                            form="checkoutForm"
                            class="relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 text-base py-2.5 h-12 items-center rounded-lg px-4">
                        Gửi yêu cầu liên hệ
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
