@extends('components.user.layouts.default')
@section('title', __('Login'))
@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/adminlte.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome-free/css/all.min.css') }}">
@endpush


@section('content')
<body class="hold-transition login-page" style="background-image: url('images/background.jpg');
                background-size: cover;
              background-position: center center;
              background-attachment: fixed;">

    <div class="login-box" style="background:white">
        @include('components/user/components/messages')
        <div class="login-logo">
            <a href="/landing"><b>Login </b>Shorten</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to continue</p>

                <form action="user/login" method="post" id="form-login">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input required type="email" class="form-control" name="email" id="email" placeholder="Email" au>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input required type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <a href="/register" class="text-center">Register</a>
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
        </div>
    </div>
    </div>
</body>
@endsection


@push('javascript')
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ asset('assets/js/form-validation.js') }}"></script> -->
@endpush
