@if(!empty($products) && count($products))
    @foreach($products as $product)
        @php
            $image = $product->image
                ? asset('storage/'.$product->image)
                : asset('backend/img/not-found.jpg');
        @endphp
        <div class="relative !max-h-[460px]">
            <div class="product-card flex h-full flex-col">
                <div class="flex h-full flex-1 flex-col overflow-hidden rounded-lg border bg-white pb-[1px] shadow-sm">
                    <div class="product-card-image">
                        <a href="{{ router_link('products', $product->id) }}">
                            <img
                                class="max-h-[100%] max-w-[100%] object-contain"
                                src="{{ $image }}"
                                alt="{{ $product->name ?? '' }}"
                                loading="lazy"
                                width="500"
                                height="500"
                            >
                            <span class="absolute bottom-0 left-0 flex h-[26px] w-full"></span>
                        </a>
                    </div>
                    <div class="flex flex-1 flex-col p-2 font-medium">
                        <a href="{{ router_link('products', $product->id) }}">
                            <div>
                                <h3 class="line-clamp-2 h-10 text-sm font-semibold">
                                    {{ $product->name ?? '' }}
                                </h3>
                            </div>
                        </a>
                        <div class="flex flex-1 flex-col justify-end">
                            <div class="flex items-end justify-center">
                                <button
                                    data-open-product-modal
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-image="{{ $image }}"
                                    class="btn-choose-product relative flex justify-center outline-none font-semibold text-white bg-primary-500 border-0 hover:bg-primary-600 focus:ring-primary-300 w-full
                                        text-sm px-4 py-2 h-9 items-center rounded-lg mt-2">
                                    <span>Chọn sản phẩm</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="col-span-full py-6 text-center text-sm text-neutral-600">
        Không tìm thấy sản phẩm phù hợp.
    </p>
@endif
