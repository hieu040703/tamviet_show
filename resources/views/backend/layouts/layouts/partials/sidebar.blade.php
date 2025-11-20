<div class="sidebar sidebar-main {{ session('control') == null ? 'sidebar-fixed' : ''}}">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left"><img
                                src="{{URL::asset('backend/global_assets/images/demo/users/face11.jpg')}}"
                                class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold"></span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-mail5 text-size-small"></i>
                        </div>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="#"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="{{ @$sidebar == null ? 'active' : null }}">
                        <a href="{{ route('admin.backend.home') }}"><i class="icon-home4"></i>
                            <span>Dashboard</span></a>
                    </li>
                    <!-- /main -->
                    <!-- Post -->
                    <li class="{{ isset($sidebar) && $sidebar == 'Post' ? 'active' : '' }}">
                        <a href="#"><i class="icon-blogger"></i> <span>{{__('Post management')}}</span></a>
                        <ul style="{{ isset($sidebar) && $sidebar == 'Post' ? 'display:block;' : '' }}">
                            <li class="{{ isset($sidebar_child) && $sidebar_child == 'posts' ? 'active' : '' }}">
                                <a href="{{route('admin.posts.index')}}">{{__('Post management')}}</a>
                            </li>
                            <li class="{{ isset($sidebar_child) && $sidebar_child == 'post_catalogues' ? 'active' : '' }}">
                                <a href="{{route('admin.posts.catalogue.index')}}">{{__('Post type management')}}</a>
                            </li>
                        </ul>
                    </li>
                    <!-- /Post -->
                    <!-- Menu -->
                    <li class="{{ isset($sidebar) && $sidebar == 'menu' ? 'active' : '' }}">
                        <a href="{{route('admin.menus.index')}}"><i class="icon-list2"></i>
                            <span>{{__('Menu')}}</span></a>
                    </li>
                    <!-- /Menu -->
                    <!-- Banner -->
                    <li class="{{ isset($sidebar) && $sidebar == 'banner' ? 'active' : '' }}">
                        <a href="{{route('admin.banners.index')}}"><i class="icon-image5"></i>
                            <span>{{__('Banner')}}</span></a>
                    </li>
                    <!-- /Banner -->
                    <!-- Customer -->
                    <!-- /Customer -->
                    <!-- System -->
                    <li @class(['active' => request()->routeIs('admin.system.*')])>
                        <a href="{{ route('admin.system.index') }}">
                            <i class="icon-lifebuoy"></i>
                            <span>{{ __('SystemLibrary') }}</span>
                        </a>
                    </li>
                    <!-- /System -->
                </ul>
            </div>
        </div>
        </ul>
    </div>
</div>
