<!DOCTYPE html>
<html lang="vi" class="__className_53db79">
<head>
    @include('frontend.layouts.partials.head-seo')
    @stack('head')
    <link rel="icon" href="{{ asset('frontend/favicon.ico') }}" type="image/x-icon" sizes="256x256"/>
    <link rel="apple-touch-icon" href="{{ asset('frontend/apple-icon.png') }}" type="image/png" sizes="512x512"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bfcdc645c261a7b6.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/720694635bedc64e.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/90b79672a2245128.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/94b9fda2336e421b.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/2e85c571399b9690.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/ef7bf05a6bd0bde1.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/b9b07d7c9a83825f.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/5ceedd994789651e.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/aa084c0e1aa2f9f4.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/5b809539f154a53a.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/2639256c5596b8d3.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/2b3d77a2a147a3e6.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/7cc98b5d3f257610.css') }}" data-precedence="next"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/styles.css') }}" data-precedence="next"/>
</head>

<body class="bg-neutral-100 md:h-[100%]">
<main>
    @include('frontend.layouts.partials.header')
    @yield('content')
    @include('frontend.layouts.partials.footer')
    @include('frontend.layouts.partials.bottom-nav')
    @include('frontend.layouts.partials.btnZaloChat')
    @include('frontend.components.product-modal')
    @include('frontend.components.login')
    @include('frontend.components.register')

</main>
@include('frontend.components.toast')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    window.APP_ROUTES = {
        addToCart: @json(route('cart.ajaxAdd')),
        cartUpdate: @json(route('cart.ajaxUpdate')),
        cartRemove: @json(route('cart.ajaxRemove')),
        cartClear:  @json(route('cart.ajaxClear')),
        checkout:  @json(route('checkout.index')),
        login: @json(route('ajax.login')),
        register: @json(route('ajax.register')),
        logout:@json(route('ajax.logout')),
        home: @json(route('homepage.index')),
        accountPath:  @json(route('account.index')),
        redirectUrl:  @json(route('account.personal-info')),
        breakpoint: 768
    };
    window.APP_STATE = window.APP_STATE || {};
    window.APP_STATE.isAuthenticated = {{ auth('web')->check() ? 'true' : 'false' }};
</script>
<script src="{{ asset('frontend/assets/js/cart.js') }}"></script>
<script src="{{ asset('frontend/assets/js/auth-popup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/mobile-menu.js') }}"></script>
<script src="{{ asset('frontend/assets/js/account-redirect.js') }}"></script>
<script src="{{ asset('frontend/assets/js/back.js') }}"></script>
@stack('scripts')
</body>
</html>
