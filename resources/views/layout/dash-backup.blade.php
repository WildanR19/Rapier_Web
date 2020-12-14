<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Kount</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- nav-menu-mobile -->
        <header class="nav-menu">
            <div class="nav-container">
                <div class="nav-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="nav-logo">
                    <img src="{{ asset('img/Website.svg') }}" class="img-fluid">
                </div>
                <div class="nav-task">
                    <i class="fas fa-ellipsis-v"></i>
                </div>
            </div>
        </header>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar">
            <div class="sidebar-main elevation-4">
                <div class="nav-container">
                    <div class="nav-menu-back">
                        <i class="fas fa-arrow-left"></i>
                    </div>
                </div>
                <div class="text-center d-none d-md-block">
                    <a href="{{ route('dash.home') }}" class="text-center">
                        <img src="{{ asset('img/Website.svg') }}" alt="Website Logo" width="60px">
                    </a>
                </div>
                <div class="sidebar p-0">
                    <div class="text-center">
                        <!-- Brand Logo -->
                        <div class="info">
                            <h5>Hello,</h5>
                            <h4 style="color: #282828;">JessEffendy</h4>
                        </div>
                        <div class="image">
                            <img src="{{ asset('img/dummy-profile-secondary.svg') }}" class="img-circle elevation-2" alt="User Image" width="120px">
                        </div><br>
                        <button class="btn btn-primary">Edit Profile</button>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2 bg-primary">
                        <ul id="navbar" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: #59BECD;">
                            <li class="nav-item">
                                <a href="{{ route('dash.home') }}" class="nav-link">
                                    <p class="text-white">
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dash.projects') }}" class="nav-link">
                                    <p class="text-white">
                                        Projects
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dash.goals') }}" class="nav-link">
                                    <p class="text-white">
                                        Goals
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dash.leave') }}" class="nav-link">
                                    <p class="text-white">
                                        Leave
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dash.teams') }}" class="nav-link">
                                    <p class="text-white">
                                        Teams
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="teamDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <p class="text-white">
                                        Teams
                                    </p>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li class="row my-2">
                                        <div class="col-auto">
                                            <img src="{{ asset('img/dummy-profile.svg') }}" class="img-circle elevation-2" alt="User Image" width="50px">
                                        </div>
                                        <div class="col">
                                            <p>Team</p>
                                            <p>Member 1</p>
                                        </div>
                                    </li>
                                    <li class="row my-2">
                                        <div class="col-auto">
                                            <img src="{{ asset('img/dummy-profile.svg') }}" class="img-circle elevation-2" alt="User Image" width="50px">
                                        </div>
                                        <div class="col">
                                            <p>Team</p>
                                            <p>Member 2</p>
                                        </div>
                                    </li>
                                    <li class="row my-2">
                                        <div class="col-auto">
                                            <img src="{{ asset('img/dummy-profile.svg') }}" class="img-circle elevation-2" alt="User Image" width="50px">
                                        </div>
                                        <div class="col">
                                            <p>Team</p>
                                            <p>Member 3</p>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
            <div class="sidebar-overlay"></div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper px-1 px-sm-3 px-md-5">


            @yield('content')


        </div>
        <!-- /.content-wrapper -->

        <!-- Right Sidebar -->
        <div class="sidenav bg-primary">
            <div class="px-3">
                <div class="date">
                    <div class="row">
                        <div class="col-auto my-auto">
                            <p id="time" style="font-size: 60px;"></p>
                        </div>
                        <div class="col text-center my-auto" style="border-left: solid; border-color: orange; border-width: thin;">
                            <div id="date"></div>
                        </div>
                    </div>
                </div>

                <ul>
                    <li class="mt-4">
                        <h5 class="text-secondary">Notifications</h5>
                        <div class="ongoing-projects">
                            <ul>
                                <li><a href="">2 leave request(s) to approve</a></li>
                                <li><a href="">1 pending project request</a></li>
                            </ul>
                        </div>
                    </li>

                    </li>
                    <li class="mt-5">
                        <h5 class="text-secondary">Ongoing Projects</h5>
                        <ul class="ongoing-projects">
                            <li>
                                <i class="text-secondary">Friday, 09 Oct 2020</i>
                                <ul>
                                    <li><a href="">Road Recruitment to Top 5 Universities</a></li>
                                    <li><a href="">Road Recruitment to Top 10 Universities</a></li>
                                </ul>
                            </li>
                            <li>
                                <i class="text-secondary">Friday, 09 Oct 2020</i>
                                <ul>
                                    <li><a href="">Individual Development Plan Completion (company level)</a></li>
                                    <li><a href="">Group Development Plan Completion (company level)</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <div class="side-setting text-center" style="background-color: #59BECD;">
                <button class="btn text-white">Settings</button>
            </div>
        </div>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
</body>

</html>
