@extends('dsadmin.layout')

@section('title','permiso-rol')

@section('scripts')

  	<script src="{{asset('dsadmin/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
    <script src="{{asset('dsadmin/pages/scripts/permission-rol/index.js')}}"></script>

@endsection

@section('styles')

  <link  rel="stylesheet" href="{{asset("dsadmin/plugins/toastr/toastr.css")}}">
  <link  rel="stylesheet" href="{{asset("dsadmin/pages/css/permission-rol/index.css")}}">

@endsection


@section('content')
<section class="content">
	<div class="card">
        <div class="card-header">
            <h3 class="card-title"><strong>Permiso - Rol</strong></h3>
        </div>
        <div class="card-body table-responsive p-0">
            @csrf
            <table class="table table-striped table-bordered table-hover" id="tabla-data">
                <thead>
                    <tr>
                        <th>Permisos</th>
                        @foreach ($rols as $id => $nombre)
                        <th class="text-center">{{$nombre}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $key => $permission)
                        <tr>
                            <td> {{$permission["permission_name"]}}</td>
                            @foreach($rols as $id => $nombre)

                                <td class="text-center">
                                    <input
                                    type="checkbox"
                                    class="permission_rol"
                                    name="permission_rol[]"
                                    data-permissionid={{$permission[ "permission_id"]}}
                                    value="{{$id}}" {{in_array($id, array_column($permissionsRols[$permission["permission_id"]], "rol_id"))? "checked" : ""}}>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection