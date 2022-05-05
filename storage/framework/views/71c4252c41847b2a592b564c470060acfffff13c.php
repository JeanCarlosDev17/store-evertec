<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.edit')): ?>
    
    <?php $__env->startSection('title', 'Crear Producto'); ?>



<?php $__env->startSection('content'); ?>
    <div class="col-10 ml-4">
        <h1>Agregar Producto</h1>








        <?php if (isset($component)) {
    $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component;
} ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.admin.validationErrors', 'data' => ['errors' => $errors]]); ?>
<?php $component->withName('admin.validationErrors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

        <div id="errors" class="alert alert-danger ml-4 " style="display: none">
            <div class="alert-title font-semibold text-lg text-red-800">
               <span class="text-red-500 bg-red-500">
                <i class="fas fa-exclamation-triangle"></i>
            </span> <?php echo e(__('Whoops, something went wrong')); ?>

            </div>
            <div id="listErrors" class="alert-description text-sm text-red-600">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach ($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div id="success-alerts" style="display: none">

        </div>
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


        <form action="<?php echo e(route('products.store')); ?>" id="formProduct" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('POST'); ?>







            <div class="row mb-3">
                <label for="inputName" class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-9">
                    <input type="text"  class="<?php echo \Illuminate\Support\Arr::toCssClasses(['form-control', 'is-invalid'=>$errors->has('name')]) ?>" id="inputName" name="name" required value="<?php echo e(old('name')); ?>">



                </div>



            </div>
            <div class="row mb-3">
                <label for="inputDescription" class="col-sm-3 col-form-label">Descripción</label>
                <div class="col-sm-9">
                    <textarea class="<?php echo \Illuminate\Support\Arr::toCssClasses(['form-control', 'is-invalid'=>$errors->has('description')]) ?>" id="textAdescription" rows="3" name="description"><?php echo e(old('description')); ?></textarea>




                </div>

            </div>

            <div class="row mb-3">
                <label for="inputPrice" class="col-sm-3 col-form-label">Precio</label>
                <div class="col-sm-9">
                    <input type="number" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['form-control', 'is-invalid'=>$errors->has('price')]) ?>" id="inputPrice"  min="1" required  name="price" step="1"

                           value="<?php echo e(old('price')); ?>">



                </div>

            </div>
            <div class="row mb-3">
                <label for="inputMaker" class="col-sm-3 col-form-label">Marca</label>
                <div class="col-sm-9">
                    <input type="text" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['form-control', 'is-invalid'=>$errors->has('maker')]) ?>"  id="inputMaker"  name="maker" value="<?php echo e(old('maker')); ?>">



                </div>

            </div>

            <div class="row mb-3">
                <label for="input" class="col-sm-3 col-form-label">Cantidad en Stock</label>
                <div class="col-sm-9">
                    <input type="number" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['form-control', 'is-invalid'=>$errors->has('quantity')]) ?>" min="0" max="16770200" required  name="quantity"
                           value="<?php echo e(old('quantity'), '1'); ?>">



                </div>
            </div>








            <div class="row mb-3">
                <label for="input" class="col-sm-3 col-form-label">IMAGENES</label>
                <div class="col-sm-9 border border-dark">

                    <input  id="files"
                            type="file"
                            multiple
                            data-allow-reorder="true"
                            data-max-file-size="3MB"
                            data-max-files="5"
                            accept="image/jpg,image/jpeg,image/png,image/bmp"
                            class="<?php echo \Illuminate\Support\Arr::toCssClasses(['is-invalid'=>$errors->has('images')]) ?>"
                            required  name="images[]">

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>

        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />
    <link
        href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css"
        rel="stylesheet"
    />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script defer src="<?php echo e(asset('js/app.js')); ?>">


    </script>


<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-projects\store-evertec\resources\views/admin/addProduct.blade.php ENDPATH**/ ?>