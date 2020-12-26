@extends('layout.dash')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
    body{
        background-color: #f4f6f9;
    }
    @media (min-width: 768px){
        .container .col .card {
            width: 100%;
        }
    }
    .card {
        box-shadow: 0 0;
        margin-bottom: 1rem;
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
<div id="payslip">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0 text-dark">Payslip</h1> --}}
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content" id="inputPassword">
        <div class="container">
            <div class="col">
                <div class="card">
                    <div class="title">Enter Your Password to Continue</div>
                    <form action="{{ route('dash.payslip.content') }}">
                        <div class="form-group">
                            <label for="login-password"><i class="fas fa-lock"></i></label>
                            <input type="password" name="login-password" id="login-password" placeholder="Password">
                        </div>
                
                        <button type="submit" class="btn-login"><em>Open Payslip</em></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection
