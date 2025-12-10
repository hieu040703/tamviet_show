@php
    $admin = Auth::guard('admin')->user();
@endphp

<div class="sidebar sidebar-main {{ session('control') == null ? 'sidebar-fixed' : ''}}">
    <div class="sidebar-content">

        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left">
                        <img src="{{URL::asset('backend/global_assets/images/demo/users/face11.jpg')}}"
                             class="img-circle img-sm" alt="">
                    </a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{ $admin->name ?? '' }}</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-mail5 text-size-small"></i>
                            {{ $admin->email ?? '' }}
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
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>

                    <li class="{{ @$sidebar == null ? 'active' : null }}">
                        <a href="{{ route('admin.backend.home') }}"><i class="icon-home4"></i>
                            <span>Dashboard</span></a>
                    </li>

                    @if($admin && $admin->hasPermission('view_category'))
                        <li class="{{ isset($sidebar) && $sidebar == 'Category' ? 'active' : '' }}">
                            <a href="{{ route('admin.categories.index') }}"><i class="icon-server"></i>
                                <span>Quản lý danh mục</span></a>
                        </li>
                    @endif

                    @if($admin && $admin->hasPermission('view_brand'))
                        <li class="{{ isset($sidebar) && $sidebar == 'Brand' ? 'active' : '' }}">
                            <a href="{{ route('admin.brands.index') }}"><i class="icon-git-branch"></i>
                                <span>Quản lý thương hiệu</span></a>
                        </li>
                    @endif

                    @if($admin && $admin->hasPermission('view_product'))
                        <li class="{{ isset($sidebar) && $sidebar == 'Product' ? 'active' : '' }}">
                            <a href="{{route('admin.products.index')}}"><i class="icon-printer4"></i>
                                <span>Quản lý sản phẩm</span></a>
                        </li>
                    @endif

                    @if($admin && $admin->hasPermission('view_post_catalogue'))
                        <li class="{{ isset($sidebar) && $sidebar == 'PostCatalogue' ? 'active' : '' }}">
                            <a href="{{route('admin.post_catalogues.index')}}"><i class=" icon-files-empty2"></i>
                                <span>Quản lý nhóm bài viết</span></a>
                        </li>
                    @endif
                    @if($admin && $admin->hasPermission('view_post'))
                        <li class="{{ isset($sidebar) && $sidebar == 'Post' ? 'active' : '' }}">
                            <a href="{{route('admin.posts.index')}}"><i class="icon-blogger"></i>
                                <span>Quản lý bài viết</span></a>
                        </li>
                    @endif
                    @if($admin && $admin->hasPermission('view_banner'))
                        <li class="{{ isset($sidebar) && $sidebar == 'Banner' ? 'active' : '' }}">
                            <a href="{{ route('admin.banners.index') }}">
                                <i class="icon-image2"></i>
                                <span>Quản lý Banner</span>
                            </a>
                        </li>
                    @endif
                    @if($admin && $admin->hasPermission('view_widget'))
                        <li class="{{ (isset($sidebar) && $sidebar == 'Widget') ? 'active' : '' }}">
                            <a href="{{ route('admin.widgets.index') }}">
                                <i class="icon-grid"></i>
                                <span>Widget</span>
                            </a>
                        </li>
                    @endif
                    @if($admin && $admin->hasPermission('view_menu'))
                        <li class="{{ (isset($sidebar) && $sidebar == 'Menu') ? 'active' : '' }}">
                            <a href="{{ route('admin.menus.index') }}">
                                <i class="icon-list2"></i>
                                <span>Menu</span>
                            </a>
                        </li>
                    @endif
                    @if($admin && $admin->hasPermission('view_contact'))
                        <li class="{{ (isset($sidebar) && $sidebar == 'Contact') ? 'active' : '' }}">
                            <a href="{{ route('admin.contacts.index') }}">
                                <i class="icon-cart2"></i>
                                <span>Liên hệ</span>
                            </a>
                        </li>
                    @endif
                    @if($admin && $admin->hasPermission('view_user'))
                        <li class="{{ isset($sidebar) && $sidebar == 'User' ? 'active' : '' }}">
                            <a href="{{ route('admin.users.index') }}">
                                <i class="icon-users4"></i>
                                <span>Quản lý thành viên</span>
                            </a>
                        </li>
                    @endif

                    @if($admin && $admin->hasPermission('view_role'))
                        <li class="{{ isset($sidebar) && $sidebar == 'Role' ? 'active' : '' }}">
                            <a href="{{ route('admin.roles.index') }}">
                                <i class="icon-user-check"></i>
                                <span>Quản lý vai trò</span>
                            </a>
                        </li>
                    @endif
                    @if($admin && $admin->hasPermission('view_permission'))
                        <li class="{{ isset($sidebar) && $sidebar == 'Permission' ? 'active' : '' }}">
                            <a href="{{ route('admin.permissions.index') }}">
                                <i class="icon-key"></i>
                                <span>Quản lý quyền</span>
                            </a>
                        </li>
                    @endif
                    <li class="{{ @$sidebar == 'SystemLibrary' ? 'active' : null }}">
                        <a href="{{route('admin.system.index')}}"><i class="icon-lifebuoy"></i>
                            <span>Cấu hình hệ thống</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
