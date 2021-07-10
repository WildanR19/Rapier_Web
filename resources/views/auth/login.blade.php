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

    <style>
        .login-logo{
            color: #FF5722;
        }
        .form-control {
          background: #fff;
          border: none;
          height: 50px;
          border: 1px solid transparent;
          border-radius: 40px;
          padding-left: 20px;
          padding-right: 20px;
          -webkit-transition: 0.3s;
          -o-transition: 0.3s;
          transition: 0.3s;
      }
      .btn-primary {
        color: #fff;
        background-color: #ff3f05 !important;
        border-color: #ff3f05 !important;
      }
      .icheck-primary > input:first-child:checked + label::before, .icheck-primary > input:first-child:checked + input[type="hidden"] + label::before {
          background-color: #ff3f05;
          border-color: #ff3f05;
      }
    </style>
</head>
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
        <form action="{{ route('login') }}" method="post">
        @csrf
          <div class="form-group">
            <input type="email" class="form-control shadow" placeholder="Email" name="email" :value="old('email')" required autofocus>
          </div>
          <div class="form-group">
            <input type="password" class="form-control shadow" placeholder="Password" name="password">
          </div>
          <div class="form-group icheck-primary icheck-inline">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">
              Remember Me
            </label>
          </div>
          <div class="form-group mt-2">
            <button type="submit" class="form-control btn btn-primary btn-block">Sign In</button>
          </div>
        </form>
        
      </div>
</body>
</html>
