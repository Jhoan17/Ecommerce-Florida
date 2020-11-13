@extends('dsadmin.layout')

@section('title','Admin')

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
  <script src="{{asset('dsadmin/pages/scripts/profile/index.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/js/plugins/piexif.min.js" type="text/javascript"></script>
@endsection

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <link href="{{asset("dsadmin/plugins/bootstrap-fileinput/css/fileinput.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/pages/css/profile/index.css")}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

  <!-- Default box -->
  @include('includes.form-error')
  @include('includes.messages')
  @include('includes.messages-error')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
              <li class="breadcrumb-item active">Mi Perfil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{$userImage}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{session('user_name')}}</h3>

                <p class="text-muted text-center">{{session('rol_name')}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <a href="{{route("order-user") }}">
                    <li class="list-group-item">
                      <b>Ordenes recibidas</b> <a class="float-right">{{count($orders)}}</a>
                    </li>
                  </a>
{{--                   <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li> --}}
                </ul>

               {{--  <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a id="hrefsettings" class="nav-link active" href="#settings" data-toggle="tab">General</a></li>
                  <li class="nav-item"><a id="hrefimageProfiles" class="nav-link" href="#imageProfile" data-toggle="tab">Cambiar foto de perfil</a></li>
                  <li class="nav-item"><a id="hrefpassword" class="nav-link" href="#password" data-toggle="tab">Cambiar contraseña</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">


                  <div class="active tab-pane" id="settings">
                  <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('profile-update', ['profile_id' => $user->user_id])}}" id="form-general">
                    @csrf @method("put")
                    <div class="card-body">
                        <div class="row form-group">
                          <div class="col col-md-6">
                            <label for="exampleInputEmail1">Nombres</label>
                            <input type="text" name="user_name" class="form-control lowercase" id="user_name" placeholder="Nombres del usuario" value="{{old('user_name', $user->user_name ?? '')}}" autocomplete="off" >
                          </div>
                          <div class="col col-md-6">
                            <label for="exampleInputEmail1">Apellidos</label>
                            <input type="text" name="user_surname" class="form-control lowercase" id="user_surname" placeholder="Apellidos del usuario" value="{{old('user_surname', $user->user_surname ?? '')}}" autocomplete="off" >
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-6">
                            <div class="form-group" >
                              <label>N° Identificacion</label>
                              <input type="text" class="form-control lowercase" autocomplete="off" name="user_id_card"  placeholder="Numero de Identificacion" value="{{old('user_id_card', $user->user_id_card ?? '')}}" data-dropdown-css-class="select2-blue" style="width: 100%; color: black" readonly>
                            </div>
                          </div>
                          <div class="col col-md-6">
                            <label for="exampleInputEmail1">Fecha nacimiento</label>
                            <input type="date" name="user_birth_date" class="form-control lowercase" id="user_birth_date" value="{{old('user_birth_date', $user->user_birth_date ?? '')}}" autocomplete="off" >
                          </div>
                        </div>

                        <div class="row form-group">
                          <div class="col col-md-6">
                            <div class="form-group" >
                              <label>Genero</label>
                              <select  class="select form-control" name="user_gender" data-placeholder="Selecciona el genero" value="{{old('')}}" data-dropdown-css-class="select2-blue" style="width: 100%; color: black" required>
                                  <option value="">Genero</option>
                                  @foreach ($genders as $value => $name)
                                
                                        <option value="{{$value}}" @if ($user->user_gender==$value) selected @endif>{{ucwords($name)}}</option>
                                  @endforeach

                              </select>
                            </div>
                          </div>
                          <div class="col col-md-6">
                            <div class="form-group" >
                              <label>N° Telefono</label>
                              <input type="text" class="form-control lowercase" name="user_phone"  placeholder="Numero de Telefono" value="{{old('user_phone', $user->user_phone ?? '')}}" data-dropdown-css-class="select2-blue" autocomplete="off" style="width: 100%; color: black">
                            </div>
                          </div>

                        </div>

                        <div class="row form-group">
                          <div class="col col-md-12">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" name="user_email" class="form-control lowercase" id="user_email" placeholder="E-mail del usuario" value="{{old('user_email', $user->user_email ?? '')}}" autocomplete="off" readonly>
                          </div>
                            <input type="hidden" name="user_state" value="desactive"> 

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary col-md-12">Guardar</button>
                    </div>
                  </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="imageProfile">
                    <div class="row">              
                      <div class="col-md-12  ">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('profile-image-update', ['profile_image' => $user->user_id])}}" id="form-general">
                          @csrf @method("put")
                          <div class="card-body">                                                      
                              <div class="row form-group justify-content-center">

                                  {{-- <input id="base_image_name" type="hidden" value="{{$base->base_image_name}}"> --}}

                                
                                    <div class="col-md-5 text-center">
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
                             
                              </div>

                            </div>  
                            <div class="card-footer justify-content-center">
                              <button type="submit" class="btn btn-primary col-md-12">Guardar</button>
                            </div>  
                          <!-- /.card-body -->
                        </form>
                      </div>
                      <!-- /.card -->
                      </div>

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="password">
                    <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('change-password', ['profile_id' => $user->user_id])}}" id="form-general">
                    @csrf @method("put")
                      <div class="card-body">
                        <div class="form-group">
                          <div class="col col-md-12">
                            <label for="exampleInputEmail1">Contraseña actual</label>
                            <input type="password" name="password" class="form-control lowercase" id="password" placeholder="Contraseña actual" value="{{old('password')}}" autocomplete="off" >
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col col-md-12">
                            <label for="exampleInputEmail1">Contraseña nueva</label>
                            <input type="password" name="new_password" class="form-control lowercase" id="new_password" placeholder="Contraseña nueva" value="{{old('new_password')}}" autocomplete="off" >
                          </div>
                        </div>
                        <div class="form-group">  
                          <div class="col col-md-12">
                            <label for="exampleInputEmail1">Confirmar contraseña</label>
                            <input type="password" name="confirm_new_password" class="form-control lowercase" id="confirm_new_password" placeholder="Confirmar contraseña" value="{{old('password_new_confirm')}}" autocomplete="off" >
                          </div>
                        </div>  
                      </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" disabled="true" id="button-change-password" class="btn btn-primary col-md-12 disabled">Cambiar</button>
                    </div>
                  </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <div class="modal fade remove-background" id="modal-sm-close-session">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Desea cerrar sesion</h4>
              <a href="{{route('profile')}}" type="button" class="close">
                <span aria-hidden="true">&times;</span>
              </a>
            </div>
            <div class="modal-body">
              <p>Para probar tu nueva contraseña</p>
            </div>
            <div class="modal-footer justify-content-between">
              <a href="{{route('profile')}}" type="button" class="btn btn-default">Cancelar</a>
              <a href="{{route('logout')}}" type="button" class="btn btn-primary">Cerrar sesion</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
@endsection