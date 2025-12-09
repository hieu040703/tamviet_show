@if($products->count())
    <div class="product-list md:pt-0 xl:grid-cols-5 pt-0" id="product-list-inner">
        @include('frontend.components.product-items', ['products' => $products])
    </div>
@else
    <p class="text-sm text-neutral-600">Không có sản phẩm phù hợp.</p>
@endif
