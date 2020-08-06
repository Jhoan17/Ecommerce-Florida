@extends('dsadmin.layout')

@section('title','Usuarios')

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
  <script src="{{asset('dsadmin/pages/scripts/user/edit.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/piexif.min.js" type="text/javascript"></script>
@endsection

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <link href="{{asset("dsadmin/plugins/bootstrap-fileinput/css/fileinput.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/pages/css/user/edit.css")}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card card-success">
    <div class="card-header ">
      <h3 class="card-title"><strong>Editar Usuario</strong></h3>
      <div class="float-sm-right">
        <a href="{{route('user-index')}}">Listado</a> / <a class="active">Crear</a>
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
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('user-update', ['user_id' => $user->user_id])}}" id="form-general">
                @csrf @method("put")
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="kv-product">
                            <div class="file-loading">
                                <input id="user_image" name="user_image" type="file">
                                <input id="user_image_name" type="hidden" value="{{$user->user_image_name}}">
                            </div>
                        </div>
                        <div class="kv-product-hint">
                            <small>Seleccionar foto</small>
                        </div>
                    </div>
                    <div class="col-md-8">
                    <div class="row form-group">
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Nombres</label>
                        <input type="text" name="user_name" class="form-control lowercase" id="user_name" placeholder="Ingrese sus nombres" value="{{old('user_name', $user->user_name ?? '')}}" autocomplete="off" required>
                      </div>
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Apellidos</label>
                        <input type="text" name="user_surname" class="form-control lowercase" id="user_surname" placeholder="Igrese sus Apellidos" value="{{old('user_surname', $user->user_surname ?? '')}}" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-6">
                        <div class="form-group" >
                          <label>N° Identificacion</label>
                          <input type="text" class="form-control lowercase" name="user_id_card"  placeholder="Numero de Identificacion" value="{{old('user_id_card', $user->user_id_card ?? '')}}" data-dropdown-css-class="select2-blue" style="width: 100%; color: black" required>
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="text" name="user_email" class="form-control lowercase" id="user_email" placeholder="Ingrese su E-mail aqui" value="{{old('user_email', $user->user_email ?? '')}}" autocomplete="off" required>
                      </div>
                    </div>

                    <div class="row form-group">
                      <div class="col col-md-6">
                        <div class="form-group" >
                          <label>N° Telefono</label>
                          <input type="text" class="form-control lowercase" name="user_phone"  placeholder="Numero de Telefono" value="{{old('user_phone', $user->user_phone ?? '')}}" data-dropdown-css-class="select2-blue" style="width: 100%; color: black">
                        </div>
                      </div>
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Fecha nacimiento</label>
                        <input type="date" name="user_birth_date" class="form-control lowercase" id="user_birth_date"  value="{{old('user_birth_date', $user->user_birth_date ?? '')}}" autocomplete="off" required>
                      </div>
                    </div>

                    <div class="row form-group">
                      <div class="col col-md-6">
                        <div class="form-group" >
                          <label>Genero</label>
                          <select  class="select form-control" name="user_gender" data-placeholder="Selecciona el genero" value="{{old('')}}" data-dropdown-css-class="select2-blue" style="width: 100%; color: black" required>
                              <option value="">Genero</option>
                              @foreach ($genders as $value => $name)
                            
                                    <option value="{{$value}}" @if ($user->user_gender==$value) selected @endif>{{$name}}</option>
                              @endforeach

                          </select>
                        </div>
                      </div>
                        <input type="hidden" name="user_state" value="{{$user->user_state}}"> <!--Estado inactivo-->
                        <div class="col col-md-6">
                          <div class="form-group" >
                            <label>Tipo de rol</label>
                            <select  class="select form-control" name="rol_id" data-placeholder="Selecciona el rol" data-dropdown-css-class="select2-blue" style="width: 100%; color: black" required>
                            <option value="">Seleccionar rol del usuario</option>
                            @foreach($rols as $rol)

                              <option value="{{$rol->rol_id}}" @if ($user->rol_id==$rol->rol_id) selected @endif>{{$rol->rol_name}}</option>

                            @endforeach
                            </select>
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
      {{-- Footer --}}
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

@endsection
