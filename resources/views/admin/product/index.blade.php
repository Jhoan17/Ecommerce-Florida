@extends('dsadmin.layout')

@section('title','Producto')

@section('scripts')
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/product/index.js')}}"></script>
@endsection

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
@endsection


@section('content')

  <section class="content">

<!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Lista de los productos</strong></h3>
        <div class="card-tools">
          <a href="{{route('product-create')}}" class="btn btn-block btn-outline-primary">
            <i class="fas fa-plus"></i> Agregar
          </a>
        </div>
      </div>
      <div class="card-body">
      @include('includes.messages')
        <div class="row">
          <div class="col-12">
            <div class="card-body table-responsive p-0">
              <br>
              <table class="table table-striped table-bordered" id="table-products">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Categorias</th>
                    <th>C. Neto</th>
                    <th>Precio</th>
                    @if (can('base-state', false))
                      <th class="text-center">Estado</th>
                    @endif
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td class="align-middle">{{$count++}}</td>
                      <td  class="justify-content-center" style="padding-left: 20px; padding-top: 2px; padding-bottom: 2px;">
                        @if($product->product_image_name == "")
                        <div class="product-image-thumb justify-content-center" style="width: 42px; height: 50px;">
                            <a href="{{route('product-image-edit', ['product_id' => $product->product_id])}}" style="font-size: 24px;  color:#17a2b0"><i class="fa fa-plus-circle"></i></a>
                          </div>
                        @else
                        <div class="product-image-thumb" style="width: 42px; height: 50px; overflow: hidden;">
                          <a href="{{$product->product_image_name}}" data-gallery="product-gallery-{{$product->product_id}}" data-title="{{ucwords($product->product_name)}}({{$product->product_net_content}})" data-footer="<a href='{{route('product-image-edit', ['product_id' => $product->product_id])}}' class='btn btn-success' title='Cambiar imagen'><i class='fa fa-exchange-alt'></i></a>" data-toggle="lightbox">
                          <img src="{{$product->product_image_name}}">
                          </a>
                        </div>
                        @endif
                      </td>
                      <td class="align-middle">{{$product->product_name}}</td>
                      <td class="align-middle">{{$product->product_trademark}}</td>
                      <td class="align-middle">@foreach($product->productCategory as $product_category){{$product_category->product_category_name}} @endforeach</td>
                      <td class="align-middle">{{$product->product_net_content}}</td>
                      <td class="align-middle">$ {{$product->product_price}}</td>
                      @if (can('product-state', false))
                        <td class="text-center align-middle">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          @if($product->product_state == 'desactive')
                          <input type="checkbox" data-url="{{route('product-change-state', ['product_id' => $product->product_id, 'product_state' => $product->product_state])}}" class="custom-control-input change-state" id="{{$product->product_id}}" name="state">
                          @else
                          <input type="checkbox" data-url="{{route('product-change-state', ['product_id' => $product->product_id, 'product_state' => $product->product_state])}}" checked="checked" class="custom-control-input change-state" id="{{$product->product_id}}" name="state">
                          @endif
                          <label class="custom-control-label" for="{{$product->product_id}}"></label>
                        </div>
                      </td>
                    @endif
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                        <a href="{{route('product-show', $product)}}" class="btn btn-info product-show" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                        @csrf
                        <a href="{{route('product-edit', ['product_id' => $product->product_id])}}" class="btn btn-success" title="Editar"><i class="fas fa-edit"></i></a>
                        @if (can('product-destroy', false))
                          <a href="{{route('product-destroy', ['product_id' => $product->product_id])}}" class="btn btn-danger product-destroy"><i class="fas fa-trash"></i></a>
                        @endif
                      </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-product-show">
      <!-- /.modal-dialog -->
      </div>
      <div class="card-footer">
        Hay <strong>{{$count_products}}</strong> productos registrados
      </div>
<!-- /.card-footer-->
  </div>
<!-- /.card -->
</section>

@endsection
