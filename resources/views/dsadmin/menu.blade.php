{{-- {{dd($menusComposer)}} --}}
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin')}}" class="brand-link">
      <img src="{{asset('dsadmin/images/logo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">JSMT-Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{$userImage}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route("profile")}}" class="d-block">{{ucwords(session('user_name'))}} ({{session('rol_name')}})</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @foreach($menusComposer as $key => $item)
            @if(count($item) == 0)
              @break
            @endif            
            @include("dsadmin.menu-item", ["item"=>$item])
          @endforeach                 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>