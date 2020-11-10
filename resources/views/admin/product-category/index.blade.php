@extends('dsadmin.layout')

@section('title','Tipo de producto')

@section('scripts')

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/product-category/index.js')}}"></script>

@endsection

@section('styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Categorias de producto</strong></h3>
    </div>
    <div class="card-body">
      @include('includes.messages')
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado</h3>
                <div class="card-tools">
                  <a href="{{route('product-category-create')}}" class="btn btn-block btn-outline-info">
                    <i class="fas fa-plus"></i> Agregar
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <br>
                <table class="table table-hover text-nowrap" id="table-product-categories">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($product_categorys as $product_category)
                    <tr>
                      <td>{{$count++}}</td>
                      <td>{{$product_category->product_category_name}}</td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="{{route('product-category-edit', ['product_category_id' => $product_category->product_category_id])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                          @if (can('product-category-destroy', false))
                            <a href="{{route('product-category-destroy', ['product_category_id' => $product_category->product_category_id])}}" class="btn btn-danger product-category-destroy"><i class="fas fa-trash"></i></a>
                          @endif
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
    <div class="modal fade" id="modal-product-show">
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
