<?php $__env->startSection('title','Tipo de producto'); ?>

<?php $__env->startSection('scripts'); ?>

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?php echo e(asset('dsadmin/pages/scripts/product-category/index.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Categorias de producto</strong></h3>
    </div>
    <div class="card-body">
      <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado</h3>
                <div class="card-tools">
                  <a href="<?php echo e(route('product-category-create')); ?>" class="btn btn-block btn-outline-info">
                    <i class="fas fa-plus"></i> Agregar
                  </a>
                </div>                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <br>
                <table class="table table-hover text-nowrap" id="table-product-categories">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $product_categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($count++); ?></td>
                      <td><?php echo e($product_category->product_category_name); ?></td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="<?php echo e(route('product-category-edit', ['product_category_id' => $product_category->product_category_id])); ?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo e(route('product-category-destroy', ['product_category_id' => $product_category->product_category_id])); ?>" class="btn btn-danger product-category-destroy"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
    <div class="modal fade" id="modal-product-show">
      <!-- /.modal-dialog -->
    </div>  
    <div class="card-footer">
      
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dsadmin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/admin/product-category/index.blade.php ENDPATH**/ ?>