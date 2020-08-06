<?php $__env->startSection('title','Producto'); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
  <script src="<?php echo e(asset('dsadmin/pages/scripts/product/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

  <section class="content">

<!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Lista de los productos</strong></h3>
        <div class="card-tools">
          <a href="<?php echo e(route('product-create')); ?>" class="btn btn-block btn-outline-primary">
            <i class="fas fa-plus"></i> Agregar
          </a>
        </div>
      </div>
      <div class="card-body">
      <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
          <div class="col-12">   
            <div class="card-body table-responsive p-0">
              <br>
              <table class="table table-striped table-bordered" id="table-products">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Categorias</th>
                    <th>C. Neto</th>
                    <th>Precio</th>
                    <th class="text-center">Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="align-middle"><?php echo e($count++); ?></td>
                      <td  class="justify-content-center" style="padding-left: 20px; padding-top: 2px; padding-bottom: 2px;">
                        <?php if($product->product_image_name == ""): ?>
                        <div class="product-image-thumb justify-content-center" style="width: 42px; height: 50px;">
                            <a href="<?php echo e(route('product-image-edit', ['product_id' => $product->product_id])); ?>" style="font-size: 24px;  color:#17a2b0"><i class="fa fa-plus-circle"></i></a>
                          </div>
                        <?php else: ?>
                        <div class="product-image-thumb" style="width: 42px; height: 50px; overflow: hidden;">
                          <a href="<?php echo e($product->product_image_name); ?>" data-gallery="product-gallery-<?php echo e($product->product_id); ?>" data-title="<?php echo e(ucwords($product->product_name)); ?>(<?php echo e($product->product_net_content); ?>)" data-footer="<a href='<?php echo e(route('product-image-edit', ['product_id' => $product->product_id])); ?>' class='btn btn-success' title='Cambiar imagen'><i class='fa fa-exchange-alt'></i></a>" data-toggle="lightbox">
                          <img src="<?php echo e($product->product_image_name); ?>">
                          </a>
                        </div> 
                        <?php endif; ?> 
                      </td>
                      <td class="align-middle"><?php echo e($product->product_name); ?></td>
                      <td class="align-middle"><?php echo e($product->product_trademark); ?></td>
                      <td class="align-middle"><?php $__currentLoopData = $product->productCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($product_category->product_category_name); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                      <td class="align-middle"><?php echo e($product->product_net_content); ?></td>
                      <td class="align-middle">$ <?php echo e($product->product_price); ?></td>
                      <td class="text-center align-middle">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <?php if($product->product_state == 'desactive'): ?>
                          <input type="checkbox" data-url="<?php echo e(route('product-change-state', ['product_id' => $product->product_id, 'product_state' => $product->product_state])); ?>" class="custom-control-input change-state" id="<?php echo e($product->product_id); ?>" name="state">
                          <?php else: ?>
                          <input type="checkbox" data-url="<?php echo e(route('product-change-state', ['product_id' => $product->product_id, 'product_state' => $product->product_state])); ?>" checked="checked" class="custom-control-input change-state" id="<?php echo e($product->product_id); ?>" name="state">
                          <?php endif; ?>
                          <label class="custom-control-label" for="<?php echo e($product->product_id); ?>"></label>
                        </div>
                      </td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                        <a href="<?php echo e(route('product-show', $product)); ?>" class="btn btn-info product-show" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                        <?php echo csrf_field(); ?>
                        <a href="<?php echo e(route('product-edit', ['product_id' => $product->product_id])); ?>" class="btn btn-success" title="Editar"><i class="fas fa-edit"></i></a>
                        <a href="<?php echo e(route('product-destroy', ['product_id' => $product->product_id])); ?>" class="btn btn-danger product-destroy"><i class="fas fa-trash"></i></a>
                      </div>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-product-show">
      <!-- /.modal-dialog -->
      </div>  
      <div class="card-footer">
        Hay <strong><?php echo e($count_products); ?></strong> productos registrados
      </div>
<!-- /.card-footer-->
  </div>
<!-- /.card -->
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dsadmin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/admin/product/index.blade.php ENDPATH**/ ?>