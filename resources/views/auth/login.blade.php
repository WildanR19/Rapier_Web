<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rapier Tech</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> --}}

    <style>
        .card-primary.card-outline {
            border-top: 3px solid #FF5722;
        }
        .login-logo{
            color: #FF5722;
        }
    </style>
</head>
{{-- <body>
    <div class="container">
        <div class="col">
            <div class="card">
                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="title"><h3 class="font-weight-bold">Sign In</h3></div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="login-email"><i class="fas fa-envelope"></i></label>
                        <input type="email" name="email" :value="old('email')" required autofocus placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="login-password"><i class="fas fa-lock"></i></label>
                        <input type="password" name="password" required autocomplete="current-password" placeholder="Password">
                    </div>
                    <div class="form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <button type="submit" class="btn-login"><em>Log In</em></button>
                </form>
            </div>
        </div>
    </div>
</body> --}}
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <h1 class="font-weight-bold">Sign In</h1>
        </div>
        <x-jet-validation-errors class="mb-4" />
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="card card-outline card-primary">
          <div class="card-body">
            <form action="{{ route('login') }}" method="post">
            @csrf
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" :value="old('email')" required autofocus>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</body>
</html>
