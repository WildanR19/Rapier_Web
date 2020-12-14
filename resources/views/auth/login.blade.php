<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kount</title>

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="text-center">
            <img src="{{ asset('img/logo-with-text.svg') }}" alt="Logo">
        </div>
        <div class="col">
            <div class="card">
                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="title">Member Login</div>
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
</body>
</html>
