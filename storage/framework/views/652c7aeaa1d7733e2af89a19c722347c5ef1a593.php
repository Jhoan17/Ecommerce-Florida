<?php $__env->startSection('title','Admin'); ?>

<?php $__env->startSection('content'); ?>

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Inicio</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      Bienvenido a tu programa de administración
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Creado por JSMT 
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dsadmin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/admin/admin.blade.php ENDPATH**/ ?>