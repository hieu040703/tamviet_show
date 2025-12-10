<?php
    $admin = Auth::guard('admin')->user();
?>

<div class="sidebar sidebar-main <?php echo e(session('control') == null ? 'sidebar-fixed' : ''); ?>">
    <div class="sidebar-content">

        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left">
                        <img src="<?php echo e(URL::asset('backend/global_assets/images/demo/users/face11.jpg')); ?>"
                             class="img-circle img-sm" alt="">
                    </a>
                    <div class="media-body">
                        <span class="media-heading text-semibold"><?php echo e($admin->name ?? ''); ?></span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-mail5 text-size-small"></i>
                            <?php echo e($admin->email ?? ''); ?>

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

                    <li class="<?php echo e(@$sidebar == null ? 'active' : null); ?>">
                        <a href="<?php echo e(route('admin.backend.home')); ?>"><i class="icon-home4"></i>
                            <span>Dashboard</span></a>
                    </li>

                    <?php if($admin && $admin->hasPermission('view_category')): ?>
                        <li class="<?php echo e(isset($sidebar) && $sidebar == 'Category' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.categories.index')); ?>"><i class="icon-server"></i>
                                <span>Quản lý danh mục</span></a>
                        </li>
                    <?php endif; ?>

                    <?php if($admin && $admin->hasPermission('view_brand')): ?>
                        <li class="<?php echo e(isset($sidebar) && $sidebar == 'Brand' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.brands.index')); ?>"><i class="icon-git-branch"></i>
                                <span>Quản lý thương hiệu</span></a>
                        </li>
                    <?php endif; ?>

                    <?php if($admin && $admin->hasPermission('view_product')): ?>
                        <li class="<?php echo e(isset($sidebar) && $sidebar == 'Product' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.products.index')); ?>"><i class="icon-printer4"></i>
                                <span>Quản lý sản phẩm</span></a>
                        </li>
                    <?php endif; ?>

                    <?php if($admin && $admin->hasPermission('view_post_catalogue')): ?>
                        <li class="<?php echo e(isset($sidebar) && $sidebar == 'PostCatalogue' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.post_catalogues.index')); ?>"><i class=" icon-files-empty2"></i>
                                <span>Quản lý nhóm bài viết</span></a>
                        </li>
                    <?php endif; ?>
                    <?php if($admin && $admin->hasPermission('view_post')): ?>
                        <li class="<?php echo e(isset($sidebar) && $sidebar == 'Post' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.posts.index')); ?>"><i class="icon-blogger"></i>
                                <span>Quản lý bài viết</span></a>
                        </li>
                    <?php endif; ?>
                    <?php if($admin && $admin->hasPermission('view_banner')): ?>
                        <li class="<?php echo e(isset($sidebar) && $sidebar == 'Banner' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.banners.index')); ?>">
                                <i class="icon-image2"></i>
                                <span>Quản lý Banner</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($admin && $admin->hasPermission('view_widget')): ?>
                        <li class="<?php echo e((isset($sidebar) && $sidebar == 'Widget') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.widgets.index')); ?>">
                                <i class="icon-grid"></i>
                                <span>Widget</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($admin && $admin->hasPermission('view_menu')): ?>
                        <li class="<?php echo e((isset($sidebar) && $sidebar == 'Menu') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.menus.index')); ?>">
                                <i class="icon-list2"></i>
                                <span>Menu</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($admin && $admin->hasPermission('view_contact')): ?>
                        <li class="<?php echo e((isset($sidebar) && $sidebar == 'Contact') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.contacts.index')); ?>">
                                <i class="icon-cart2"></i>
                                <span>Liên hệ</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($admin && $admin->hasPermission('view_user')): ?>
                        <li class="<?php echo e(isset($sidebar) && $sidebar == 'User' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.users.index')); ?>">
                                <i class="icon-users4"></i>
                                <span>Quản lý thành viên</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if($admin && $admin->hasPermission('view_role')): ?>
                        <li class="<?php echo e(isset($sidebar) && $sidebar == 'Role' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.roles.index')); ?>">
                                <i class="icon-user-check"></i>
                                <span>Quản lý vai trò</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($admin && $admin->hasPermission('view_permission')): ?>
                        <li class="<?php echo e(isset($sidebar) && $sidebar == 'Permission' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('admin.permissions.index')); ?>">
                                <i class="icon-key"></i>
                                <span>Quản lý quyền</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="<?php echo e(@$sidebar == 'SystemLibrary' ? 'active' : null); ?>">
                        <a href="<?php echo e(route('admin.system.index')); ?>"><i class="icon-lifebuoy"></i>
                            <span>Cấu hình hệ thống</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/layouts/partials/sidebar.blade.php ENDPATH**/ ?>