<?php $__env->startSection('content'); ?>
    <div id="mainContent" class="z-20 mx-auto bg-white pt-[46px] md:pb-0 md:pt-4">
        <div>
            <div class="flex w-full flex-col md:flex-col-reverse">
                <?php echo $__env->make('frontend.layouts.partials.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div></div>
            <div class="bg-neutral-100 h-3"></div>
            <?php echo $__env->make('frontend.components.deal',compact('homeProductCategories'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.components.featured-brands',compact('homeProductBrands'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.components.featured-categories',compact('homeCategories'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('frontend.components.disease-lookup', compact('healthCategories'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/frontend/home/index.blade.php ENDPATH**/ ?>