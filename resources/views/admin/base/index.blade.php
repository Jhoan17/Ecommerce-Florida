@extends('dsadmin.layout')

@section('title','Base')

@section('scripts')

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/base/index.js')}}"></script>

@endsection

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
  <link href="{{asset("dsadmin/pages/css/base/index.css")}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Listado de Bases</strong></h3>
      <div class="card-tools">
        <a href="{{route('base-create')}}" class="btn btn-block btn-outline-primary">
          <i class="fas fa-plus"></i> Agregar
        </a>
      </div>
    </div>
    <div class="card-body">
      @include('includes.messages')
      <div class="row">
          <div class="col-12">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <br>
                <table class="table table-striped table-bordered" id="table-bases">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Imagenes</th>
                      <th>Nombre</th>
                      <th>Medidas</th>
                      <th>Precio</th>
                      @if (can('base-state', false))
                        <th class="text-center">Estado</th>
                      @endif
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <form id="form-image" enctype="multipart/form-data">
                    @foreach($bases as $base)
                    <tr>
                      <td class="align-middle">{{$count++}}</td>
                      <td class="justify-content-center" style="padding-left: 20px; padding-top: 2px; padding-bottom: 2px;">
                        <div class="row">
                        @php $count_image = 0; @endphp
                        @foreach($base->baseImages as $base_image)
                        <div class="product-image-thumb justify-content-center" style="width: 42px; height: 50px; margin: 1px; overflow: hidden;">
                          <a href="{{$base_image->base_image_name}}" data-gallery="base-gallery-{{$base->base_id}}" data-title="{{$base->base_name}}({{$base->base_measure}})" data-footer="<a href='{{route('base-image-edit', ['base_image_id' => $base_image->base_image_id])}}' class='btn btn-success' title='Cambiar imagen'><i class='fa fa-exchange-alt'></i></a> @if (can('base-image-destroy', false)) <a href='{{route('base-image-destroy', ['base_image_id' => $base_image->base_image_id])}}'  class='btn btn-danger base-destroy' title='Eliminar imagen'><i class='fas fa-trash'></i></a>@endif" data-toggle="lightbox">
                            <img class="base-image" width="24px" height="32px" src="{{$base_image->base_image_name}}">
                          </a>
                         </div>
                         @php $count_image++; @endphp
                        @endforeach
                        @if($count_image < 4)
                          @php $for =  4 - $count_image;  @endphp
                          @for($i = 0; $i < $for; $i++)
                            <div class="product-image-thumb justify-content-center" style="width: 42px; height: 50px; margin: 1px">
                              <a href="{{route('base-image-create', $base)}}" style="font-size: 24px; color:#17a2b0"><i class="fa fa-plus-circle"></i></a>
                            </div>
                          @endfor
                        @endif
                        </div>
                      </td>
                      <td class="align-middle">{{$base->base_name}}</td>
                      <td class="align-middle">{{$base->base_measure}}</td>
                      <td class="align-middle">$ {{$base->base_price}}</td>
                   @if (can('base-state', false))
                      <td class="text-center align-middle">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          @if($base->base_state == 'desactive')
                            <input type="checkbox" data-url="{{route('base-change-state', ['base_id' => $base->base_id, 'base_state' => $base->base_state])}}" class="custom-control-input change-state" id="{{$base->base_id}}" name="state">
                          @else
                            <input type="checkbox" data-url="{{route('base-change-state', ['base_id' => $base->base_id, 'base_state' => $base->base_state])}}" checked="checked" class="custom-control-input change-state" id="{{$base->base_id}}" name="state">
                          @endif
                          <label class="custom-control-label" for="{{$base->base_id}}"></label>
                        </div>
                      </td>
                    @endif
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="{{route('base-show', $base)}}" class="btn btn-info base-show" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                          @csrf
                          <a href="{{route('base-edit', ['base_id' => $base->base_id])}}" class="btn btn-success" title="Editar"><i class="fas fa-edit"></i></a>
                          @if (can('base-destroy', false))
                            <a href="{{route('base-destroy', ['base_id' => $base->base_id])}}" class="btn btn-danger base-destroy"><i class="fas fa-trash"></i></a>
                          @endif
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </form>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
        </div>
    </div>
    <div class="modal fade" id="modal-base-show">
      <!-- /.modal-dialog -->
    </div>
    <div class="card-footer">
      {{-- Footer --}}
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->


</section>

@endsection
