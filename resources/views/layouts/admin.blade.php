<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('components/admin/navbar')
        <!-- /.navbar -->
        @include('components/admin/sidebar')
        <!-- Content Wrapper. Contains page content -->
        @include('components/admin/'.$components['main'])

        <script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0 
            </div>
            <strong>Copyright &copy; 2019 <a href="#">bonaxcrimo@gmail.com</a>.</strong> All rights reserved.
        </footer>
    </div>
</body>
</html>



<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
<script>
    //init datatable
    $(document).ready(function() {
        counter = 0;
        var table = $('#example').DataTable({
            "ajax": {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("table.all-links") }}',
                method: 'get',
                contentType: false,
                processData: false,
            },
            "columns": [{
                    "data": "title"
                },
                {
                    "data": "short_link"
                },
                {
                    "data": "image_path"
                },
                {
                    "data": "video_embed_url"
                },
                {
                    "defaultContent": `<button id='editBtn'>Edit</button> 
                    <button id='deleteBtn'>Delete</button>
                    <button id='customBtn'>Customize</button>
                    <button id='viewBtn'>Visit</button>`
                },

            ]
        });