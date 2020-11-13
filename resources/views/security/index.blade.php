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
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar sesion</p>
        @if($errors->any())
        <div id="toast-container" class="toast-top-right">  
          {{-- {{dd($errors->messages)}} --}}
          @foreach($errors -> all() as $error)

            <div class="toast toast-error toast-time-hide" aria-live="assertive" style="">
              <div class="toast-message">
                {{$error}}
              </div>
            </div>
          @endforeach
        </div>    
      @endif
      @include('includes.messages')
      <form action="{{ route('login-post') }}" method="post" autocomplete="off">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="user_id_card" class="form-control" placeholder="Cedula o pasaporte" value="{{old('user_id_card')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Contraseña" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4 offset-4">
            <button type="submit" class="btn btn-primary btn-block">Iniciar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

{{--       <div class="social-auth-links text-center mb-3">
        <p>- O -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Iniciar con Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Iniciar con Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->
      <br>
      <p class="mb-1 col-12 text-center">
        <a href="{{route("forgot-password")}}">No recuerdo mi contraseña?</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center"></a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection
