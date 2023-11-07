<?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($content): ?>
    <?php echo $__env->make($content, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH E:\ucashier\resources\views/admin/layouts/content.blade.php ENDPATH**/ ?>