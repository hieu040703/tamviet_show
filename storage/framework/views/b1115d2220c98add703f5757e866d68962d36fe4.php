<?php
    $block      = $healthCategories ?? [];
    $blockPost = $featuredArticle ?? [];
    $widget     = $block['widget'] ?? null;
    $catalogues = collect($block['items'] ?? []);
   $featureds = collect(data_get($blockPost, 'items', []))->take(7);
    $first = $featureds->first();
    $others = $featureds->skip(1);
    $intro = $system['homepage_short_intro'] ?? null;
?>
<div class="flex flex-col">
    <div class="bg-neutral-100 h-3"></div>
    <div class="md:container">
        <div>
            <div class="block-title flex items-center p-4 md:px-0">
                <h4 class="font-semibold flex flex-1 text-base md:text-[20px]">
                    <?php echo e($widget->name ?? 'Tin tức & Sức khỏe'); ?>

                </h4>
            </div>
        </div>
        <div class="mb-4">
            <div>
                <div class="relative flex h-full w-full items-center">
                    <div
                            class="swiper swiper-initialized swiper-horizontal custom-swiper-navigation w-full !mx-0 overflow-hidden !px-4 md:!px-0">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $catalogues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catalogue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide mr-4 !w-auto last:mr-2">
                                    <a class="relative flex justify-center outline-none font-semibold bg-neutral-200 border-0 hover:bg-neutral-300 focus:ring-neutral-300 text-neutral-900 text-sm px-4 py-2 h-9 items-center rounded-full"
                                       href="<?php echo e(router_link('post_catalogue',$catalogue->id)); ?>">
                                        <?php echo e($catalogue->name ?? ''); ?>

                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $featureds = collect(data_get($blockPost, 'items', []));
            $first = $featureds->first();
            $others = $featureds->skip(1);
        ?>

        <?php if($featureds->isNotEmpty()): ?>
            <div class="group grid grid-cols-1 gap-x-4 gap-y-6 px-4 pb-6 md:grid-cols-3 md:grid-rows-3 md:px-0">
                <div class="first:row-span-3 first:mb-3 md:block">
                    <div class="group-data-[cate=&quot;false&quot;]:-mb-4  md:-mb-10">
                        <div class="aspect-blog-image overflow-hidden rounded-sm mb-2 h-[248px] w-full">
                            <a href="<?php echo e(router_link('posts', $first->id)); ?>">
                                <img class="h-full w-full object-cover"
                                     src="<?php echo e($first->image ? asset('storage/'.$first->image) : asset('backend/img/not-found.jpg')); ?>"
                                     alt="<?php echo e($first->name); ?>" loading="lazy" width="500" height="500">
                            </a>
                        </div>
                        <div class="flex flex-1 flex-col">
                            <div class="mb-2 flex items-start">
                                <a class="line-clamp-1 rounded-sm bg-neutral-800 px-1 py-[2px] text-xs font-medium text-white"
                                   href="<?php echo e($first->catalogue_id ? router_link('post_catalogues', $first->catalogue_id) : '#'); ?>">
                                    <?php echo e($first->catalogue_name ?? 'Tin tức'); ?>


                                </a>
                            </div>
                            <a class="-mt-1 mb-1 line-clamp-2 font-semibold text-base"
                               href="<?php echo e(router_link('posts', $first->id)); ?>">
                                <?php echo e($first->name); ?>

                            </a>
                            <div
                                    class="[&_a:not(.ignore-css_a)]:text-hyperLink line-clamp-2 text-sm group-data-[cate='false']:line-clamp-3">
                                <?php echo $first->description; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php $__currentLoopData = $others; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="first:row-span-3 first:mb-3 md:block">
                        <div
                                class="flex items-start justify-start space-x-2 border-t border-neutral-200 pt-4 md:border-0 md:pt-0">
                            <div class="aspect-blog-image overflow-hidden rounded-sm w-[92px] md:w-[144px]">
                                <a href="<?php echo e(router_link('posts', $post->id)); ?>">
                                    <img class="h-full w-full object-cover"
                                         src="<?php echo e($post->image ? asset('storage/'.$post->image) : asset('backend/img/not-found.jpg')); ?>"
                                         alt="<?php echo e($post->name); ?>" loading="lazy" width="500" height="500">
                                </a>
                            </div>
                            <div class="flex flex-1 flex-col">
                                <div class="mb-2 flex items-start">
                                    <a class="line-clamp-1 rounded-sm bg-neutral-800 px-1 py-[2px] text-xs font-medium text-white"
                                       href="<?php echo e($post->catalogue_id ? router_link('post_catalogues', $post->catalogue_id) : '#'); ?>">
                                        <?php echo e($post->catalogue->name ?? 'Tin tức'); ?>

                                    </a>
                                </div>

                                <a class="-mt-1 mb-1 line-clamp-2 text-sm font-semibold"
                                   href="<?php echo e(router_link('posts', $post->id)); ?>">
                                    <?php echo e($post->name); ?>

                                </a>

                                <div
                                        class="[&_a:not(.ignore-css_a)]:text-hyperLink line-clamp-2 text-sm group-data-[cate='false']:line-clamp-3">
                                    <?php echo $post->description; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        <?php endif; ?>

    </div>
    <?php if(!empty($intro)): ?>
        <div>
            <div class="bg-neutral-100 h-3"></div>
            <div class="container">
                <div class="py-4">
                    <div class="text-sm [&_a:not(.ignore-css_a)]:text-hyperLink">
                        <h2>
                        <span style="font-size: 22px;">
                            <b>Giới thiệu Tâm Việt</b>
                        </span>
                        </h2>
                        <?php echo $intro; ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/components/disease-lookup.blade.php ENDPATH**/ ?>