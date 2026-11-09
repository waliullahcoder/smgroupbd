<?php if(session()->has('errors')): ?>
<?php $__currentLoopData = session('errors')->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
RealRashid\SweetAlert\Facades\Alert::toast($error, 'error');
?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if(session('success_message')): ?>
<?php
RealRashid\SweetAlert\Facades\Alert::toast(session('success_message'), 'success')
?>
<?php endif; ?>
<?php /**PATH E:\laragon\www\smgroupbd\resources\views/layouts/admin/partial/alert.blade.php ENDPATH**/ ?>