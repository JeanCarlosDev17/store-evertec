
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
        <?php if (!isset($cart) || $cart->products->isEmpty()): ?>
            <div class="alert">No hay productos en el carrito</div>
        <?php else: ?>
            <div class="row px-xl-5">

                <div class="col-lg-8 table-responsive mb-5">


                        <table class="table table-bordered text-center mb-0">
                            <thead class="bg-secondary text-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Quitar</th>
                            </tr>
                            </thead>
                            <tbody class="align-middle">
                                <?php $__currentLoopData = $cart->products; $__env->addLoop($__currentLoopData); foreach ($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td class="align-middle"><img src="<?php echo e($product->getImageUrl()); ?>" alt="" style="width: 50px;">
                                            <?php echo e($product->name); ?></td>
                                        <td class="align-middle">$<?php echo e($product->formatPrice()); ?></td>
                                        <td class="align-middle">
                                            <form action="<?php echo e(route('products.cart.update', ['product'=>$product->id, 'cart'=>$cart->id])); ?>" id="product-quantity" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>

                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button type="input" class="btn btn-sm btn-primary btn-minus" name="action" value="decrease">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text"
                                                           name="quantity"
                                                           class="form-control form-control-sm bg-secondary text-center"
                                                           value="<?php echo e($product->pivot->quantity); ?>"
                                                           readonly

                                                    >
                                                    <div class="input-group-btn">
                                                        <button type="input" class="btn btn-sm btn-primary btn-plus" name="action" value="add">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>

                                        </td>
                                        <td class="align-middle"><?php echo e($product->total); ?></td>
                                        <td class="align-middle">
                                            <form action="<?php echo e(route('products.cart.destroy', ['product'=>$product->id, 'cart'=>$cart->id])); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>

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
                        <div class="card-body">




    
    
    
    
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Total</h5>
                                <h5 class="font-weight-bold">$<?php echo e($cart->total); ?></h5>
                            </div>
                            <form action="<?php echo e(route('orders.store')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <?php if (auth()->guard()->check()): ?>
                                    <?php if (auth()->check() && auth()->user()->hasRole('admin')): ?>
                                        <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-block btn-primary my-3 py-3 font-semibold">
                                            Comprar
                                        </a>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-block btn-primary my-3 py-3 font-semibold">
                                            Comprar
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if (auth()->guard()->guest()): ?>
                                    <a href="<?php echo e(route('login')); ?>" class="btn btn-block btn-primary my-3 py-3 font-semibold">
                                        Comprar
                                    </a>
                                <?php endif; ?>



                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!--End Cart-->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-projects\store-evertec\resources\views/cart.blade.php ENDPATH**/ ?>