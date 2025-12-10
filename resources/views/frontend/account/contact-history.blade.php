@extends('frontend.layout')

@section('content')
    <div id="account" class="h-[100vh] md:h-auto md:pt-0">
        <div class="mx-auto max-w-screen-xl md:container md:pb-4">
            <div class="md:mt-4 md:flex md:gap-4">
                <div class="hidden md:block">
                    <div>
                        <div class="grid w-[288px] gap-4 rounded-md bg-white">
                            <div class="px-4 pt-4">
                                <div class="grid gap-4">
                                    <div class="flex items-center gap-2">
                                        <img
                                            class="rounded-full w-12 h-12 object-cover"
                                            src="{{ $avatar }}"
                                            alt="avatar"
                                            loading="lazy"
                                            width="500"
                                            height="500"
                                            data-customer-avatar
                                        >
                                        <div class="flex-1 text-sm font-medium">
                                            <div class="text-neutral-900 text-base font-bold capitalize"
                                                 data-customer-name>
                                                {{ $displayName ?? 'Khách hàng' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                @include('frontend.account.sidebar')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 md:max-w-[calc(1200px-288px-16px)]">
                    <div>
                        <div class="pb-8 pt-11 md:pb-0 md:pt-0">
                            <div class="fixed left-0 top-0 z-10 h-11 w-full bg-white md:hidden">
                                <div class="z-50 grid w-full content-start gap-4 bg-white px-4 py-2.5 md:py-4">
                                    <div class="flex">
                                        <div class="flex w-6 items-center">
                                            <button data-size="sm" type="button" data-back-button="true"
                                                    class="relative flex justify-center outline-none font-semibold focus:ring-primary-300 text-sm bg-transparent data-[size=sm]:text-sm border-0 hover:bg-0 hover:text-primary-500 focus:text-primary-500 h-6 p-0 text-neutral-900">
                                        <span
                                            class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full w-6 h-6">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.29231 12.7138L15.2863 21.7048C15.6809 22.0984 16.3203 22.0984 16.7159 21.7048C17.1106 21.3111 17.1106 20.6717 16.7159 20.2781L8.43539 12.0005L16.7149 3.72293C17.1096 3.32928 17.1096 2.68989 16.7149 2.29524C16.3203 1.90159 15.6799 1.90159 15.2853 2.29524L6.29131 11.2861C5.90273 11.6757 5.90273 12.3251 6.29231 12.7138Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                            </button>
                                        </div>
                                        <div class="grid flex-1 items-center text-center">
                                            <h4
                                                class="truncate px-2 text-base font-semibold text-neutral-900 md:text-2xl md:font-bold">
                                                Lịch sử liên hệ
                                            </h4>
                                        </div>
                                        <div class="w-6"></div>
                                    </div>
                                </div>
                            </div>

                            @php
                                use App\Models\ContactRequest;
                                $orders = $requests ?? collect();
                                $completedCount  = $orders->where('status', ContactRequest::STATUS_DONE)->count();
                                $processingCount = $orders->where('status', ContactRequest::STATUS_PROCESSING)->count();
                                $pendingCount    = $orders->where('status', ContactRequest::STATUS_PENDING)->count();
                            @endphp

                            <div class="group pb-[64px] md:pb-0">
                                <div class="flex items-center max-md:p-2 md:pb-4">
                                    <h1
                                        class="flex-1 text-xl font-semibold text-neutral-900 max-md:hidden">
                                        Lịch sử đơn hàng
                                    </h1>
                                </div>

                                <div
                                    class="mb-2 bg-white pt-1 md:rounded md:p-0">
                                    <div
                                        class="scrollbar-hide flex max-w-full justify-start overflow-x-auto space-x-0 md:space-x-0">
                                        <button data-size="sm" type="button"
                                                data-order-tab
                                                data-status="all"
                                                class="relative flex justify-center outline-none font-semibold bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 py-2 h-9 items-center whitespace-nowrap border-b-2 rounded-none px-3.5 md:h-11 flex-1 md:px-2 text-primary-500 !bg-white border-primary-500 text-sm">
                                            <span>Tất cả</span>
                                        </button>
                                        <button data-size="sm" type="button"
                                                data-order-tab
                                                data-status="completed"
                                                class="relative flex justify-center outline-none font-semibold bg-neutral-200 border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm py-2 h-9 items-center whitespace-nowrap !bg-white border-b-2 border-white rounded-none px-3.5 md:h-11 flex-1 md:px-2">
                                            <span>Hoàn thành ({{ $completedCount }})</span>
                                        </button>
                                        <button data-size="sm" type="button"
                                                data-order-tab
                                                data-status="processing"
                                                class="relative flex justify-center outline-none font-semibold bg-neutral-200 border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm py-2 h-9 items-center whitespace-nowrap !bg-white border-b-2 border-white rounded-none px-3.5 md:h-11 flex-1 md:px-2">
                                            <span>Đang xử lý ({{ $processingCount }})</span>
                                        </button>
                                        <button data-size="sm" type="button"
                                                data-order-tab
                                                data-status="pending"
                                                class="relative flex justify-center outline-none font-semibold bg-neutral-200 border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm py-2 h-9 items-center whitespace-nowrap !bg-white border-b-2 border-white rounded-none px-3.5 md:h-11 flex-1 md:px-2">
                                            <span>Chờ xử lý ({{ $pendingCount }})</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-2" data-order-list>
                                    <div class="mt-2">
                                        @foreach($orders as $order)
                                            @php
                                                if ($order->status == ContactRequest::STATUS_DONE) {
                                                    $statusKey = 'completed';
                                                } elseif ($order->status == ContactRequest::STATUS_PROCESSING) {
                                                    $statusKey = 'processing';
                                                } elseif ($order->status == ContactRequest::STATUS_PENDING) {
                                                    $statusKey = 'pending';
                                                } else {
                                                    $statusKey = 'cancelled';
                                                }

                                                $firstItem = $order->items->first();
                                                $otherCount = max(0, $order->items->count() - 1);

                                                $imageUrl = '';
                                                if ($firstItem && $firstItem->product_image) {
                                                    if (strpos($firstItem->product_image, 'http://') === 0 || strpos($firstItem->product_image, 'https://') === 0) {
                                                        $imageUrl = $firstItem->product_image;
                                                    } else {
                                                        $imageUrl = asset('storage/' . ltrim($firstItem->product_image, '/'));
                                                    }
                                                }
                                            @endphp

                                            <div class="mb-2 cursor-pointer bg-white px-4 py-3 md:rounded-md"
                                                 data-order-item
                                                 data-order-status="{{ $statusKey }}">
                                                <div
                                                    class="flex items-center border-b border-divider pb-2 md:border-dashed">
                                                    <div class="flex flex-1">
                                                        <span
                                                            class="py-[2px] flex items-center rounded-full px-2 text-sm font-semibold h-7 bg-primary-50 text-primary-500">
                                                            <span>Liên hệ online</span>
                                                        </span>
                                                    </div>
                                                    <div class="text-sm text-neutral-700">
                                                        {{ $order->created_at ? $order->created_at->format('H:i d/m/Y') : '' }}
                                                    </div>
                                                </div>

                                                <span class="text-[14px] leading-[20px] block pt-3">
                                                    Mã đơn:
                                                    <span class="mr-2 font-semibold text-inherit">
                                                        CR{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}
                                                    </span>
                                                </span>

                                                <div class="flex items-start justify-between gap-2 pt-2">
                                                    @if($imageUrl)
                                                        <img
                                                            class="object-fit h-16 w-16 rounded-sm border"
                                                            src="{{ $imageUrl }}"
                                                            alt="{{ $firstItem ? $firstItem->product_name : '' }}"
                                                            loading="lazy"
                                                            width="500"
                                                            height="500">
                                                    @endif
                                                    <div class="grid flex-1 md:flex md:gap-2">
                                                        <div class="md:flex-1">
                                                            <h4 class="text-[14px] font-semibold leading-[20px] line-clamp-2">
                                                                {{ $firstItem ? $firstItem->product_name : 'Yêu cầu tư vấn sản phẩm' }}
                                                            </h4>
                                                            <span class="text-[14px] leading-[20px] text-neutral-700">
                                                                Trạng thái: {{ $order->status_label }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($otherCount > 0)
                                                    <span class="text-[14px] leading-[20px] block text-end">
                                                        Cùng {{ $otherCount }} sản phẩm khác
                                                        <span
                                                            class="p-icon-1 inline-flex align-[-0.125em] justify-center max-h-full max-w-full h-3 w-3">
                                                            <svg
                                                                viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.2137 11.2862L8.21971 2.29524C7.82506 1.90159 7.18567 1.90159 6.79002 2.29524C6.39537 2.68889 6.39537 3.32829 6.79002 3.72194L15.0706 11.9995L6.79102 20.2771C6.39637 20.6707 6.39637 21.3101 6.79102 21.7048C7.18567 22.0984 7.82606 22.0984 8.22071 21.7048L17.2147 12.7139C17.6032 12.3243 17.6032 11.6749 17.2137 11.2862Z"
                                                                    fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                @endif

                                                <div class="mt-2 flex justify-end gap-2"></div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-2" data-empty-block
                                         style="{{ $orders->isEmpty() ? '' : 'display:none;' }}">
                                        <div class="bg-white p-4 md:rounded">
                                            <div
                                                class="grid items-center justify-center justify-items-center gap-3 h-full p-4 md:p-10">
                                                <div
                                                    class="grid items-center justify-center justify-items-center text-center">
                                                    <div
                                                        class="m-auto block aspect-square mb-3 md:mb-4 w-[calc(120rem/16)] h-[calc(120rem/16)] md:w-[calc(160rem/16)] md:h-[calc(160rem/16)]">
                                                        <img class="max-h-[100%] max-w-[100%] object-contain"
                                                             src="https://prod-cdn.pharmacity.io/e-com/images/static-website/20240706155228-0-empty-order-history.svg"
                                                             alt="" loading="lazy" width="500" height="500">
                                                    </div>
                                                    <div class="grid justify-items-center gap-2">
                                                        <div class="text-base font-semibold text-neutral-900">
                                                            <span>Không có đơn hàng nào</span>
                                                        </div>
                                                        <div class="flex justify-center text-sm">
                                                            <div
                                                                class="grid w-screen justify-items-center gap-4 md:w-[calc(368rem/16)]">
                                                                <span class="n px-4 text-sm md:px-0">Hãy thêm sản phẩm vào giỏ hàng và tạo đơn hàng của bạn ngay hôm nay!</span>
                                                                <a class="relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 text-sm px-4 py-2 h-9 items-center rounded-lg"
                                                                   href="/"> Chọn sản phẩm</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
