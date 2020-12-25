<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dash.home') }}">
            <img src="{{ asset('img/logo-with-text.svg') }}" width="100" height="20" class="d-inline-block align-top" alt="" loading="lazy">
        </a>
        
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <h5 class="text-primary ml-4" id="date"></h5>
            <span class="border-right ml-1" style="border-color: #FFC045 !important;">&nbsp;</span>
            <h5 class="ml-2" id="time"></h5>
            
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="far fa-bell text-primary fa-2x"></i>
                        <span class="badge badge-warning navbar-badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-4" aria-labelledby="navbarDropdown">
                        <h5>Notifications</h5>
                        <ul>
                            <li>2 leave request(s) to approve</li>
                            <li>2 leave request(s) to approve</li>
                        </ul>
                        <div class="col text-center my-4">
                            <a href="{{ route('dash.notifications') }}" class="btn btn-primary">See all</a>
                        </div>
                        <h5>Ongoing Project</h5>
                        <p class="mt-2">Monday, 09 Nov 2020</p>
                        <ul>
                            <li>2 leave request(s) to approve</li>
                        </ul>
                        <p class="mt-2">Tuesday, 01 Dec 2020</p>
                        <ul>
                            <li>2 leave request(s) to approve</li>
                        </ul>
                        <div class="col text-center mt-4">
                            <a href="{{ route('dash.notifications') }}" class="btn btn-primary">See all</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dash.settings') }}"><i class="fas fa-cog text-primary fa-2x"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle nav-img" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();">Logout</a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>