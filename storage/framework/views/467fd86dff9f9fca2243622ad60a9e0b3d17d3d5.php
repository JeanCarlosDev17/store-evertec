
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.index')): ?>


        

        <?php $__env->startSection('title', 'Administrador Home'); ?>

        <?php $__env->startSection('content_header'); ?>
            <h1>Administrador</h1>
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('content'); ?>
            <div>
                <p>Bienvenido al panel de administración </p>
                <?php if (isset($component)) {
    $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component;
} ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.admin.validationSuccess', 'data' => []]); ?>
<?php $component->withName('admin.validationSuccess'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php if (isset($component)) {
    $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component;
} ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.admin.indexUser', 'data' => ['users' => $users]]); ?>
<?php $component->withName('admin.indexUser'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['users' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($users)]); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>

        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('css'); ?>
            <link rel="stylesheet" href="/css/admin_custom.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.css">



            <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">-->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">


            <!--  Datatables  -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />

            <!--  extension responsive  -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

        <?php $__env->stopSection(); ?>
        <?php $__env->startSection('js'); ?>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="<?php echo e(asset('js/forms.js')); ?>"></script>


            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"> </script>
            <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
            <script  src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>



            <!--   Datatables-->
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

            <!-- extension responsive -->
            <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

            <script defer>
                $(document).ready(function() {
                    $('#users').DataTable( {
                        responsive: true
                    } );
                } );

            </script>




        <?php $__env->stopSection(); ?>
    <?php endif; ?>







<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-projects\store-evertec\resources\views/admin/admin.blade.php ENDPATH**/ ?>