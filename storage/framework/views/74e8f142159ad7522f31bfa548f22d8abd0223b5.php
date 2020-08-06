<?php $__env->startSection('title','Categoria de producto'); ?>

<?php $__env->startSection('scripts'); ?>

  <script src="<?php echo e(asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/pages/scripts/product-category/create.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/custom/validation-general.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Crear Categoria de producto</strong></h3>
      <div class="float-sm-right">
        <a href="<?php echo e(route('product-category-index')); ?>">Listado</a> / <a class="active">Crear</a>
      </div>  
    </div>
    <div class="card-body">
      <?php echo $__env->make('includes.form-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="row">
          <!-- left column -->
          <div class="col-md-12">

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="<?php echo e(route('product-category-store')); ?>" id="form-general">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="row form-group">
                      <div class="col col-md-12">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="product_category_name" class="form-control" id="product_category_name" placeholder="Nombre de la Categoria de producto" value="<?php echo e(old('product_category_name')); ?>" autocomplete="off" required>
                      </div>
                    </div>
                 </div>   

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
    <!-- /.card-body -->
    <div class="card-footer">
      
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dsadmin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/admin/product-category/create.blade.php ENDPATH**/ ?>