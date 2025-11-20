@extends('frontend.layout')
@section('content')
    <div id="mainContent" class="z-20 mx-auto bg-white pt-14 md:pt-4">
        <div class="md:pb-0 pb-[87px]">
            <div>
                @include('frontend.components.breadcrumb', ['items' => $breadcrumb ?? []])
                <div class="block md:hidden"></div>
                <div
                    class="relative grid grid-cols-1 gap-6 md:container md:grid-cols-[min(60%,calc(555rem/16)),1fr] md:pt-6 lg:grid-cols-[min(72%,calc(888rem/16)),1fr]">
                    <div class="grid md:gap-3">
                        <div class="grid grid-cols-1 items-start md:gap-6 lg:grid-cols-2 xl:grid-cols-2">
                            <div class="md:sticky md:top-0">
                                @include('frontend.product.partials.album', ['product' => $product])
                            </div>
                            <div>
                                <div class="flex flex-col">
                                    <div class="md:mb-2"></div>
                                    <div
                                        class="mb-4 block bg-primary-50 px-2 py-1.5 text-center text-xs font-medium text-primary-400 md:mb-0 md:hidden">
                                        Sản phẩm 100% chính hãng, mẫu mã có thể thay đổi theo lô hàng
                                    </div>
                                    <div class="flex flex-col px-4 md:px-0">
                                        <div class="grid grid-cols-[1fr,calc(24rem/16)] gap-4 md:grid-cols-1 mb-2">
                                            <h1 title="{{$product->name ?? ''}}"
                                                class="line-clamp-3 text-base font-semibold text-neutral-900 md:text-xl md:font-bold">
                                                {{$product->name ?? ''}}
                                            </h1>
                                        </div>
                                        <div class="flex items-center justify-between mb-3 md:mb-4">
                                            <div class="flex content-start items-center space-x-1 py-[calc(2rem/16)]">
                                                <p class="text-sm leading-5 text-neutral-600">{{$product->sku ?? ''}}</p>
                                                <span class="h-1 w-1 rounded-full bg-neutral-600"></span>
                                                @if($product->brand)
                                                    <a class="text-sm leading-5 text-primary-500"
                                                       href="{{ router_link('brands', $product->brand->id) }}">
                                                        Thương hiệu: {{ $product->brand->name }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="gap-3 md:gap-4 mb-3 grid md:mb-4">
                                            <div class="bg-divider h-[1px] -mx-4 md:mx-0"></div>
                                            <div class="grid gap-3 md:gap-2">
                                                @if($product->category)
                                                    <div class="grid grid-cols-1 gap-1.5 md:grid-cols-[1fr,291px]">
                                                        <p class="text-[14px] leading-[20px] font-semibold md:text-base">
                                                            Danh mục
                                                        </p>
                                                        <div
                                                            class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink md:text-base">
                                                            {{$product->category->name}}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($product->description)
                                                    <div class="grid grid-cols-1 gap-1.5 md:grid-cols-[1fr,291px]">
                                                        <p class="text-[14px] leading-[20px] font-semibold md:text-base">
                                                            Mô tả ngắn
                                                        </p>
                                                        <div
                                                            class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink md:text-base">
                                                            {!! $product->description !!}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($product->note)
                                                    <div class="grid grid-cols-1 gap-1.5 md:grid-cols-[1fr,291px]"><p
                                                            class="text-[14px] leading-[20px] font-semibold md:text-base">
                                                            Lưu ý</p>
                                                        <div
                                                            class="[&amp;_a:not(.ignore-css_a)]:text-hyperLink md:text-base">
                                                            <p>{{$product->note ?? ''}}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($product->content)
                            <div class="bg-divider h-[1px] hidden w-full md:block"></div>
                            <div>
                                <div class="bg-neutral-100 h-3 md:hidden"></div>
                                <div class="grid">
                                    <div class="grid grid-flow-col justify-between p-4 md:hidden">
                                        <h4 class="text-[16px] font-semibold leading-[24px] whitespace-nowrap">
                                            Mô tả sản phẩm
                                        </h4>
                                        <button class="h-5 p-0 text-sm text-hyperLink" type="button"
                                                data-role="toggle-description"
                                                aria-controls="product-description-content"
                                                aria-expanded="false" data-state="closed">
                                            Xem chi tiết
                                        </button>
                                    </div>
                                    <div
                                        class="sticky top-0 z-10 -mt-3 hidden bg-white shadow-xl shadow-white md:block">
                                        <div class="relative overflow-hidden">
                                            <div
                                                class="swiper swiper-initialized swiper-horizontal swiper-free-mode product-information-tab w-full cursor-pointer swiper-backface-hidden">
                                                <div class="swiper-wrapper">
                                                    <div
                                                        class="swiper-slide mr-2 !w-fit last:mr-0 md:mr-6 swiper-slide-active">
                                                        <div class="p-0">
                                                            <div color="primary"
                                                                 class="px-2 py-3 text-base font-semibold md:px-0 border-b-2 border-primary-500 text-primary-500 disabled:border-neutral-800 disabled:!bg-white disabled:text-neutral-700">
                                                                <span>Mô tả sản phẩm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="max-md:pb-2 md:h-auto md:max-h-[inherit]"
                                         id="product-description-wrapper">
                                        <div data-state="closed" class="group">
                                            <div
                                                data-state="closed"
                                                id="product-description-content"
                                                class="overflow-hidden transition-all data-[state=closed]:block data-[state=closed]:max-h-[140px] md:data-[state=closed]:max-h-[480px]"
                                            >
                                                <div class="grid px-4 md:px-0 md:py-2">
                                                    {!! $product->content !!}
                                                </div>
                                            </div>

                                            <div class="relative flex items-center justify-center">
                                                <div data-role="description-overlay"
                                                     class="absolute inset-x-0 bottom-full h-16 bg-gradient-to-b from-black/0 to-[#FFF_78.91%] group-data-[state=closed]:block group-data-[state=open]:hidden to-[#ffffff]"></div>

                                                <button
                                                    class="relative justify-center border-0 bg-transparent text-sm font-normal text-hyperLink outline-none md:hover:text-primary-600 md:text-base hidden md:block"
                                                    type="button"
                                                    data-role="toggle-description"
                                                    aria-controls="product-description-content"
                                                    aria-expanded="false"
                                                    data-state="closed"
                                                >
                                                    Xem thêm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @include('frontend.product.partials.cta-desktop')
                    @include('frontend.product.partials.cta-mobile')
                    @include('frontend.product.partials.add-to-cart-modal')
                </div>
            </div>
            <div class="bg-neutral-100 h-3"></div>
            @include('frontend.product.partials.related-brand', ['relatedProducts' => $relatedProducts])
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('frontend/assets/js/product.js') }}"></script>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('addToCartModal');
            if (!modal) return;

            const openBtns = document.querySelectorAll('[data-qty-modal-trigger]');
            const closeBtns = modal.querySelectorAll('[data-modal-close]');
            const primaryBtn = document.getElementById('qtyModalPrimaryBtn');
            const labelSpan = document.getElementById('qtyModalPrimaryLabel');
            const qtyInput = modal.querySelector('[data-qty-input]');

            function openModal(trigger) {
                const label = trigger.dataset.label || 'Thêm vào giỏ';
                const url = trigger.dataset.url || '#';
                const action = trigger.dataset.action || 'cart';

                labelSpan.textContent = label;      // đổi text: Thêm vào giỏ / Mua ngay
                primaryBtn.dataset.url = url;        // lưu link tương ứng
                primaryBtn.dataset.action = action;   // lưu loại hành động

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

            // Click nút trong modal
            primaryBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const urlBase = this.dataset.url || '#';
                const action = this.dataset.action || 'cart';
                const qty = qtyInput ? (qtyInput.value || 1) : 1;

                // Ví dụ: gửi bằng GET, thêm qty vào query
                const finalUrl = urlBase + (urlBase.includes('?') ? '&' : '?') + 'qty=' + encodeURIComponent(qty);

                // Nếu muốn xử lý khác cho buy/cart thì check action ở đây
                // if (action === 'buy') { ... }

                window.location.href = finalUrl;
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        });
    </script>
@endpush



