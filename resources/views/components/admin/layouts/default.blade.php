<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    @stack('stylesheets')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/spinner.css') }}">
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        
        @include('components/admin/components/navbar')
        <!-- /.navbar -->
        @include('components/admin/components/sidebar')
        <!-- Content Wrapper. Contains page content -->
        
        @include('components/admin/components/spinner')

        @yield('content')

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0 
            </div>
            <strong>Copyright &copy; 2019 <a href="#">bonaxcrimo@gmail.com</a>.</strong> All rights reserved.
        </footer>
    </div>
</body>
</html>


@stack('javascript')
<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>