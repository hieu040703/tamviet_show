<h1>{{ $product->name }}</h1>

<p>Mã: {{ $product->code }}</p>
<p>SKU: {{ $product->sku }}</p>
<p>Số lượng: {{ $product->quantity }}</p>

@if($product->qr_code)
    <p>QR code:</p>
    <img src="{{ asset('storage/'.$product->qr_code) }}" alt="QR {{ $product->name }}" width="200">
@endif

