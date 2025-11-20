<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('admin.backend.home') }}">
            @if (!empty($system['homepage_logo']))
                <img style="max-width: 100px; height: auto;" src="{{ asset($system['homepage_logo']) }}" alt="Logo">
            @else
                <img  style="max-width: 100px; height: auto;" src="" alt="Default Logo">
            @endif
        </a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('admin.control') }}" class="sidebar-control hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>

        <p class="navbar-text"><span class="label bg-success">Online</span></p>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ Auth::user()->image ? URL::asset( Auth::user()->image): URL::asset('backend/global_assets/images/demo/users/face11.jpg') }}" alt="">
                    <span> {{ Auth::user()->name }} </span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> Thông tin cá nhân</a></li>
                    <li><a href="#"><i class="icon-coins"></i> Xem số dư</a></li>
                    <li><a href="#" id="logout-link"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ URL::asset('backend/global_assets/images/lang/'.app()->getLocale().'.png') }}" alt="">
                    <span>{{ mb_strtoupper(app()->getLocale()) }}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right m-w-100">
                    <li>
                        <a href="#" class="lh-lg lang-switch" data-lang="en">
                            <img src="{{ URL::asset('backend/global_assets/images/lang/en.png') }}" alt=""> EN
                        </a>
                    </li>
                    <li>
                        <a href="#" class="lh-lg lang-switch" data-lang="vi">
                            <img src="{{ URL::asset('backend/global_assets/images/lang/vi.png') }}" alt=""> VN
                        </a>
                    </li>
                    <li>
                        <a href="#" class="lh-lg lang-switch" data-lang="zh">
                            <img src="{{ URL::asset('backend/global_assets/images/lang/zh.png') }}" alt=""> ZH
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST" style="display: none" id="logout-form">
        @csrf
    </form>
</div>
<script>
    document.getElementById('logout-link').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    });

</script>
<script>
    var BASE_URL = '{{ config('app.url')  }}'
    var SUFFIX = '{{ config('apps.general.suffix')  }}'
</script>
