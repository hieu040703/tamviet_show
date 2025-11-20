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
