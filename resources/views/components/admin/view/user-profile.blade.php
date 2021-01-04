@extends('components.admin.layouts.default')


@section('title', __('Data User'))
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href='{{ url("admin/userList") }}'>Users</a></li>
                        <li class="breadcrumb-item active">User Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    {{-- {{print_r($data)}} --}}
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi User </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="form-platform" action="/admin/addPlatform" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input hidden id="id_user" type="text" value="{{$data['id']}}" class="form-control">
                                <input disabled name="name" type="text" value="{{$data['name']}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input disabled name="email" type="text" value="{{$data['email']}}" class="form-control">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->

                <!-- /.box -->
            </div>
            <!-- /.box -->
            <!-- Default box -->
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Link Milik User</h3>
                    </div>

                    @include('components.admin.components.spinner')
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example" class="table table-bordered table-striped table-hover users-table mb-2">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>short_link</th>
                                        <th>Image</th>
                                        <th>Video Url</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

    <!-- modal delete -->
    @include('components.admin.components.modals')
    <!-- modal delete end -->

</div>
@endsection


@push('stylesheets')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/adminlte.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/datatables.min.css" />
@endpush


@push('javascript')
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/adminlte.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
<script>
    //init datatable

    $(document).ready(function() {
        let id_user = $('#id_user').val();
        var table = $('#example').DataTable({
            processing: true
            , serverSide: true
            , ajax: `{{ url('admin/getUserLinkList/${id_user}') }}`
            , columns: [{
                    data: 'title'
                    , name: 'title'
                }
                , {
                    data: 'short_link'
                    , name: 'short_link'
                },
                {
                    data: "video_embed_url"
                    , render: function(data, type, row) {
                        if(row.image_path){
                            return `<img src="https://res.cloudinary.com/dfpmdlf8l/image/upload/${row.image_path}",width=60px, height=30px alt="image not found" />`
                        }
                        else {
                            return "No image"
                        }
                        
                    }
                    , orderable: false
                }

                , {
                    data: 'video_embed_url'
                    , name: 'video_embed_url'
                    , "render": function(data, type, row, meta) {
                         if(row.video_embed_url){
                            return '<a href="' + data + '" style="text-align:center">Video Link</a>';
                        }
                        else {
                            return "No Video URL";
                        }
                    }
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });

    });

</script>
@endpush
