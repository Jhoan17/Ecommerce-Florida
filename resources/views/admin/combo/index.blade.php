@extends('dsadmin.layout')

@section('title','combo')

@section('scripts')
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/combo/index.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
@endsection

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
  <style type="text/css">
    .ekko-lightbox-nav-overlay a{
      -webkit-text-stroke: 2px black;
      background-color: rgba(0,0,0,0.1);
      color: #fff;
      font-size: 50px;

    }
  </style>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Listado de combos</strong></h3>
      <div class="card-tools">
        <a href="{{route('combo-create')}}" class="btn btn-block btn-outline-primary">
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
                <table class="table table-striped table-bordered" id="table-combos">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Imagenes</th>
                      <th>Nombre</th>
                      <th>Tipo</th>
                      <th>Precio</th>
                      @if (can('combo-state', false))
                        <th class="text-center">Estado</th>
                      @endif
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <form id="form-image" enctype="multipart/form-data">
                    @foreach($combos as $combo)
                    <tr>
                      <td class="align-middle">{{$count++}}</td>
                      <td class="justify-content-center" style="padding-left: 20px; padding-top: 2px; padding-bottom: 2px;">
                        <div class="row">
                        @php $count_image = 0; @endphp
                        @foreach($combo->comboImages as $combo_image)
                        <div class="product-image-thumb justify-content-center" style="width: 42px; height: 50px; margin: 1px; overflow: hidden;">
                          <a href="{{$combo_image->combo_image_name}}" data-gallery="combo-gallery-{{$combo->combo_id}}" data-title="{{$combo->combo_name}}(${{$combo->combo_sale_price}})" data-footer="<a href='{{route('combo-image-edit', ['combo_image_id' => $combo_image->combo_image_id])}}' class='btn btn-success' title='Cambiar imagen'><i class='fa fa-exchange-alt'></i></a><a href='{{route('combo-image-destroy', ['combo_image_id' => $combo_image->combo_image_id])}}'  class='btn btn-danger combo-destroy' title='Eliminar imagen'><i class='fas fa-trash'></i></a>" data-toggle="lightbox">
                            <img class="combo-image" width="24px" height="32px" src="{{$combo_image->combo_image_name}}">
                          </a>
                         </div>
                         @php $count_image++; @endphp
                        @endforeach
                        @if($count_image < 4)
                          @php $for =  4 - $count_image;  @endphp
                          @for($i = 0; $i < $for; $i++)
                            <div class="product-image-thumb justify-content-center" style="width: 42px; height: 50px; margin: 1px; overflow: hidden;">
                              <a href="{{route('combo-image-create', $combo)}}" style="font-size: 24px; color:#17a2b0"><i class="fa fa-plus-circle"></i></a>
                            </div>
                          @endfor
                        @endif
                        </div>
                      </td>
                      <td class="align-middle">{{$combo->combo_name}}</td>
                      <td class="align-middle">{{$combo->comboType->combo_type_name}}</td>
                      <td class="align-middle">$ {{$combo->combo_sale_price}}</td>
                       @if (can('combo-state', false))
                        <td class="text-center align-middle">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            @if($combo->combo_state == 'desactive')
                              <input type="checkbox" data-url="{{route('combo-change-state', ['combo_id' => $combo->combo_id, 'combo_state' => $combo->combo_state])}}" class="custom-control-input change-state" id="{{$combo->combo_id}}" name="state">
                            @else
                              <input type="checkbox" data-url="{{route('combo-change-state', ['combo_id' => $combo->combo_id, 'combo_state' => $combo->combo_state])}}" checked="checked" class="custom-control-input change-state" id="{{$combo->combo_id}}" name="state">
                            @endif
                            <label class="custom-control-label" for="{{$combo->combo_id}}"></label>
                          </div>
                        </td>
                      @endif
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="{{route('combo-show', $combo)}}" class="btn btn-info combo-show" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                          @csrf
                          <a href="{{route('combo-edit', ['combo_id' => $combo->combo_id])}}" class="btn btn-success" title="Editar"><i class="fas fa-edit"></i></a>
                          @if (can('combo-destroy', false))
                            <a href="{{route('combo-destroy', ['combo_id' => $combo->combo_id])}}" class="btn btn-danger combo-destroy"><i class="fas fa-trash"></i></a>
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
    <div class="modal fade" id="modal-combo-show">
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
