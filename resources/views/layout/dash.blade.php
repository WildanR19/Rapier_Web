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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kount</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- Sweet Alert -->
    <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- nav-menu-mobile -->
        {{-- <header class="nav-menu">
            <div class="nav-container">
                <div class="nav-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="nav-logo">
                    <img src="{{ asset('img/logo-with-text.svg') }}">
                </div>
                <div class="ml-auto">
                    <div class="nav-item dropdown">
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
                                <a href="#" class="btn btn-primary">See all</a>
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
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('dash.settings') }}"><i class="fas fa-cog text-primary"></i></a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="#"><img src="{{ asset('img/dummy-profile-secondary.svg') }}" class="img-circle elevation-2" alt="User Image" width="30px"></a>
                    </div>
                </div>
            </div>
        </header> --}}

        <!-- Main Sidebar Container -->
        @include('layout.nav')
        @include('layout.navigation-bar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper px-1 px-sm-3 px-md-5">
            @include('sweetalert::alert')
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
</body>

</html>
