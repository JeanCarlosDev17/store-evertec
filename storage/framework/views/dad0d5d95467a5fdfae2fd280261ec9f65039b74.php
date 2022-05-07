
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
        <?php if (!isset($order) || $order->products->isEmpty()): ?>
            <div class="alert">No hay productos en la orden</div>
        <?php else: ?>
            <div class="row px-xl-5">

                <div class="col-lg-8 table-responsive mb-5">
                    <h2>Orden de compra <?php echo e($order->refence); ?> </h2>
                    <h3>Estado -
                        <span class="<?php echo e($order->state == 'PENDING' ? 'bg-warning text-dark' :
                                   ($order->state == 'APPROVED' ? 'bg-success text-white' : 'bg-danger text-white')); ?>"
                        >
                            <?php echo e($order->Status); ?>


                        </span>
                    </h3>

                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                        <tr>

                            <th>Producto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>



                        </tr>
                        </thead>
                        <tbody class="align-middle">
                        <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach ($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td class="align-middle">
                                    <img src="<?php echo e($product->getImageUrl()); ?>" alt="" style="width: 50px;">
                                </td>
                                <td class="align-middle"><?php echo e($product->name); ?></td>
                                <td class="align-middle">$<?php echo e($product->formatPrice()); ?></td>
                                <td class="align-middle">

                                    <?php echo e($product->pivot->quantity); ?>

                                </td>



                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>




                </div>
                <div class="col-lg-4">

                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                        </div>

                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Total</h5>
                                <h5 class="font-weight-bold">$<?php echo e($order->total); ?></h5>
                            </div>

                            <?php if ($order->state != 'APPROVED'): ?>
                                <a href="<?php echo e($order->process_url); ?>" class="btn btn-block btn-primary my-3 py-3">
                                    Ir a pagar
                                </a>
                            <?php endif; ?>






















                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!--End Cart-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-projects\store-evertec\resources\views/orderShow.blade.php ENDPATH**/ ?>