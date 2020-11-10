@extends('dsadmin.layout')

@section('title','Base')

@section('scripts')


  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <!-- Bootstrap Switch -->
  <script src="https://adminlte.io/themes/v3/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/base/edit.js')}}"></script>
  

@endsection

@section('styles')

  <link rel="stylesheet" href="{{asset("dsadmin//plugins/toastr/toastr.min.css")}}">
  <link href="{{asset("dsadmin/pages/css/base/create.css")}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title"><strong>Editar esta base</strong></h3>
      <div class="float-sm-right">
        <a href="{{route('base-index')}}">Listado</a> / <a class="active">Editar</a>
      </div>  
    </div>
    <div class="card-body">
      @include('includes.form-error')
      <div class="row">
          <!-- left column -->
          <div class="col-md-12  ">
          <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('base-update', ['base_id' => $base->base_id])}}" id="form-general">
                @csrf @method("put")
                <div class="card-body">
                    <div class="row form-group">
                      <div class="col-md-6">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" name="base_name" class="form-control" id="base_name" placeholder="Nombre de la base" value="{{old('base_name', $base->base_name ?? '')}}" autocomplete="off" required>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputEmail1">Medidas</label>
                        <input type="text" name="base_measure" class="form-control" id="base_measure" placeholder="Medida de la base" value="{{old('base_measure', $base->base_measure ?? '')}}" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Colores</label>
                        <input type="text" name="base_colors" class="form-control lowercase value_without_space" id="base_name" placeholder="cafe,azul,verde,rojo" value="{{old('base_colors', $base->base_colors ?? '')}}" autocomplete="off" required>
                      </div>
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">¿ Es personalizable ?</label><br>
                        <input type="checkbox" name="base_customization" value="text" @if($base->base_customization!=""){{"checked"}}@endif  data-bootstrap-switch data-on-color="success" data-off-color="danger">
                      </div>
                    </div> 
                    <div class="row form-group">                     
                      <div class="col-md-6">
                        <label for="exampleInputEmail1">Descripción</label>
                        <textarea id="base_description" name="base_description" class="form-control" placeholder="Sabor, medida o cantidad" required>{{old('base_description', $base->base_description ?? '')}}</textarea>
                      </div>   
                      <div class="col-md-4">
                        <label for="exampleInputEmail1">Precio</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="number" name="base_price" class="form-control" id="base_price" placeholder="Cantidad de baseo" value="{{old('base_price', $base->base_price ?? '')}}" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="exampleInputFile">Desactivo/Activo</label>
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            @if($base->base_state == 'desactive')
                              <input type="checkbox" class="custom-control-input" id="customSwitch3" name="state">
                            @else
                              <input type="checkbox" checked="checked" class="custom-control-input" id="customSwitch3" name="state">
                            @endif
                            <label class="custom-control-label" for="customSwitch3"></label>
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
      {{-- Footer --}}
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

@endsection