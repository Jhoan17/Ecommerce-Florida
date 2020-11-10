@extends('dsadmin.layout')

@section('title','permisos')

@section('scripts')
  <script src="{{asset("dsadmin/plugins/jquery-nestable/jquery.nestable.js")}}" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/pages/scripts/permission/create.js')}}"></script>

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
      <h3 class="card-title"><strong>Crear permiso</strong></h3>
      <div class="float-sm-right">
        <a href="{{route('permission-index')}}">Listado</a> / <a class="active">Crear</a>
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
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('permission-store')}}" id="form-general">
                @csrf
                <div class="card-body">
                  <div class="row form-group">
                    <div class="col col-md-12">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" name="permission_name" class="form-control lowercase" id="permission_name" placeholder="Nombre del permiso" value="{{old('permission_name')}}" autocomplete="off" required>
                    </div>
                  </div>  
                  <div class="row form-group">  
                    <div class="col col-md-12">
                      <label for="exampleInputEmail1">Slug</label>
                      <input type="text" name="permission_slug" class="form-control lowercase" id="permission_slug" placeholder="Slug del permiso" value="{{old('permission_slug')}}" autocomplete="off" required>
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
            <div class="col-md-6">

            </div>
          <!--/.col (right) -->
        </div>
      </div>
  <!-- /.card -->

</section>

@endsection