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
                                <th>Status</th>
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
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
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
                    data: null
                    , render: function(data, type, row) {
                        if (row.admin == 0) {
                            return `User`
                        } else if (row.admin == 1) {
                            return "Admin"
                        }
                        else if (row.admin == 2) {
                            return "Super Admin"
                        }
                        
                    }
                    , orderable: false
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });

        $(document).on('click', 'a[name="set-privilige"]', function(e) {
            e.preventDefault();
            var data = table.row($(this).closest('tr')).data();
            role = $(this).data("privilige");
            Swal.fire({
            title: 'Are you sure?',
            text: `Changing to ${role}. This Account will only able to access it's new menus and functionalities!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Change it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/setPrivilege") }}'
                , method: 'post'
                , data: {
                    id: data.id,
                    privilege: role
                }
                , success: function(linksPlatform) {
                    $('#example').DataTable().ajax.reload(); 
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText)
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: returnMessage.error
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            , })
            }
            })
        })

        $('#example tbody').on('click', '#resetBtn', function() {
            var data = table.row($(this).closest('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/reset-pwd") }}'
                , method: 'get'
                , data: {
                    id: data.id
                }
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    $('#id_user').val(data.id);

                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        title: ajaxOptions + '!'
                        , text: xhr.responseText
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })

                }
            , })
        })

        //not yet used
        $(document).on('click', '#deactivateBtn', function(event) {
            var data = table.row($(this).closest('tr')).data();
            $('p[name="confirm-delete-name"]').text(data.title);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/delete-user") }}'
                , method: 'get'

                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    $('#id_delete_user').val(data.id);

                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        title: ajaxOptions + '!'
                        , text: xhr.responseText
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })

                }
            , })
        })


        //submit form delete user
        $(document).on('submit', '#form-delete-user', function(event) {
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
                    toggleSpinner(true, "Deleting This User Account");
                }
                , success: function(data) {
                    {
                        toggleSpinner(false, "");
                        $('#modals').modal('hide');
                        $('#example').DataTable().ajax.reload();

                    }
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: "error occured"
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });

        //form reset password
        $(document).on('submit', '#form-reset-password', function(event) {
            event.preventDefault();
            id_user = $('#id_user').val();
            password = $('#password').val();
            password2 = $('#password-confirmation').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/resetPassword") }}'
                , method: 'post'
                , data: {
                    id: id_user
                    , password: password
                    , password2: password2

                }

                , beforeSend: function() {
                    toggleSpinner(true, "Processing request");
                }
                , success: function(data) {
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'success'
                        , text: "update success"
                        , icon: 'success'
                        , confirmButtonText: 'Confirm'
                    })
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: xhr.responseJSON.error
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })

        });


        //show password on-mousedown
        $(document).on('click', '#show-pwd', function() {
            if ($('input:checkbox').is(':checked')) {
                $("input[name=pwd]").attr('type', 'text')
            } else if (!$('input:checkbox').is(':checked')) {
                $("input[name=pwd]").attr('type', 'password')
            }
        });

    });

</script>
@endpush
