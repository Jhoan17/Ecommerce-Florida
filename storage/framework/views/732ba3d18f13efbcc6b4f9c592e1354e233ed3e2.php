<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="<?php echo e(asset('dsadmin/images/favicon.png')); ?>" rel="icon" type="image/x-icon"/>
  <title> JSMT-Tienda | <?php echo $__env->yieldContent('title'); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('dsadmin/dist/css/adminlte.min.css')); ?>">
  <!-- Plugins de notificaciones -->
  <link rel="stylesheet" href="<?php echo e(asset("dsadmin/plugins/toastr/toastr.min.css")); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <?php echo $__env->yieldContent('styles'); ?>

</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php echo $__env->make('dsadmin/navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('dsadmin/menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="content-wrapper">
      <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->make('dsadmin/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
  </div>


  <!-- jQuery -->
  <script src="<?php echo e(asset('dsadmin/plugins/jquery/jquery.min.js')); ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo e(asset('dsadmin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo e(asset('dsadmin/dist/js/adminlte.min.js')); ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo e(asset('dsadmin/dist/js/demo.js')); ?>"></script>

  <script src="<?php echo e(asset('dsadmin/pages/custom.js')); ?>"></script>
  <script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
  </script>
  <!-- Scrips para desaparecer las notificaciones -->

  <?php echo $__env->yieldContent('scripts'); ?>

</body><?php /**PATH C:\laragon\www\dulcesorpresa\resources\views/dsadmin/layout.blade.php ENDPATH**/ ?>