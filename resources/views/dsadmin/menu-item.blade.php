@if ($item["submenu"] == [])

    <li class="nav-item has-treeview">
        <a href="{{url($item['menu_url'])}}" class="nav-link {{getMenuActive($item["menu_url"])}}">
            <i class="nav-icon fa {{$item["menu_icon"]}}"></i>
            <p>
                {{ucfirst($item["menu_name"])}}
                @if($item["menu_name"]=="todas las ordenes")
                    <span class="badge badge-info right">{{$countOrders}}</span>
                @endif
            </p>
        </a>
    </li>
@else
    <li class="nav-item has-treeview">
        <a href="javascript:;" class="nav-link">
          <i class="nav-icon fa {{$item["menu_icon"]}}"></i>
          <p>
            {{ucfirst($item["menu_name"])}}
            <i class="right fas fa-angle-left"></i>
            @if($item["menu_name"]=="todas las ordenes")
                <span class="badge badge-info right">{{$countOrders}}</span>
            @endif
          </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach ($item["submenu"] as $submenu)
                @include("dsadmin.menu-item", ["item" => $submenu])
            @endforeach
        </ul>
    </li>
@endif