@extends('dsadmin.layout')

@section('title','Admin')

@section('content')

<section class="content">

  <!-- Default box -->
  @include('includes.form-error')
  @include('includes.messages')
  @include('includes.messages-error')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Inicio</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
      Bienvenido a tu programa de administración
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Creado por JSMT 
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

@endsection