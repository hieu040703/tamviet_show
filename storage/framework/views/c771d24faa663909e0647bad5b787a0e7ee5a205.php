<?php
    $menu = isset($menu) ? $menu : null;
    $parents = $menu ? $menu->items : collect();
    $normalize = function ($value) {
        return mb_strtolower(trim($value), 'UTF-8');
    };
    $aboutGroup = $parents->first(function ($item) use ($normalize) {
        return $normalize($item->name) === $normalize('Về Tâm Việt');
    });
    $categoryGroup = $parents->first(function ($item) use ($normalize) {
        return $normalize($item->name) === $normalize('Danh mục');
    });
    $socialGroup = $parents->first(function ($item) use ($normalize) {
        return $normalize($item->name) === $normalize('Theo dõi chúng tôi trên');
    });
    $iconMap = [
        'facebook' => URL::asset('frontend/assets/image/social/facebook.svg'),
        'youtube'  => URL::asset('frontend/assets/image/social/youtube.svg'),
        'zalo'     => URL::asset('frontend/assets/image/social/zalo.svg'),
        'tiktok'   => URL::asset('frontend/assets/image/social/tiktok.svg'),
    ];
?>

<div class="grid grid-cols-2 gap-1 gap-y-4 md:grid-cols-4 md:gap-2">
    <?php if($aboutGroup): ?>
        <div>
            <h4 class="text-[14px] leading-[20px] mb-4 font-bold"><?php echo e($aboutGroup->name); ?></h4>
            <ul>
                <?php $__currentLoopData = $aboutGroup->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="pb-2">
                        <a href="<?php echo e(router_link_from_canonical(optional($item->router)->canonical)); ?>"
                           target="<?php echo e($item->target ?: '_self'); ?>"><?php echo e($item->name); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if($categoryGroup): ?>
        <div>
            <h4 class="text-[14px] leading-[20px] mb-4 font-bold"><?php echo e($categoryGroup->name); ?></h4>
            <ul>
                <?php $__currentLoopData = $categoryGroup->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="pb-2">
                        <a href="<?php echo e(router_link_from_canonical(optional($item->router)->canonical)); ?>"><?php echo e($item->name); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if($socialGroup): ?>
        <div>
            <h4 class="text-[14px] leading-[20px] mb-4 font-bold"><?php echo e($socialGroup->name); ?></h4>
            <ul>
                <?php $__currentLoopData = $socialGroup->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $nameLower = mb_strtolower(trim($item->name));
                        $iconKey = null;
                        if (strpos($nameLower, 'facebook') !== false) {
                            $iconKey = 'facebook';
                        } elseif (strpos($nameLower, 'youtube') !== false) {
                            $iconKey = 'youtube';
                        } elseif (strpos($nameLower, 'zalo') !== false) {
                            $iconKey = 'zalo';
                        } elseif (strpos($nameLower, 'tiktok') !== false) {
                            $iconKey = 'tiktok';
                        }
                        $iconPath = $iconKey ? ($iconMap[$iconKey] ?? null) : null;
                    ?>

                    <li class="pb-4">
                        <a class="flex" href="<?php echo e($item->url ?: '#'); ?>" target="_blank">
                            <?php if($iconPath): ?>
                                <img class="mr-2 w-6" src="<?php echo e(asset($iconPath)); ?>" alt="<?php echo e($item->name); ?>">
                            <?php endif; ?>
                            <?php echo e($item->name); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if(isset($system['contact_hotline'])): ?>
        <div>
            <h4 class="text-[14px] leading-[20px] mb-4 font-bold">Tổng đài chăm sóc khách hàng</h4>
            <p>Hỗ trợ đặt hàng</p>
            <a href="tel:<?php echo e($system['contact_hotline']); ?>"
               class="block pt-2 font-bold text-primary-500"><?php echo e($system['contact_hotline']); ?></a>
        </div>
    <?php endif; ?>

</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/layouts/partials/footer-menu-follow.blade.php ENDPATH**/ ?>