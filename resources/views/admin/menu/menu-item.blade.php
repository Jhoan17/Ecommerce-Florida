@if ($item["submenu"] == [])
<li class="dd-item dd3-item" data-id="{{$item["menu_id"]}}">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content {{$item["menu_url"] == "javascript:;" ? "font-weight-bold" : ""}}">
        <a href="{{route("menu-edit", ['menu_id' => $item["menu_id"]])}}">{{ $item["menu_name"] }} <i style="font-size:20px;" class="fa fa-fw {{isset($item["menu_icon"]) ? $item["menu_icon"] : ""}}"></i></a>
        <a href="{{route('menu-delete', ['menu_id' => $item["menu_id"]])}}" class="eliminar-menu tooltipsC float-right" title="Eliminar este menú"><i class="text-danger fa fa-trash-alt"></i></a>
    </div>
</li>
@else
<li class="dd-item dd3-item" data-id="{{$item["menu_id"]}}">
    <div class="dd-handle dd3-handle"></div>
    <div class="dd3-content {{$item["menu_url"] == "javascript:;" ? "font-weight-bold" : ""}}">
        <a href="{{route("menu-edit", ['menu_id' => $item["menu_id"]])}}">{{ $item["menu_name"] }} <i style="font-size:20px;" class="fa fa-fw {{isset($item["menu_icon"]) ? $item["menu_icon"] : ""}}"></i></a>
        <a href="{{route('menu-delete', ['menu_id' => $item["menu_id"]])}}" class="eliminar-menu tooltipsC float-right" title="Eliminar este menú"><i class="text-danger fa fa-trash-alt"></i></a>
    </div>
    <ol class="dd-list">
        @foreach ($item["submenu"] as $submenu)
        @include("admin.menu.menu-item",[ "item" => $submenu ])
        @endforeach
    </ol>
</li>
@endif