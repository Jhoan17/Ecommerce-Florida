@extends('dsadmin.layout')

@section('title','Permisos')

@section('scripts')

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/permission/index.js')}}"></script>

@endsection

@section('styles')
  <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Permisos</strong></h3>
      <div class="card-tools">
        <a href="{{route('permission-create')}}" class="btn btn-block btn-outline-info">
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
                <table class="table table-striped table-bordered" id="table-permissions">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>slug</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                      <td class="align-middle">{{$count++}}</td>
                      <td class="align-middle">{{$permission->permission_name}}</td>
                      <td class="align-middle">{{$permission->permission_slug}}</td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="{{route('permission-edit', ['permission_id' => $permission->permission_id])}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                          <a href="{{route('permission-destroy', ['permission_id' => $permission->permission_id])}}" class="btn btn-danger permission-destroy"><i class="fas fa-trash"></i></a>
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