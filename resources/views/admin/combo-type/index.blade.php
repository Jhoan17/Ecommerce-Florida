@extends('dsadmin.layout')

@section('title','Tipo de combo')

@section('scripts')

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/combo-type/index.js')}}"></script>

@endsection

@section('styles')
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Tipos de combo</strong></h3>
    </div>
    <div class="card-body">
      @include('includes.messages')
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado</h3>
                <div class="card-tools">
                  <a href="{{route('combo-type-create')}}" class="btn btn-block btn-outline-info">
                    <i class="fas fa-plus"></i> Agregar
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <br>
                <table class="table table-hover text-nowrap" id="table-combo-types">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($combo_types as $combo_type)
                    <tr>
                      <td>{{$count++}}</td>
                      <td>{{$combo_type->combo_type_name}}</td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="{{route('combo-type-edit', ['combo_type_id' => $combo_type->combo_type_id])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                          @if (can('combo-type-destroy', false))
                            <a href="{{route('combo-type-destroy', ['combo_type_id' => $combo_type->combo_type_id])}}" class="btn btn-danger combo-type-destroy"><i class="fas fa-trash"></i></a>
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
