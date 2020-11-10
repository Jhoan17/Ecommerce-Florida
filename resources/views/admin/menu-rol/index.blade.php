@extends('dsadmin.layout')

@section('title','menu-rol')

@section('scripts')

  	<script src="{{asset('dsadmin/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
    <script src="{{asset('dsadmin/pages/scripts/menu-rol/index.js')}}"></script>

@endsection

@section('styles')

  <link  rel="stylesheet" href="{{asset("dsadmin/plugins/toastr/toastr.css")}}">
  <link  rel="stylesheet" href="{{asset("dsadmin/pages/css/menu-rol/index.css")}}">

@endsection


@section('content')
<section class="content">
	<div class="card">
        <div class="card-header">
            <h3 class="card-title"><strong>Menús - Rol</strong></h3>
        </div>
        <div class="card-body table-responsive p-0">
            @csrf
            <table class="table table-striped table-bordered table-hover" id="tabla-data">
                <thead>
                    <tr>
                        <th>Menú</th>
                        @foreach ($rols as $id => $nombre)
                        <th class="text-center">{{$nombre}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $key => $menu)
                    @if ($menu["menu_type"] != 0)
                        @break
                    @endif
                        <tr>
                            <td class="font-weight-bold"><i class="fa fa-arrows-alt"></i> {{$menu["menu_name"]}}</td>
                            @foreach($rols as $id => $nombre)

                                <td class="text-center">
                                    <input
                                    type="checkbox"
                                    class="menu_rol"
                                    name="menu_rol[]"
                                    data-menuid={{$menu[ "menu_id"]}}
                                    value="{{$id}}" {{in_array($id, array_column($menusRols[$menu["menu_id"]], "rol_id"))? "checked" : ""}}>
                                </td>
                            @endforeach
                        </tr>
                        @foreach($menu["submenu"] as $key => $son)
                            <tr>
                                <td class="pl-40"><i class="fa fa-arrow-right"></i> {{ $son["menu_name"] }}</td>
                                @foreach($rols as $id => $nombre)
                                    <td class="text-center">
                                        <input
                                        type="checkbox"
                                        class="menu_rol"
                                        name="menu_rol[]"
                                        data-menuid={{$son[ "menu_id"]}}
                                        value="{{$id}}" {{in_array($id, array_column($menusRols[$son["menu_id"]], "rol_id"))? "checked" : ""}}>
                                    </td>
                                @endforeach
                            </tr>
                            @foreach ($son["submenu"] as $key => $son2)
                                <tr>
                                    <td class="pl-30"><i class="fa fa-arrow-right"></i> {{$son2["menu_name"]}}</td>
                                    @foreach($rols as $id => $nombre)
                                        <td class="text-center">
                                            <input
                                            type="checkbox"
                                            class="menu_rol"
                                            name="menu_rol[]"
                                            data-menuid={{$son2[ "menu_id"]}}
                                            value="{{$id}}" {{in_array($id, array_column($menusRols[$son2["menu_id"]], "rol_id"))? "checked" : ""}}>
                                        </td>
                                    @endforeach
                                </tr>
                                @foreach ($son2["submenu"] as $key => $son3)
                                    <tr>
                                        <td class="pl-40"><i class="fa fa-arrow-right"></i> {{$son3["menu_name"]}}</td>
                                        @foreach($rols as $id => $nombre)
                                        <td class="text-center">
                                            <input
                                            type="checkbox"
                                            class="menu_rol"
                                            name="menu_rol[]"
                                            data-menuid={{$son3[ "menu_id"]}}
                                            value="{{$id}}" {{in_array($id, array_column($menusRols[$son3["menu_id"]], "rol_id"))? "checked" : ""}}>
                                        </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection