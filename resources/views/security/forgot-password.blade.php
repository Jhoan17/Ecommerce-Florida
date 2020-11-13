@extends('dssecurity.layout')

@section('title','clientes')

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

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>JSMT</a>
  </div>
  @if($errors->any())
    <div id="toast-container" class="toast-top-right">  
      @foreach($errors -> all() as $error)
        <div class="toast toast-error toast-time-hide" aria-live="assertive" style="">
          <div class="toast-message">
            {{$error}}
          </div>
        </div>
      @endforeach
    </div>    
  @endif
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">¿Olvidaste tu contraseña? Aquí puede recuperar fácilmente tu cuenta con una nueva contraseña.</p>

      <form action="{{route("send-password")}}" method="post" >
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Pedir nueva contraseña</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.html">Iniciar sesion</a>
      </p>
<!--       <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

@endsection