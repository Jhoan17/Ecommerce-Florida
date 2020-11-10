@extends('dsadmin.layout')

@section('title','menùs')

@section('scripts')
  <script src="{{asset("dsadmin/plugins/jquery-nestable/jquery.nestable.js")}}" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/pages/scripts/menu/create.js')}}"></script>

@endsection

@section('styles')
  <link src="{{asset("dsadmin/plugins/jquery-nestable/jquery.nestable.css")}}" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
@endsection


@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><strong>Crear menu</strong></h3>
      <div class="float-sm-right">
        <a href="{{route('menu-index')}}">Listado</a> / <a class="active">Crear</a>
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
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('menu-store')}}" id="form-general">
                @csrf
                <div class="card-body">
                  <div class="row form-group">
                    <div class="col col-md-12">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" name="menu_name" class="form-control lowercase" id="menu_name" placeholder="Nombre del menu" value="{{old('menu_name')}}" autocomplete="off" required>
                    </div>
                  </div>  
                  <div class="row form-group">  
                    <div class="col col-md-12">
                      <label for="exampleInputEmail1">Url</label>
                      <input type="text" name="menu_url" class="form-control lowercase" id="menu_url" placeholder="Url del menu" value="{{old('menu_url')}}" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="form-group">
                  <label>Icono</label>
                  <div class="input-group" data-colorpicker-id="2">
                    <input type="text" name="menu_iconfa" class="form-control lowercase" id="menu_icon" placeholder="Icono del menu" value="{{old('menu_icon')}}" autocomplete="off">

                    <div class="input-group-append">
                      <span class="input-group-text"><i id="show-icon" class="fa fa-question"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
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