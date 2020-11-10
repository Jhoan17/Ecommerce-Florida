  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route("profile")}}" class="nav-link">Mi perfil</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
{{--       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> --}}
      <!-- Notifications Dropdown Menu -->
      {{-- {{Carbon\Carbon::now()->yesterday()->format("Y-m-d h:i A")}} --}}

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge count-notification">{{$countNotifications}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <audio id="notifiable-sound">
            <source src="{{asset('dsadmin/audios/notifiable1.mp3')}}" type="audio/wav">
          </audio>
          <input type="hidden" id="push-url" value="{{route('notification-push',['timestamp'=> "" ])}}">
          <input type="hidden" id="input-count-notification" value="{{$countNotifications}}">
          <span class="dropdown-item dropdown-header "><span class="count-notification">{{$countNotifications}}</span> Notificaciones</span>
          <div id="desc-notifications">
            @foreach($userNotifications as $notification)
            <div class="dropdown-divider"></div>
              <a href="{{ route('notification-read',['notification_id'=>$notification->notifiable_id]) }}"  class="dropdown-item">
                <i class="fa fa-sort-amount-up mr-2"></i>Nueva @if( $notification->notifiable_type == "order") Orden @else Sugerencia @endif
                <span class="float-right text-muted text-sm">
                  @php

                    setlocale(LC_TIME,"es_CO");
                    $data_ac = Carbon\Carbon::now();
                    $data_db = explode(" ", Carbon\Carbon::parse($notification->created_at)->format('Y-m-d h:i A'));
                    
                  @endphp
                  @if($data_ac->format("Y-m-d") == $data_db[0])
                    Hoy, {{$data_db[1]." ".$data_db[2]}}
                  @elseif($data_ac->yesterday()->format("Y-m-d") == $data_db[0])
                    Ayer, {{$data_db[1]." ".$data_db[2]}}
                  @else

                    {{ strftime("%a", strtotime( $data_db[0] )) }} a las {{$data_db[1]." ".$data_db[2]}}

                  @endif

                </span>
              </a>
            @endforeach
          </div>

{{--           <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-list-alt mr-2"></i> 3 Sugerencias nuevas
            <span class="float-right text-muted text-sm">1 min</span>
          </a> --}}
{{--           <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a> --}}
          {{-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="{{route('logout')}}" >
          <i class="fas fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>
  
  <!-- /.navbar -->