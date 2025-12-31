<?php $__env->startSection('content'); ?>
    <div id="mainContent" class="z-20 mx-auto bg-white pt-[46px] md:pb-0 md:pt-4">
        <div>
            <div class="flex w-full flex-col md:flex-col-reverse">
                <?php echo $__env->make('frontend.layouts.partials.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div></div>
            <?php echo $__env->make('frontend.components.featured-categories',compact('homeCategories'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.components.deal',compact('homeProductCategories','homeProductCategories1'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.components.featured-brands',compact('homeProductBrands'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.components.disease-lookup', compact('healthCategories','featuredArticle'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.components.featured-video',compact('featured_videos','featured_videos_1'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.components.featured-short-video',compact('featured_short_videos'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.components.service-icons', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/home/index.blade.php ENDPATH**/ ?>