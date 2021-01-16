<nav class="navbar navbar-expand navbar-white navbar-light fixed-top">
    <!-- Left navbar links -->
    <a class="navbar-brand" href="{{ route('dash.home') }}">
        <img src="{{ asset('img/logo-with-text.svg') }}" width="120" class="d-inline-block align-top" alt="" loading="lazy">
    </a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block my-auto">
        <p class="text-primary text-lg">{{ date('D, j M Y') }} <span class="border-right mr-1" style="border-color: #FFC045 !important;">&nbsp;</span> {{ date('H:i')}}</p>
      </li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto my-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link py-1" data-toggle="dropdown" href="#">
                <i class="far fa-bell text-primary fa-2x"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('dash.notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link py-1" href="{{ route('dash.settings') }}"><i class="fas fa-cog text-primary fa-2x"></i></a>
        </li> --}}
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