<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-7">
            <div class="panel panel-flat">
                <div class="panel-heading">
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-box"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold"><?php echo e(__("Products")); ?></div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-visitors"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-newspaper"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold"><?php echo e(__("Posts")); ?></div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-sessions"></div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-people"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold"><?php echo e(__("Users")); ?></div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>

                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="total-online"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-5">
            <div class="panel panel-flat">
                <div class="panel-heading">
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-box"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold"><?php echo e(__("Promotions")); ?></div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>
                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="content-group" id="new-sessions"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <ul class="list-inline text-center">
                                <li>
                                    <a href="#"
                                       class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                            class="icon-newspaper"></i></a>
                                </li>
                                <li class="text-left">
                                    <div class="text-semibold"><?php echo e(__("Reviews")); ?></div>
                                    <div class="text-muted"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-flat">

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th><?php echo e(__("Product")); ?></th>
                            <th class="col-md-2"><?php echo e(__("Category")); ?></th>
                            <th class="col-md-2"><?php echo e(__("Create By")); ?></th>
                            <th class="col-md-2"><?php echo e(__("Status")); ?></th>
                            <th class="col-md-2"><?php echo e(__("SKU")); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="active border-double">
                            <td colspan="5"><?php echo e(__("Recent")); ?></td>
                            <td class="text-right">
                                <span class="progress-meter" id="today-progress" data-progress="30"></span>
                            </td>
                        </tr>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title"><?php echo e(__("Recent Activity")); ?></h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th><?php echo e(__("Entity")); ?></th>
                            <th><?php echo e(__("Change")); ?></th>
                            <th><?php echo e(__("At")); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        
                        
                        
                        

                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title"><?php echo e(__("Recent Message")); ?></h6>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active fade in has-padding" id="messages-tue">
                        <ul class="media-list">
                            
                            
                            
                            
                            
                            
                            
                            
                            

                            
                            
                            
                            
                            

                            
                            
                            
                            
                            
                            
                        </ul>
                    </div>
                </div>
                <!-- /tabs content -->

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/home/index.blade.php ENDPATH**/ ?>