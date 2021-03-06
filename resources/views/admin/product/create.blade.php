@extends('dsadmin.layout')

@section('title','Producto')

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/sortable.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/purify.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/fileinput.min.js"></script>
  <script src="{{asset('dsadmin/plugins/bootstrap-fileinput/themes/fa/theme.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/locales/es.js"></script>
  <script src="{{asset('dsadmin/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <script src="{{asset('dsadmin/pages/scripts/product/create.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/piexif.min.js" type="text/javascript"></script>
@endsection

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <link href="{{asset("dsadmin/plugins/bootstrap-fileinput/css/fileinput.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/pages/css/product/create.css")}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card card-primary">
    <div class="card-header ">
      <h3 class="card-title"><strong>Crear producto</strong></h3>
      <div class="float-sm-right">
        <a href="{{route('product-index')}}">Listado</a> / <a class="active">Crear</a>
      </div>  
    </div>
    <div class="card-body">
      @include('includes.form-error')
      @include('includes.messages')
      <div class="row">
          <!-- left column -->
          <div class="col-md-12">

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('product-store')}}" id="form-general">
                @csrf                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="kv-product">
                            <div class="file-loading">
                                <input id="product_image" name="product_image" type="file">
                            </div>
                        </div>
                        <div class="kv-product-hint">
                            <small>Selecciona la imagen del producto</small>
                        </div>
                    </div>
                    <div class="col-md-8">
                    <div class="row form-group">
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="product_name" class="form-control lowercase" id="product_name" placeholder="Nombre del producto" value="{{old('product_name')}}" autocomplete="off" required>
                      </div>
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Marca</label>
                        <input type="text" name="product_trademark" class="form-control lowercase" id="product_trademark" placeholder="Marca del producto" value="{{old('product_trademark')}}" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="row form-group" id="div-petition">
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Contenido neto</label>
                        <input type="text" name="product_net_content" class="form-control lowercase" id="product_net_content" placeholder="Contenido neto del producto" value="{{old('product_net_content')}}" autocomplete="off" required>
                      </div> 
                      <div class="col col-md-6">
                        <div class="form-group">
                          <label>Categoria de producto</label>
                          <select id="product_categories" multiple="multiple" name="product_category_id[]" data-placeholder="Selecciona las categorias"  style="width: 100%;">
                          @foreach($product_categorys as $product_category)
                            <option value="{{$product_category->product_category_id}}">{{$product_category->product_category_name}}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>                                           
                    </div>
                    <div class="row form-group" id="div-reply-modifiable">
                      <div class="col col-md-12">
                        <label>Que se puede modificar en este producto</label>
                         <select id="modifiable" multiple="multiple" data-placeholder="Selecciona que se puede modificar"  style="width: 100%" disabled>
                          {{-- <option disabled selected>Selecciona que se puede modificar</option> --}}
                          <option value="1">Color</option>
                          <option value="2">Sabor</option>
                          <option value="3">Receta</option>
                         </select>
                      </div>
                    </div>
                    <div class="row form-group div-reply-modifiable" id="div-reply-modifiable-color">
                      <div class="col col-md-12">
                        <label><i class="fa fa-angle-right"></i> Colores (Separados con coma y sin espacio)</label>
                        <input type="text" name="product_colors" class="form-control lowercase value_without_space input-reply-modifiable" id="color" placeholder="rojo,verde,azul,plateado" value="{{old('color')}}" autocomplete="off" disabled>
                      </div>
                    </div>
                    <div class="row form-group div-reply-modifiable" id="div-reply-modifiable-flavor">
                      <div class="col col-md-12">
                        <label><i class="fa fa-angle-right"></i> Sabores (Separados con coma y sin espacio)</label>
                        <input type="text" name="product_flavors" class="form-control lowercase value_without_space input-reply-modifiable" id="flavor" placeholder="fresa,mango,mora,limon" value="{{old('flavor')}}" autocomplete="off" disabled>
                      </div>
                    </div>
                    <div class="row form-group div-reply-modifiable" id="div-reply-modifiable-recipes">
                      <div class="col col-md-12">
                        <label><i class="fa fa-angle-right"></i> Recetas (Listado por -> (flechas) las flechas se agregan solas despues de un enter)</label>
                        <textarea name="product_recipes" class="form-control lowercase input-reply-modifiable" id="recipes" placeholder="->Huevos, salchichas rancheras con tomate
->Huevos, salchicha ranchera con cebolla
->Huevos, salchicha ranchera con tomate y cebolla" disabled style="height: 150px;"></textarea>
                        {{-- <input type="text" name="recipes" class="form-control lowercase" id="recipes" placeholder="Contenido neto del producto" value="{{old('recipes')}}" autocomplete="off" readonly> --}}
                      </div>
                    </div>
                    <div class="row form-group" id="div-reply-personalized">
                      <div class="col col-md-12">
                        <label>Con que se puede personalizar este producto</label>
                         <select id="personalized" multiple="multiple" data-placeholder="Selecciona con que se puede personalizar" name="personalized[]"  style="width: 100%;" disabled>
                          {{-- <option disabled selected>Selecciona con que se puede personalizar</option> --}}
                          <option value="text">Texto</option>
                          <option value="image">Imagen</option>
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
                          <input type="number" name="product_price" class="form-control" id="product_price" placeholder="precio de producto" value="{{old('product_price')}}" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="exampleInputFile">Desactivo/Activo</label>
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" checked="checked" class="custom-control-input" id="customSwitch3" name="state">
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
                  <button type="submit" class="btn btn-primary col-md-12">Guardar</button>
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
      {{-- Footer --}}
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

@endsection