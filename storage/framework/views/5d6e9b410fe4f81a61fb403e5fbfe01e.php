<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <title><?php echo e($admin_setting ? $admin_setting->title : ''); ?></title>
    <link rel="shortcut icon"
        href="<?php echo e($admin_setting && file_exists($admin_setting->favicon) ? asset($admin_setting->favicon) : asset('backend/images/logo/favicon.png')); ?>"
        type="image/x-icon">
    <?php echo $__env->make('layouts.admin.partial.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.admin.partial.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        :root {
            --bs-primary: <?php echo e($admin_setting && $admin_setting->primary_color ? $admin_setting->primary_color : '#3753e9'); ?>;
            --bs-secondary: <?php echo e($admin_setting && $admin_setting->secondary_color ? $admin_setting->secondary_color : '#415FFF'); ?>;
        }
    </style>
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
<style>
body,*{
    font-family: 'SolaimanLipi', sans-serif;
}
</style>
<?php echo $__env->make('layouts.admin.partial.dynamic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body class="bg-light">
    <div class="overflow-hidden site-wrapper <?php if(Session::has('sidebar-collapse')): ?> session-sidebar <?php endif; ?>">
        <?php echo $__env->make('layouts.admin.partial.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="content-wrapper">
            <?php echo $__env->make('layouts.admin.partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content">
                <div class="p-sm-4 p-3">
                    <div class="row g-3">
                        <div class="col-12">
                            <?php
                                $currentRouteName = \Request::route()->getName();
                                $form_link = str_replace('.edit', '.update', $currentRouteName);
                                $back_link = str_replace('.edit', '.index', $currentRouteName);
                                $back_link = str_replace('.show', '.index', $back_link);
                            ?>
                            <form action="<?php echo e(@$link ?? Route($form_link, @$data->id)); ?>" method="POST" id="update_form"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="card">
                                    <div class="card-header pe-2 py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="h6 mb-0 text-uppercase">
                                                <?php echo e(@$title ?? 'Please Set Title'); ?></h6>
                                            <div class="d-flex gap-2">
                                                <?php if(isset($customHtml)): ?>
                                                    <?php echo $customHtml; ?>

                                                <?php endif; ?>
                                                <?php if(isset($custom_btn)): ?>
                                                    <a href="<?php echo e($custom_btn['link']); ?>" class="btn btn-primary btn-sm"
                                                        target="<?php echo e(@$custom_btn['target']); ?>"><?php echo e($custom_btn['name']); ?></a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(Route($back_link)); ?>" class="btn btn-primary btn-sm">Go
                                                    Back</a>
                                                <button type="submit"
                                                    class="btn btn-primary btn-sm submit_btn">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $__env->yieldContent('content'); ?>
                                    </div>
                                    <div class="card-footer text-end px-3 py-2">
                                        <button type="submit" class="btn btn-primary btn-sm submit_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('layouts.admin.partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <!-- End Site Wrapper -->

    <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.admin.partial.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <?php echo $__env->yieldPushContent('js'); ?>
</body>

</html>
<?php /**PATH E:\laragon\www\smgroupbd\resources\views/layouts/admin/edit_app.blade.php ENDPATH**/ ?>