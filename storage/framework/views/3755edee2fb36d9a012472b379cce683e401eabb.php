<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS VOD - ĐĂNG NHẬP</title>
    <link href="<?php echo e(URL::asset('backend/assets/css/family.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(URL::asset('backend/global_assets/css/icons/icomoon/styles.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(URL::asset('backend/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(URL::asset('backend/assets/css/core.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(URL::asset('backend/assets/css/components.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(URL::asset('backend/assets/css/colors.min.css')); ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo e(URL::asset('backend/global_assets/js/plugins/loaders/pace.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/core/libraries/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/core/libraries/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/plugins/loaders/blockui.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/plugins/forms/validation/validate.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/plugins/forms/styling/uniform.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/assets/js/app.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('backend/global_assets/js/demo_pages/login_validation.js')); ?>"></script>
</head>

<body class="login-container login-cover">
<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="content pb-20">
                <form action="<?php echo e(route('admin.login')); ?>" class="form-validate" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                            <h5 class="content-group">ĐĂNG NHẬP</h5>
                        </div>

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" placeholder="Tên đăng nhập hoặc email" name="username" required="required">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" placeholder="Mật khẩu đăng nhập" name="password" required="required">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>
                        <div class="form-group login-options">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="styled" checked="checked">
                                        Remember
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn bg-blue btn-block">Đăng nhập <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                        <span class="help-block text-center no-margin">HỆ THỐNG QUẢN TRỊ CMS VOD VER <a href="#">1.0</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\laragon\www\tamviet-ecommerce\resources\views/backend/auth/login.blade.php ENDPATH**/ ?>