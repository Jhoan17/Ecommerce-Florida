@extends('dsadmin.layout')

@section('title','Usarios')

@section('scripts')

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/user/index.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

@endsection

@section('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
  <link href="{{asset('dsadmin/pages/css/user/index.css')}}" rel="stylesheet">
@endsection


@section('content')

  <section class="content">

<!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Listado de usuarios</strong></h3>
        @csrf
        <div class="card-tools">
          <a href="{{ route('user-create')}}" class="btn btn-block btn-outline-primary">
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
                <table class="table table-striped table-borderedr" id="table-users">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Foto</th>
                      <!--<th>N° Cedula</th>-->
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Email</th>
                      {{-- <th>Telefono</th> --}}
                      <!--<th>Fecha de nacimiento</th>-->
                      <!--<th>Genero</th>-->
                      <th>Rol</th>
                      <th class="text-center">Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td>{{$count++}}</td>
                        <td  class="justify-content-center" style="padding-left: 20px; padding-top: 2px; padding-bottom: 2px;">
                          @if($user->user_image_name == "")
                          <div class="product-image-thumb justify-content-center" style="width: 42px; height: 50px;">
                              <a href="" style="font-size: 24px;  color:#17a2b0"><i class="fa fa-plus-circle"></i></a>
                            </div>
                          @else
                          <div class="product-image-thumb" style="width: 42px; height: 50px; overflow: hidden;">
                            <a href="{{$user->user_image_name}}" data-gallery="user-gallery-{{$user->user_id}}" data-title="{{ucwords($user->user_name)}}({{$user->user_surname}})" data-footer="<a href='{{route('user-image-edit', ['user_id' => $user->user_id])}}' class='btn btn-success' title='Cambiar imagen'><i class='fa fa-exchange-alt'></i></a>" data-toggle="lightbox">
                            <img src="{{$user->user_image_name}}">
                            </a>
                          </div>
                          @endif
                        </td>
                        <td class="align-middle">{{$user->user_name}}</td>
                        <td class="align-middle">{{$user->user_surname}}</td>
                        <td class="align-middle">{{$user->user_email}}</td>
                        {{-- <td class="align-middle">{{$user->user_phone}}</td> --}}
                        <td class="align-middle">{{$user->rol->rol_name}}</td>
                        <td class="text-center align-middle">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            @if($user->user_state == 'desactive')
                            <input type="checkbox" data-url="{{route('user-change-state', ['user_id' => $user->user_id, 'user_state' => $user->user_state])}}" class="custom-control-input change-state" id="{{$user->user_id}}" name="state">
                            @else
                            <input type="checkbox" data-url="{{route('user-change-state', ['user_id' => $user->user_id, 'user_state' => $user->user_state])}}" checked="checked" class="custom-control-input change-state" id="{{$user->user_id}}" name="state">
                            @endif
                            <label class="custom-control-label" for="{{$user->user_id}}"></label>
                          </div>
                        </td>
                        <!--botones de acciones-->
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                          <a href="{{route('user-show', $user)}}" class="btn btn-info user-show" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                          @csrf
                          <a href="{{route('user-edit', ['user_id' => $user->user_id])}}" class="btn btn-success" title="Editar"><i class="fas fa-edit"></i></a>
                          <a href="{{route('user-destroy', ['user_id' => $user->user_id])}}" class="btn btn-danger user-destroy"><i class="fas fa-trash"></i></a>
                        </div>
                      </td><!--Fin botones acciones-->
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
      <div class="modal fade remove-background" id="modal-user-show">
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
