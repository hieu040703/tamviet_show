<?php $__env->startSection('content'); ?>
    <div class="col-md-12">

        <form action="<?php echo e(route('admin.system.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title"><?php echo e(__("SystemLibrary")); ?></h6>
                    <div class="heading-elements">
                        <button type="submit" class="btn btn-primary">
                            <?php echo e(__('Save')); ?>

                            <i class="icon-file-plus position-right"></i>
                        </button>
                    </div>
                </div>

                <div class="panel-body">

                    <div class="tabbable tab-content-bordered">
                        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                            <?php $__currentLoopData = $systemConfig; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li <?php if($loop->index == 0): ?> class="active" <?php endif; ?>><a
                                        href="#<?php echo e(\Str::slug($val['label'])); ?>" data-toggle="tab"><?php echo e($val['label']); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <?php $__currentLoopData = $systemConfig; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane has-padding  <?php if($loop->index == 0): ?> active <?php endif; ?>"
                                 id="<?php echo e(\Str::slug($val['label'])); ?>">
                                <p class="text-center"><?php echo e($val['description']); ?></p>
                                <div class="col-md-12">
                                    <fieldset class="content-group">
                                        <?php if(count($val['value'])): ?>
                                            <div class="ibox-content">
                                                <?php $__currentLoopData = $val['value']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyVal => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $name = $key.'_'.$keyVal;
                                                    ?>
                                                    <div class="row mb15">
                                                        <div class="col-lg-12">

                                                            <label for="" class="d-flex justify-content-between">
                                                                <span><?php echo e($item['label']); ?></span>
                                                                <?php echo renderSystemLink($item); ?>

                                                                <?php echo renderSystemTitle($item); ?>

                                                            </label>

                                                            <?php switch($item['type']):
                                                                case ('text'): ?>
                                                                    <?php echo renderSystemInput($name, $systems); ?>

                                                                    <?php break; ?>
                                                                <?php case ('images'): ?>
                                                                    <?php echo renderSystemImages($name, $systems); ?>

                                                                    <?php break; ?>
                                                                <?php case ('textarea'): ?>
                                                                    <?php echo renderSystemTextarea($name, $systems); ?>

                                                                    <?php break; ?>
                                                                <?php case ('select'): ?>
                                                                    <?php echo renderSystemSelect($item, $name, $systems); ?>

                                                                    <?php break; ?>
                                                                <?php case ('editor'): ?>
                                                                    <?php echo renderSystemEditor($name, $systems); ?>

                                                                    <?php break; ?>
                                                                <?php case ('repeater'): ?>
                                                                    <?php echo renderSystemRepeater($item, $name, $systems); ?>

                                                                    <?php break; ?>
                                                            <?php endswitch; ?>


                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </fieldset>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            <?php echo e(__('Save')); ?>

                            <i class="icon-file-plus position-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
    <style type="text/css">
        .panel-title {
            font-size: 20px;
            margin-bottom: 15px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .panel-description {
            font-size: 15px;
        }

        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
            font-weight: 700;
        }

        @media (min-width: 768px) {
            .ibox-content {
                padding: 15px 20px 20px 20px;
            }
        }

        .ibox-content {
            background-color: #ffffff;
            color: inherit;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0;
        }

        .mb15 {
            margin-bottom: 15px;
        }

        .system-link {
            font-size: 10px;
            font-weight: normal;
            font-style: italic;
        }

        .text-danger {
            color: #ed5565;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        textarea.system-textarea {
            resize: both !important;
            overflow: auto;
            width: auto !important;
            min-width: 100%;
            max-width: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('backend.partials.ckeditor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('click', function (e) {
                if (e.target.closest('.sr-add')) {
                    const wrap = e.target.closest('.system-repeater');
                    const tbody = wrap.querySelector('.sr-rows');
                    const tpl = wrap.querySelector('.sr-template').innerHTML;
                    const idx = tbody.querySelectorAll('tr').length;
                    const html = tpl.replaceAll('__INDEX__', idx);
                    tbody.insertAdjacentHTML('beforeend', html);
                }
                if (e.target.closest('.sr-remove')) {
                    const tr = e.target.closest('tr');
                    tr.parentNode.removeChild(tr);
                }
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/system/index.blade.php ENDPATH**/ ?>