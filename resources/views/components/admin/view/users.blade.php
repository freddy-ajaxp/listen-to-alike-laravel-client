@extends('components.admin.layouts.default')


@section('title', __('Daftar User'))


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data User</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-bordered table-striped table-hover users-table mb-2">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

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
        counter = 0;
        //serverside
        var table = $('#example').DataTable({

            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.all-users') }}"
            , columns: [{
                    data: 'email'
                    , name: 'email'
                }
                , {
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });

        $('#example tbody').on('click', '#resetBtn', function() {
            var data = table.row($(this).closest('tr')).data();
            $('#id_delete').val(data.id);
            $('#modal-reset').modal('show');
        })
        $('#example tbody').on('click', '#deactivateBtn', function() {
            var data = table.row($(this).closest('tr')).data();
            $('p[name="confirm-delete-name"]').text(data.title);
            $('#id_delete_user').val(data.id);
            $('#modal-delete-user').modal('show');
        })
        $('#example tbody').on('click', '#viewBtn', function() {
            var data = table.row($(this).closest('tr')).data();
            window.location.href = "{{ url('login')}}";
        })

        //submit form delete user
        $('#form-delete-user').on('submit', function(event) {
            event.preventDefault();
            id_user = $('#id_delete_user').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("admin.delete-user") }}'
                , method: 'post'
                , data: {
                    id: id_user
                }
                , dataType: 'json'
                , beforeSend: function() {
                    
                }
                , success: function(data) {
                    {
                        location.reload();

                    }
                }
            })
        });
    });

</script>
@endpush
