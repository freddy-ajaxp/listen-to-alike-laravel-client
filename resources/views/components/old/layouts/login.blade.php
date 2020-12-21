<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Landing</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/adminlte.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome-free/css/all.min.css') }}">
</head>

<body class="hold-transition login-page" style="background-image: url('images/background.jpg');
                background-size: cover;
              background-position: center center;
              background-attachment: fixed;">

    <div class="login-box" style="background:white">
        @include('components/messages')
        <div class="login-logo">
            <a href="/landing"><b>Login </b>Shorten</a>
        </div>
        <!-- /.login-logo -->

        <div class="card">


            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to continue</p>

                <form action="user/login" method="post" id="form-login">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
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

</html>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ asset('assets/js/form-validation.js') }}"></script> -->


<script>
    $(document).ready(function() {
        var count = 0;

        // $('#form-login').on('submit', function(event) {
        //     event.preventDefault();
        //     var email = $('#email').val();
        //     var password = $('#password').val();
        //     console.log(`sending ${email}, ${password}`)
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: '{{ url("user/login") }}',
        //         method: 'post',
        //         data: {
        //             email: email,
        //             password: password
        //         },
        //         beforeSend: function() {},
        //         success: function(data) {
        //             console.log("data return dari server", data);
        //         },
        //         failure: function(data) {
        //             console.log("error", data);
        //         },
        //         error: function(xhr, status, error) {
        //             $(".alert").toggleClass('in out');
        //             return false; // Keep close.bs.alert event from removing from DOM
        //             // var err = eval("(" + xhr.responseText + ")");
        //             // alert(JSON.stringify(xhr));
        //             alert(xhr.responseJSON.error);
        //         }

        //     })
        // });


    })

</script>
