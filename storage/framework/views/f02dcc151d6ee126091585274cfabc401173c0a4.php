<?php $attributes = $attributes->exceptProps(['errors']); ?>
<?php foreach (array_filter((['errors']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if($errors->any()): ?>

    <script src="https://kit.fontawesome.com/2ccb5d9a99.js" crossorigin="anonymous"></script>
        <div class="alert alert-danger ml-4 ">
            <div class="alert-title font-semibold text-lg text-red-800">

               <span class="">
                <i class="fas fa-exclamation-triangle" class="text-white"></i>

            </span> <?php echo e(__('Whoops, something went wrong')); ?>

            </div>
            <div class="alert-description text-sm text-red-600">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Laravel-projects\store-evertec\resources\views/components/Admin/validationErrors.blade.php ENDPATH**/ ?>