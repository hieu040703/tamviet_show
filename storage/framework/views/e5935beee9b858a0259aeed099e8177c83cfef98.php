<!DOCTYPE html>
<html lang="vi" class="__className_53db79">
<head>
    <?php echo $__env->make('frontend.layouts.partials.head-seo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
    <link rel="icon" href="<?php echo e(asset('frontend/favicon.ico')); ?>" type="image/x-icon" sizes="256x256"/>
    <link rel="apple-touch-icon" href="<?php echo e(asset('frontend/apple-icon.png')); ?>" type="image/png" sizes="512x512"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/bfcdc645c261a7b6.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/720694635bedc64e.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/90b79672a2245128.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/94b9fda2336e421b.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/2e85c571399b9690.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/ef7bf05a6bd0bde1.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/b9b07d7c9a83825f.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/5ceedd994789651e.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/aa084c0e1aa2f9f4.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/5b809539f154a53a.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/2639256c5596b8d3.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/2b3d77a2a147a3e6.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/7cc98b5d3f257610.css')); ?>" data-precedence="next"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/styles.css')); ?>" data-precedence="next"/>
</head>

<body class="bg-neutral-100 md:h-[100%]">
<main>
    <?php echo $__env->make('frontend.layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('frontend.layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.layouts.partials.bottom-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.layouts.partials.btnZaloChat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.components.product-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.components.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.components.register', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</main>
<?php echo $__env->make('frontend.components.toast', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    window.APP_ROUTES = {
        addToCart: <?php echo json_encode(route('cart.ajaxAdd'), 15, 512) ?>,
        cartUpdate: <?php echo json_encode(route('cart.ajaxUpdate'), 15, 512) ?>,
        cartRemove: <?php echo json_encode(route('cart.ajaxRemove'), 15, 512) ?>,
        cartClear:  <?php echo json_encode(route('cart.ajaxClear'), 15, 512) ?>,
        checkout:  <?php echo json_encode(route('checkout.index'), 15, 512) ?>,
        login: <?php echo json_encode(route('ajax.login'), 15, 512) ?>,
        register: <?php echo json_encode(route('ajax.register'), 15, 512) ?>,
        logout:<?php echo json_encode(route('ajax.logout'), 15, 512) ?>,
        home: <?php echo json_encode(route('homepage.index'), 15, 512) ?>,
        accountPath:  <?php echo json_encode(route('account.index'), 15, 512) ?>,
        redirectUrl:  <?php echo json_encode(route('account.personal-info'), 15, 512) ?>,
        breakpoint: 768
    };
    window.APP_STATE = window.APP_STATE || {};
    window.APP_STATE.isAuthenticated = <?php echo e(auth('web')->check() ? 'true' : 'false'); ?>;
</script>
<script src="<?php echo e(asset('frontend/assets/js/cart.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/assets/js/auth-popup.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/assets/js/mobile-menu.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/assets/js/account-redirect.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/assets/js/back.js')); ?>"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/layout.blade.php ENDPATH**/ ?>