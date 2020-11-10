<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="{{asset('dsadmin/images/favicon.png')}}" rel="icon" type="image/x-icon"/>
  <title> JSMT-Tienda | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dsadmin/dist/css/adminlte.min.css')}}">
  <!-- Plugins de notificaciones -->
  <link rel="stylesheet" href="{{asset('dsadmin/plugins/toastr/toastr.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  @yield('styles')

</head>
<body class="hold-transition login-page">

    @yield('content')



  <!-- jQuery -->
  <script src="{{asset('dsadmin/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('dsadmin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dsadmin/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dsadmin/dist/js/demo.js')}}"></script>

  <script src="{{asset('dsadmin/pages/custom.js')}}"></script>
  
{{--   <script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
  </script> --}}
  <!-- Scrips para desaparecer las notificaciones -->

  @yield('scripts')

</body>