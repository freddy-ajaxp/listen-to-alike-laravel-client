<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset('images/icons/headphone.svg')}}" type='image/x-icon'/>
    <title>@yield('title') | {{config('constants.site_title')}}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
 
    <!-- CSS -->
    @stack('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/spinner.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>
    <div class="App">
        <div class="section section-1" style="background-image: url('images/background.jpg');
                background-size: cover;
              background-position: center center;
              background-attachment: fixed;" `>
            <div class="section-1-bg">
                @yield('content')
            </div>
        </div>
    </div>
</body>
@include('components.user.components.spinner')
</html>

<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
 @stack('javascript')

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
