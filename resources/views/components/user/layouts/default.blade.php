<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    @stack('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/spinner.css') }}">

</head>

<body>
    <div class="App">
        <div class="section section-1" style="background-image: url('images/background.jpg');
                background-size: cover;
              background-position: center center;
              background-attachment: fixed;" `>
            <div class="section-1-bg" style="background:linear-gradient( to right,rgb(6, 34, 62),rgba(5, 32, 68, 1));">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
 @stack('javascript')