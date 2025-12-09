<<<<<<< HEAD
<title>@yield('title', 'Tên website của bạn')</title>
<meta name="description" content="@yield('meta_description', 'Mô tả website của bạn')"/>
<link rel="canonical" href="{{ url()->current() }}"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="@yield('og_title', 'Tên website của bạn')"/>
<meta property="og:description" content="@yield('og_description', 'Mô tả website của bạn')"/>
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:image" content="@yield('og_image', asset('frontend/images/default-og.jpg'))"/>
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:title" content="@yield('twitter_title', 'Tên website của bạn')"/>
<meta name="twitter:description" content="@yield('twitter_description', 'Mô tả website của bạn')"/>
<meta name="twitter:image" content="@yield('twitter_image', asset('frontend/images/default-og.jpg'))"/>
=======
@php
    $defaults = [
        'title'              => system_setting('seo_meta_title', 'Tên website của bạn'),
        'description'        => system_setting('seo_meta_description', 'Mô tả website của bạn'),
        'keywords'           => system_setting('seo_meta_keyword', 'tu khoa 1, tu khoa 2'),

        'author'             => system_setting('seo_meta_author', config('app.name')),
        'robots'             => system_setting('seo_meta_robots', 'index,follow'),
        'canonical'          => system_setting('seo_meta_canonical',url()->current()),
        'og_type'            => 'website',
        'og_site_name'       => system_setting('seo_site_name', config('app.name')),
        'og_title'           => system_setting('seo_meta_title', 'Tên website của bạn'),
        'og_description'     => system_setting('seo_meta_description', 'Mô tả website của bạn'),
        'og_url'             => url()->current(),
        'og_image'           => system_setting('seo_meta_image', asset('backend/img/not-found.jpg')),
        'og_image_width'     => '1200',
        'og_image_height'    => '630',
        'og_locale'          => 'vi_VN',
        'twitter_card'       => 'summary_large_image',
        'twitter_title'      => system_setting('seo_meta_title', 'Tên website của bạn'),
        'twitter_description'=> system_setting('seo_meta_description', 'Mô tả website của bạn'),
        'twitter_image'      => system_setting('seo_meta_image',  asset('backend/img/not-found.jpg')),
        'twitter_site'       => '@ten_twitter_cua_ban',
        'twitter_creator'    => '@ten_twitter_cua_ban',
        'favicon' => system_setting('homepage_favicon', asset('frontend/images/favicon.png')),
        'shortcut_icon'      => asset('frontend/images/favicon.png'),
    ];
    $seo = array_merge($defaults, $seo ?? []);
@endphp
<base href="{{ config('app.url') }}"/>

<title>{{ $seo['title'] }}</title>
<meta charset="utf-8">
<meta name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="telephone=no, date=no, email=no, address=no">
<meta name="theme-color" content="#1B51A3">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="{{ $seo['description'] }}">
<meta name="keywords" content="{{ $seo['keywords'] }}">
<meta name="author" content="{{ $seo['author'] }}">
<meta name="robots" content="{{ $seo['robots'] }}">

<link rel="canonical" href="{{ $seo['canonical'] }}">

<meta property="og:type" content="{{ $seo['og_type'] }}">
<meta property="og:site_name" content="{{ $seo['og_site_name'] }}">
<meta property="og:title" content="{{ $seo['og_title'] }}">
<meta property="og:description" content="{{ $seo['og_description'] }}">
<meta property="og:url" content="{{ $seo['og_url'] }}">
<meta property="og:image" content="{{ $seo['og_image'] }}">
<meta property="og:image:width" content="{{ $seo['og_image_width'] }}">
<meta property="og:image:height" content="{{ $seo['og_image_height'] }}">
<meta property="og:locale" content="{{ $seo['og_locale'] }}">

<meta name="twitter:card" content="{{ $seo['twitter_card'] }}">
<meta name="twitter:title" content="{{ $seo['twitter_title'] }}">
<meta name="twitter:description" content="{{ $seo['twitter_description'] }}">
<meta name="twitter:image" content="{{ $seo['twitter_image'] }}">
<meta name="twitter:site" content="{{ $seo['twitter_site'] }}">
<meta name="twitter:creator" content="{{ $seo['twitter_creator'] }}">
<link rel="icon"
      href="{{  asset('storage/' . $seo['favicon']) }}">
<link rel="shortcut icon" href="{{ asset('storage/' . $seo['shortcut_icon'])  }}" type="image/x-icon">
>>>>>>> hieu/update-feature
