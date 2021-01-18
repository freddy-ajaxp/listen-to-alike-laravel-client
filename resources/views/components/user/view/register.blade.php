@extends('components.user.layouts.default')
@section('title', __('Register'))
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

    <div class="register-box" style="background:white">
            @include('components/user/components/messages')

        <div class="register-logo">
            <a href="/landing"><b>Register</b>Account</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body" >
                <p class="login-box-msg">Register a new membership</p>

                <form action="user/register" method="post" id="form-register">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input required type="text" class="form-control" name="name" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input required type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input required type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input required type="password" class="form-control" name="confirmPassword" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <a href="/login" class="text-center">already have account</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    </div>
</body>
@endsection


@push('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ asset('assets/js/form-validation.js') }}"></script> -->
@endpush
