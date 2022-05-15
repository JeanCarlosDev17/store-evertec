
<?php if(session('result')): ?>
        <div id="success-alert">
            <div class="alert alert-success h3" role="alert">
                <span><i class="fas fa-check-circle text-white font"></i></span> <?php echo e(session('result')); ?>

            </div>
        </div>
    <?php $__env->startSection('js'); ?>
        <script>

            $(document).ready(function() {
                $("#success-alert").fadeTo(6000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
            })
        </script>
    <?php $__env->stopSection(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Laravel-projects\store-evertec\resources\views/components/admin/validationSuccess.blade.php ENDPATH**/ ?>