@extends('dsadmin.layout')

@section('title','clientes')

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset("dsadmin/plugins/jquery-nestable/jquery.nestable.js")}}" type="text/javascript"></script>
    <script src="{{asset('dsadmin/pages/scripts/menu/index.js')}}"></script>

@endsection

@section('styles')

  <link  rel="stylesheet" href="{{asset("dsadmin/plugins/jquery-nestable/jquery.nestable.css")}}">

@endsection


@section('content')
<section class="content">
    @include('includes.messages')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><strong>Menu</strong></h3>
            <div class="card-tools">
                <a href="{{route('menu-create')}}" class="btn btn-block btn-outline-primary">
                <i class="fas fa-plus"></i> Agregar
                </a>
            </div>
        </div>
        <div class="card-body col-lg-12">
            <br>
            @csrf
            <div class="dd" id="nestable">
                <ol class="dd-list">
                    @foreach ($menus as $key => $item)
                        @if ($item["menu_type"] != 0)
                        @break
                        @endif
                        @include("admin.menu.menu-item",["item" => $item])
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection
