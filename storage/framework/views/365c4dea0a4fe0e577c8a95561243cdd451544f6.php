

<?php $__env->startSection('js'); ?>

    <script src="https://kit.fontawesome.com/2ccb5d9a99.js" crossorigin="anonymous"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>



<!-- Page Header Start -->











<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">

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
        <!-- Shop Product Start -->
        <div class="col-lg-12 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="<?php echo e(route('products.search')); ?>" method="get">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('get'); ?>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar por nombre" name="search">
                                <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <button type="submit" ><i class="fa fa-search"></i></button>
                                        </span>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>


                <?php if (session()->has('products')): ?>

                    <?php ($products = session('products')); ?>
                <?php endif; ?>

                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach ($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <!--metodo accesor para la imagen-->
                                <img class="img-fluid w-100" src="<?php echo e($product->getImageUrl()); ?>" alt="Producto ">
                            </div>
                            <!--Card Body-->
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3"><?php echo e($product->name); ?></h6>
                                <div class="d-flex justify-content-center">
                                    <h6>$<?php echo e($product->formatDiscount()); ?></h6><h6 class="text-muted ml-2"><del><?php echo e($product->formatPrice()); ?></del></h6>
                                </div>


                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="<?php echo e(route('products.detail', $product->id)); ?>" class="btn btn-sm text-dark p-0">
                                    <i class="fas fa-eye text-primary mr-1"></i>Ver Detalles
                                </a>





                                <form action="<?php echo e(route('products.cart.store', $product->id)); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i>Añadir al Carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <h2>vacio</h2>
                    <?php if ($errors->isEmpty()): ?>
                        <?php if (session()->has('result')): ?>
                            <h2><?php echo e(session('result')); ?></h2>
                        <?php elseif (!(session()->has('result'))): ?>
                            <h2>Oops No hay productos relacionados, Actualizaciones Pronto...</h2>
                        <?php endif; ?>

                    <?php else: ?>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach ($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
                <?php endif; ?>


                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <div class="d-flex justify-content-center">

                            <?php if (count($products) > 0): ?>
                                <?php echo $products->links(); ?>

                            <?php endif; ?>
                        </div>

                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->


<?php $__env->stopSection(); ?>


<?php echo $__env->make('nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-projects\store-evertec\resources\views/welcome.blade.php ENDPATH**/ ?>