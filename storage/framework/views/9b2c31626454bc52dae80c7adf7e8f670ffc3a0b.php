

<?php $__env->startSection('title','usuario'); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/piexif.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/sortable.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/purify.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/fileinput.min.js"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/bootstrap-fileinput/themes/fa/theme.js')); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/locales/es.js"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/pages/scripts/user/edit-image.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/custom/validation-general.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>

  <link rel="stylesheet" href="<?php echo e(asset("dsadmin//plugins/toastr/toastr.min.css")); ?>">
  <link href="<?php echo e(asset("dsadmin/plugins/bootstrap-fileinput/css/fileinput.min.css")); ?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo e(asset("dsadmin/pages/css/user/create.css")); ?>" rel="stylesheet" type="text/css"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Editar esta imagen de la <?php echo e(ucwords($user->user_name)); ?></strong></h3>
      <div class="float-sm-right">
        <a href="<?php echo e(route('product-index')); ?>">Listado</a> / <a class="active">Editar Imagen</a>
      </div>
    </div>
    <div class="card-body">
      <?php echo $__env->make('includes.form-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="row">
          <!-- left column -->
          <div class="col-md-12  ">
          <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="<?php echo e(route('user-image-update', ['user_id' => $user->user_id])); ?>" id="form-general">
                <?php echo csrf_field(); ?> <?php echo method_field("put"); ?>
                <div class="card-body">
                    <div class="row form-group justify-content-center">
                      <?php if($user->user_image_name==""): ?>
                        <input id="user_image_name" type="hidden" value="https://www.dropbox.com/s/0zvf0jmjo2b9cz2/1f3f7.png?raw=1">
                      <?php else: ?>
                        <input id="user_image_name" type="hidden" value="<?php echo e($user->user_image_name); ?>">
                      <?php endif; ?>

                        <div class="col-md-4 text-center">
                            <div class="kv-user">
                                <div class="file-loading">
                                    <input id="user_image" name="user_image" type="file">
                                </div>
                            </div>
                            <div class="kv-user-hint">
                                <small>Selecciona la imagen del usuario</small>
                            </div>
                        </div>

                    </div>

                  </div>
                  <div class="card-footer justify-content-center">
                    <button type="submit" class="btn btn-success col-md-12">Guardar</button>
                  </div>

                <!-- /.card-body -->
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

<?php echo $__env->make('dsadmin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/admin/user/edit-image.blade.php ENDPATH**/ ?>