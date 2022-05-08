
<?php $__env->startSection('content'); ?>
    <!--Start cart-->
    <?php if (isset($component)) {
    $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component;
} ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.Admin.validationErrors', 'data' => ['errors' => $errors]]); ?>
<?php $component->withName('Admin.validationErrors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <div class="container-fluid pt-5">
        <?php if (!isset($orders) || $orders->isEmpty()): ?>
            <div class="alert">No hay productos en la orden</div>
        <?php else: ?>
            <div class="row px-xl-5">

                <div class="col-lg-12 table-responsive mb-5">


                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                        <tr>
                            <th>fecha</th>
                            <th>Cantidad de Productos</th>
                            <th>Precio total</th>
                            <th>Estado</th>
                            <th>Ver</th>


                        </tr>
                        </thead>
                        <tbody class="align-middle">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach ($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td class="align-middle">

                                    <?php echo e($order->createdAt); ?>

                                </td>
                                <td class="align-middle"><?php echo e($order->count); ?></td>
                                <td class="align-middle">$<?php echo e($order->total); ?></td>
                                <td class="align-middle"><?php echo e($order->status); ?></td>

                                <td class="align-middle">
                                    <a href="<?php echo e(route('orders.show', [$order->id])); ?>" class="btn btn-success">Ir</a>

                                </td>


                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="col- pb-1">
                    <nav aria-label="Page navigation">
                        <div class="d-flex justify-content-center font-semibold ">

                            <?php if (count($orders) > 0): ?>
                                <?php echo $orders->links(); ?>

                            <?php endif; ?>
                        </div>

                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!--End Cart-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-projects\store-evertec\resources\views/ordersIndex.blade.php ENDPATH**/ ?>