<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
          <a class="nav-link py-1" data-toggle="dropdown" href="#">
              <i class="far fa-bell text-primary fa-2x"></i>
              @if (auth()->user()->unreadNotifications->count() > 0)
              <span class="badge badge-warning navbar-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
              @endif
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">{{ auth()->user()->unreadNotifications->count() }}
                  Notifications</span>
              @if (auth()->user()->role->name == 'Admin')
              @foreach(auth()->user()->unreadNotifications as $notification)
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                  <div class="media">
                      <i class="fas fa-calendar-times fa-2x mr-3 my-auto"></i>
                      <div class="media-body">
                          <p>
                              <span class="text-capitalize">{{ $notification->data['notification_type'] }}</span>
                              Request By {{ substr($notification->data['user'] ,0,8) }}...
                          </p>
                          <p class="text-muted text-sm"><i class="far fa-clock mr-1"></i>
                              {{ $notification->created_at->diffForHumans() }}</p>
                      </div>
                  </div>
              </a>
              @endforeach
              @if (auth()->user()->unreadNotifications->count() != 0)
              <div class="dropdown-divider"></div>
              <a href="{{ route('dash.notifications') }}" class="dropdown-item dropdown-footer">See All
                  Notifications</a>
              @endif
              @endif
              @if (auth()->user()->role->name == 'Employee')
              @foreach(auth()->user()->unreadNotifications as $notification)
              <div class="dropdown-divider"></div>
              <a href="{{ route('dash.leave') }}" class="dropdown-item">
                  <div class="media">
                      <i class="fas fa-calendar-times fa-2x mr-3 my-auto"></i>
                      <div class="media-body">
                          @php
                          if($notification->data['notification_type'] == 'leave_accept'){
                          $leaveStatus = 'Accepted';
                          $color = 'success';
                          }else{
                          $leaveStatus = 'Rejected';
                          $color = 'danger';
                          }
                          @endphp
                          <p>Your leave has been <span class="text-{{ $color }}">{{ $leaveStatus }}</span> by
                              {{ $notification->data['user'] }}
                          </p>
                          <p class="text-muted text-sm"><i class="far fa-clock mr-1"></i>
                              {{ $notification->created_at->diffForHumans() }}</p>
                      </div>
                  </div>
              </a>
              @endforeach
              @endif
          </div>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link py-1" href="#" id="navbarDropdown" data-toggle="dropdown">
            <img class="rounded-circle nav-img" src="{{ Auth::user()->profile_photo_url }}"
                alt="{{ Auth::user()->name }}" />
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('dash.profile') }}"><i class="fas fa-user"></i> Profile</a>
            <div class="dropdown-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </form>
        </div>
    </li>
    </ul>
</nav>