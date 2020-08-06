<?php $__env->startSection('title','Producto'); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/piexif.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/sortable.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/purify.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/fileinput.min.js"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/bootstrap-fileinput/themes/fa/theme.js')); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/locales/es.js"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/select2/js/select2.full.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/pages/scripts/product/edit.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/custom/validation-general.js')); ?>"></script>
  <script src="<?php echo e(asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>

  <link rel="stylesheet" href="<?php echo e(asset("dsadmin//plugins/toastr/toastr.min.css")); ?>">
  <link href="<?php echo e(asset("dsadmin/plugins/select2/css/select2.min.css")); ?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo e(asset("dsadmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")); ?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo e(asset("dsadmin/plugins/bootstrap-fileinput/css/fileinput.min.css")); ?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo e(asset("dsadmin/pages/css/product/edit.css")); ?>" rel="stylesheet" type="text/css"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="content">

  <!-- Default box -->
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title"><strong>Editar este producto</strong></h3>
      <div class="float-sm-right">
        <a href="<?php echo e(route('product-index')); ?>">Listado</a> / <a class="active">Editar</a>
      </div>  
    </div>
    <div class="card-body">
      <?php echo $__env->make('includes.form-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="row">
          <!-- left column -->
          <div class="col-md-12  ">
          <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="<?php echo e(route('product-update', ['product_id' => $product->product_id])); ?>" id="form-general">
                <?php echo csrf_field(); ?> <?php echo method_field("put"); ?>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="kv-product">
                            <div class="file-loading">
                                <input id="product_image" name="product_image" type="file">
                                <input id="product_image_name" type="hidden" value="<?php echo e($product->product_image_name); ?>">
                            </div>
                        </div>
                        <div class="kv-product-hint">
                            <small>Selecciona la imagen del producto</small>
                        </div>
                    </div>
                    <div class="col-md-8">
                    <div class="row form-group">
                      <div class="col-md-6">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Nombre del producto" value="<?php echo e(old('product_name', $product->product_name ?? '')); ?>" autocomplete="off" required>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputEmail1">Marca</label>
                        <input type="text" name="product_trademark" class="form-control" id="product_trademark" placeholder="Marca del producto" value="<?php echo e(old('product_trademark', $product->product_trademark ?? '')); ?>" autocomplete="off" required>
                      </div>
                    </div>  
                    <div class="row form-group">
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Contenido neto</label>
                        <input type="text" name="product_net_content" class="form-control lowercase" id="product_net_content" placeholder="Contenido neto del producto" value="<?php echo e(old('product_net_content',$product->product_net_content ?? '')); ?>" autocomplete="off" required>
                      </div> 
                      <div class="col col-md-6">
                        <label>Categoria del producto</label>
                        <select  class="select2" name="product_category_id[]" id="product_categories" multiple="multiple" data-placeholder="Selecciona las categorias" data-dropdown-css-class="select2-blue" style="width: 100%; color: black">
                          <?php $__currentLoopData = $product_categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                            <option value="<?php echo e($product_category->product_category_id); ?>" <?php $__currentLoopData = $product->productCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_category_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($product_category_detail->product_category_id==$product_category->product_category_id): ?> selected <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> ><?php echo e($product_category->product_category_name); ?></option>                     
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>                                           
                    </div> 
                    <div class="row form-group" id="div-reply-modifiable">
                      <div class="col col-md-12">
                        <label>Que se puede modificar en este producto</label>
                         <select id="modifiable" multiple="multiple" data-placeholder="Selecciona que se puede modificar"  style="width: 100%" disabled>
                          
                          <?php $__currentLoopData = $modifiables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$modifiable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($product->product_colors!=null && $modifiable=="Colores"): ?>
                              <option value="<?php echo e($key); ?>" selected><?php echo e($modifiable); ?></option>
                            <?php elseif($product->product_flavors!=null && $modifiable=="Sabores"): ?>
                              <option value="<?php echo e($key); ?>" selected><?php echo e($modifiable); ?></option>
                            <?php elseif($product->product_recipes!=null && $modifiable=="Recetas"): ?>
                              <option value="<?php echo e($key); ?>" selected><?php echo e($modifiable); ?></option>
                            <?php else: ?>
                              <option value="<?php echo e($key); ?>"><?php echo e($modifiable); ?></option> 
                            <?php endif; ?>  
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                      </div>
                    </div>
                    <div class="row form-group div-reply-modifiable" id="div-reply-modifiable-color">
                      <div class="col col-md-12">
                        <label><i class="fa fa-angle-right"></i> Colores (Separados con coma y sin espacio)</label>
                        <input type="text" name="product_colors" class="form-control lowercase value_without_space input-reply-modifiable" id="color" placeholder="rojo,verde,azul,plateado" value="<?php echo e(old('product_colors', $product->product_colors)); ?>" autocomplete="off" disabled>
                      </div>
                    </div>
                    <div class="row form-group div-reply-modifiable" id="div-reply-modifiable-flavor">
                      <div class="col col-md-12">
                        <label><i class="fa fa-angle-right"></i> Sabores (Separados con coma y sin espacio)</label>
                        <input type="text" name="product_flavors" class="form-control lowercase value_without_space input-reply-modifiable" id="flavor" placeholder="fresa,mango,mora,limon" value="<?php echo e(old('product_flavors', $product->product_flavors)); ?>" autocomplete="off" disabled>
                      </div>
                    </div>
                    <div class="row form-group div-reply-modifiable" id="div-reply-modifiable-recipes">
                      <div class="col col-md-12">
                        <label><i class="fa fa-angle-right"></i> Recetas (Listado por -> (flechas) las flechas se agregan solas despues de un enter)</label>
                        <textarea name="product_recipes" class="form-control lowercase input-reply-modifiable" id="recipes" placeholder="->Huevos, salchichas rancheras con tomate
->Huevos, salchicha ranchera con cebolla
->Huevos, salchicha ranchera con tomate y cebolla" disabled style="height: 150px;"><?php echo e(old('product_recipes', $product->product_recipes)); ?></textarea>
                        
                      </div>
                    </div>
                    <div class="row form-group" id="div-reply-personalized">
                      <div class="col col-md-12">
                        <label>Con que se puede personalizar este producto</label>
                         <select id="personalized" multiple="multiple" data-placeholder="Selecciona con que se puede personalizar" name="personalized[]"  style="width: 100%;" disabled>
                          <?php if($product->product_customization != NULL): ?>                           
                            <?php $__currentLoopData = $product_customizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_customization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($product_customization == "text"): ?>
                                <option value="text" selected>Texto</option>
                                <option value="iamge">Imagen</option>
                              <?php elseif($product_customization == "image"): ?>
                                <option value="image" selected>Imagen</option>
                                 <option value="text">Texto</option>
                              <?php else: ?>
                                <option value="text" selected>Texto</option>
                                <option value="image" selected>Imagen</option>
                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php else: ?>
                            <option value="text">Texto</option>
                            <option value="iamge">Imagen</option>
                          <?php endif; ?>
                         </select>
                      </div>
                    </div>
                                                                          
                    <div class="row form-group">
                      <div class="col-md-9">
                        <label for="exampleInputEmail1">Precio</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="number" name="product_price" class="form-control" id="product_price" placeholder="precio de producto" value="<?php echo e(old('product_price', $product->product_price ?? '')); ?>" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputFile">Desactivo/Activo</label>
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <?php if($product->product_state == 'desactive'): ?>
                              <input type="checkbox" class="custom-control-input" id="customSwitch3" name="state">
                            <?php else: ?>
                              <input type="checkbox" checked="checked" class="custom-control-input" id="customSwitch3" name="state">
                            <?php endif; ?>
                            <label class="custom-control-label" for="customSwitch3"></label>
                          </div>
                        </div>
                      </div>                      
                    </div>
                  </div>
                </div>
              </div>      
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success col-md-12">Guardar</button>
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
<?php echo $__env->make('dsadmin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/admin/product/edit.blade.php ENDPATH**/ ?>