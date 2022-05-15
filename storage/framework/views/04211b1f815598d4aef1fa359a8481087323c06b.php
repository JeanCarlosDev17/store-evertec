<?php $attributes = $attributes->exceptProps(['users']); ?>
<?php foreach (array_filter((['users']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div class="table-responsive-md">
    <table class="table table-striped table-bordered dt-responsive display " id="users" cellspacing="0" width="100%" style="width: 100% !important;">
    <?php echo csrf_field(); ?>
        <?php echo csrf_field(); ?>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">rol</th>
            <th scope="col">Estado</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Activar/Desactivar</th>

        </tr>
        </thead>
        <tbody>

        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <tr>
                <td><?php echo e($user->id); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->hasRole('admin')? "Administrador":"Usuario"); ?></td>
                <td><?php echo e($user->user_state==1 ? "Activo":"Inactivo"); ?></td>
                <td>
                    <form action="<?php echo e(route('users.edit',$user->id)); ?>" class="edit" method="get">

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('GET'); ?>
                        <button type="submit" class="btn btn-info "><i class="fas fa-edit" style="max-width:min-content"></i>  </button>
                    </form>

                </td>


                <td><form action="<?php echo e(route('users.destroy',$user->id)); ?>" class="delete" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button type="submit"  class="btn btn-danger "><i class="fas fa-user-times" style="max-width:min-content"></i></button>
                    </form>
                </td>


                <td class="d-flex justify-content-center ">

                    <form action="<?php echo e(route('users.state',$user->id)); ?>" class="state" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <button type="submit"  href="" class="btn btn-<?php echo e($user->user_state==1 ? "warning":"success"); ?> text-center  " style="max-width:min-content ">
                            <i class="fas fa-toggle-on font-weight-bold  " style="color: black"> </i>
                        </button>
                    </form>
                </td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <h2>No hay usuarios registrados</h2>
        <?php endif; ?>
        </tbody>
    </table>


</div>
<?php /**PATH C:\xampp\htdocs\Laravel-projects\store-evertec\resources\views/components/admin/indexUser.blade.php ENDPATH**/ ?>