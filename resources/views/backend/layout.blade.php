<!DOCTYPE html>
<html lang="vn">
<head>
    @php
        $defaults = [
            'title'              => system_setting('seo_meta_title', 'Tên website của bạn'),
            'description'        => system_setting('seo_meta_description', 'Mô tả website của bạn'),
            'favicon' => system_setting('homepage_favicon', asset('frontend/images/favicon.png')),
            'logo' => system_setting('homepage_logo', asset('frontend/images/favicon.png')),
            'shortcut_icon'      => asset('frontend/images/favicon.png'),
        ];
        $seo = array_merge($defaults, $seo ?? []);
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{  asset('storage/' . $seo['favicon']) }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{  asset('storage/' . $seo['favicon']) }}" type="image/png" sizes="30x30">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$seo['title']}}</title>
    <link href="{{URL::asset('backend/assets/css/family.css')}}" rel="stylesheet"
          type="text/css">
    <link href="{{ URL::asset('backend/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ URL::asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('backend/assets/css/core.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('backend/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('backend/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('backend/assets/css/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('toast/toastr.min.css') }}" rel="stylesheet" type="text/css">
    @stack('styles')
</head>
<body class="{{ session('control') }} pace-done">
<div id="user_id" style="display: none">{{auth()->id()}}</div>
@include('backend.layouts.partials.header')
<div class="page-container">
    <div class="page-content">
        @include('backend.layouts.partials.sidebar')
        <div class="content-wrapper">
            @include('backend.layouts.partials.page-header')
            <div class="content">
                @yield('content')
                @include('backend.layouts.partials.footer')
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('backend/global_assets/js/plugins/loaders/pace.min.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/core/libraries/jquery.min.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/core/libraries/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/notifications/bootbox.min.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/notifications/pnotify.min.js') }}"></script>
<script src="{{ URL::asset('backend/assets/js/loadingoverlay.min.js') }}"></script>
<script src="{{ URL::asset('backend/assets/js/sweet_alert.min.js') }}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
<script src="{{ URL::asset('backend/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{ URL::asset('backend/assets/js/app.js') }}"></script>
<script src="{{ URL::asset('backend/library/seo.js') }}"></script>
<script src="{{ URL::asset('backend/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('backend/library/library.js') }}"></script>
<script src="{{ URL::asset('toast/toastr.min.js') }}"></script>
<script>
    var _token = '{{ csrf_token()  }}';
    var BASE_URL = '{{ config('app.url')  }}';
    const changeStatus = "{{ route('ajax.changeStatus') }}";
</script>
@stack('scripts')
</body>
</html>
