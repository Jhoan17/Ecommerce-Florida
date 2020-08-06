

<?php $__env->startSection('title','Usarios'); ?>

<?php $__env->startSection('scripts'); ?>

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?php echo e(asset('dsadmin/pages/scripts/user/index.js')); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
  <link href="<?php echo e(asset('dsadmin/pages/css/user/index.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

  <section class="content">

<!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Listado de usuarios</strong></h3>
        <?php echo csrf_field(); ?>
        <div class="card-tools">
          <a href="<?php echo e(route('user-create')); ?>" class="btn btn-block btn-outline-info">
            <i class="fas fa-plus"></i> Agregar
          </a>
        </div>
      </div>
      <div class="card-body">
      <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <br>
                <table class="table table-striped table-borderedr" id="table-users">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Foto</th>
                      <!--<th>N° Cedula</th>-->
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Email</th>
                      <th>Telefono</th>
                      <!--<th>Fecha de nacimiento</th>-->
                      <!--<th>Genero</th>-->
                      <th>Rol</th>
                      <th class="text-center">Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($count++); ?></td>
                        <td  class="justify-content-center" style="padding-left: 20px; padding-top: 2px; padding-bottom: 2px;">
                          <?php if($user->user_image_name == ""): ?>
                          <div class="product-image-thumb justify-content-center" style="width: 42px; height: 50px;">
                              <a href="" style="font-size: 24px;  color:#17a2b0"><i class="fa fa-plus-circle"></i></a>
                            </div>
                          <?php else: ?>
                          <div class="product-image-thumb" style="width: 42px; height: 50px; overflow: hidden;">
                            <a href="<?php echo e($user->user_image_name); ?>" data-gallery="user-gallery-<?php echo e($user->user_id); ?>" data-title="<?php echo e(ucwords($user->user_name)); ?>(<?php echo e($user->user_surname); ?>)" data-footer="<a href='<?php echo e(route('user-image-edit', ['user_id' => $user->user_id])); ?>' class='btn btn-success' title='Cambiar imagen'><i class='fa fa-exchange-alt'></i></a>" data-toggle="lightbox">
                            <img src="<?php echo e($user->user_image_name); ?>">
                            </a>
                          </div>
                          <?php endif; ?>
                        </td>
                        <td class="align-middle"><?php echo e($user->user_name); ?></td>
                        <td class="align-middle"><?php echo e($user->user_surname); ?></td>
                        <td class="align-middle"><?php echo e($user->user_email); ?></td>
                        <td class="align-middle"><?php echo e($user->user_phone); ?></td>
                        <td class="align-middle"><?php echo e($user->rol->rol_name); ?></td>
                        <td class="text-center align-middle">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <?php if($user->user_state == 'desactive'): ?>
                            <input type="checkbox" data-url="<?php echo e(route('user-change-state', ['user_id' => $user->user_id, 'user_state' => $user->user_state])); ?>" class="custom-control-input change-state" id="<?php echo e($user->user_id); ?>" name="state">
                            <?php else: ?>
                            <input type="checkbox" data-url="<?php echo e(route('user-change-state', ['user_id' => $user->user_id, 'user_state' => $user->user_state])); ?>" checked="checked" class="custom-control-input change-state" id="<?php echo e($user->user_id); ?>" name="state">
                            <?php endif; ?>
                            <label class="custom-control-label" for="<?php echo e($user->user_id); ?>"></label>
                          </div>
                        </td>
                        <!--botones de acciones-->
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                          <a href="<?php echo e(route('user-show', $user)); ?>" class="btn btn-info user-show" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                          <?php echo csrf_field(); ?>
                          <a href="<?php echo e(route('user-edit', ['user_id' => $user->user_id])); ?>" class="btn btn-success" title="Editar"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo e(route('user-destroy', ['user_id' => $user->user_id])); ?>" class="btn btn-danger user-destroy"><i class="fas fa-trash"></i></a>
                        </div>
                      </td><!--Fin botones acciones-->
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade remove-background" id="modal-user-show">
      <!-- /.modal-dialog -->
      </div>
      <div class="card-footer">
      
      </div>
<!-- /.card-footer-->
  </div>
<!-- /.card -->
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('dsadmin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/admin/user/index.blade.php ENDPATH**/ ?>