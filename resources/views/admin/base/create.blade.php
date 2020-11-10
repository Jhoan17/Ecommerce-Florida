@extends('dsadmin.layout')

@section('title','Base')

@section('scripts')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/sortable.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/purify.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/fileinput.min.js"></script>
  <script src="{{asset('dsadmin/plugins/bootstrap-fileinput/themes/fa/theme.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/locales/es.js"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <!-- Bootstrap Switch -->
  <script src="https://adminlte.io/themes/v3/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/base/create.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/piexif.min.js" type="text/javascript"></script>


@endsection

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <link href="{{asset("dsadmin/plugins/bootstrap-fileinput/css/fileinput.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/pages/css/base/create.css")}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><strong>Crear base</strong></h3>
      <div class="float-sm-right">
        <a href="{{route('base-index')}}">Listado</a> / <a class="active">Crear</a>
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
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('base-store')}}" id="form-general">
                @csrf
                <div class="card-body">
                    <div class="row form-group">
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="base_name" class="form-control lowercase" id="base_name" placeholder="Nombre de la base" value="{{old('base_name')}}" autocomplete="off" required>
                      </div>
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Medidas</label>
                        <input type="text" name="base_measure" class="form-control lowercase" id="base_measure" placeholder="Medidas de la base" value="{{old('base_measure')}}" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Colores</label>
                        <input type="text" name="base_colors" class="form-control lowercase value_without_space" id="base_name" placeholder="cafe,azul,verde,rojo" value="{{old('base_colors')}}" autocomplete="off" required>
                      </div>
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">¿ Es personalizable ?</label><br>
                        <input type="checkbox" name="base_customization" value="text" checked data-bootstrap-switch data-off-color="danger">
                      </div>
                    </div>                                                         
                    <div class="row form-group">                     
                      <div class="col-md-9">
                        <label for="exampleInputEmail1">Descripción</label>
                         <textarea id="base_description" name="base_description" class="form-control lowercase" placeholder="Alguna referencia más de esta base" required>{{old('base_description')}}</textarea>
                      </div>
                      <div class="col-md-3">
                        <label for="exampleInputEmail1">Precio</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="number" name="base_price" class="form-control" id="base_price" placeholder="precio de la base" value="{{old('base_price')}}" autocomplete="off" required>
                        </div>
                      </div>                     
                    </div>
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label for="input-24">Selecciona las imagenes de la base</label>
                        <div class="file-loading col-md-12">
                            <input id="input-24" name="base_image[]" type="file" multiple>
                        </div>
                      </div>
                      <input type="hidden" name="base_state" value="active">
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