<div class="panel panel-flat">
    <div class="panel-body">
        <fieldset class="content-group">
            <legend class="text-bold">
                PHẦN MỤC SEO
            </legend>
            <div class="ibox-content">
                <div class="seo-container">
                    <div class="meta-title">
                        <?php echo e((old('seo_title', ($model->seo_title) ?? ''))
                                ? old('seo_title', ($model->seo_title) ?? '')
                                : 'Bạn chưa thêm tiêu đề SEO'); ?>

                    </div>

                    <div class="canonical">
                        <?php echo e(config('app.url')
                            . old('canonical', ($model->canonical) ?? '')
                            . config('apps.general.suffix')); ?>

                    </div>

                    <div class="meta-description">
                        <?php echo e((old('seo_description', ($model->seo_description) ?? ''))
                                ? old('seo_description', ($model->seo_description) ?? '')
                                : 'Bạn chưa thêm mô tả SEO'); ?>

                    </div>
                </div>

                <div class="seo-wrapper">
                    <div class="row mb15">
                        <div class="col-md-12">
                            <label for="" class="control-label text-left">
                                <div class="flex flex-middle flex-between">
                                    <span class="control-label text-semibold">Tiêu Đề Seo</span>
                                    <span class="control-label text-semibold count_meta-title">
                                        0 <?php echo e(__("character")); ?>

                                    </span>
                                </div>
                            </label>
                            <input
                                type="text"
                                name="seo_title"
                                value="<?php echo e(old('seo_title', ($model->seo_title) ?? '' )); ?>"
                                class="form-control"
                                autocomplete="off"
                                <?php echo e((isset($disabled)) ? 'disabled' : ''); ?>

                            >
                        </div>
                    </div>

                    <div class="row mb15">
                        <div class="col-lg-12">
                            <label for="" class="control-label text-left">
                                <span>Từ Khóa Seo</span>
                            </label>
                            <input
                                type="text"
                                name="seo_keyword"
                                value="<?php echo e(old('seo_keyword', ($model->seo_keyword) ?? '' )); ?>"
                                class="form-control"
                                autocomplete="off"
                                <?php echo e((isset($disabled)) ? 'disabled' : ''); ?>

                            >
                        </div>
                    </div>

                    <div class="row mb15">
                        <div class="col-lg-12">
                            <label for="" class="control-label text-left">
                                <div class="flex flex-middle flex-between">
                                    <span>Mô Tả Seo</span>
                                    <span class="count_meta-description">
                                        <span class="countD">0</span> / 160 <?php echo e(__("character")); ?>

                                    </span>
                                </div>
                            </label>
                            <textarea
                                name="seo_description"
                                class="form-control custom-textarea-height"
                                autocomplete="off"
                                <?php echo e((isset($disabled)) ? 'disabled' : ''); ?>

                            ><?php echo e(old('seo_description', ($model->seo_description) ?? '')); ?></textarea>
                        </div>
                    </div>

                    <div class="row mb15">
                        <div class="col-lg-12 <?php if($errors->first('canonical')): ?> has-error <?php endif; ?>">
                            <label for="" class="control-label text-left">
                                <span>
                                    URL chuẩn (Loại bỏ phần đuôi .html)
                                    <span class="text-danger">*</span>
                                </span>
                            </label>
                            <div class="input-wrapper">
                                <input
                                    type="text"
                                    name="canonical"
                                    value="<?php echo e(old('canonical', ($model->canonical) ?? '' )); ?>"
                                    class="form-control seo-canonical"
                                    autocomplete="off"
                                    <?php echo e((isset($disabled)) ? 'disabled' : ''); ?>

                                >
                                <span class="baseUrl"><?php echo e(config('app.url')); ?></span>
                                <div class="form-control-feedback">
                                    <?php if($errors->first('canonical')): ?>
                                        <i class="icon-notification2"></i>
                                    <?php endif; ?>
                                </div>
                                <span class="help-block"><?php echo e($errors->first('canonical')); ?></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>
    </div>
</div>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/components/seo.blade.php ENDPATH**/ ?>