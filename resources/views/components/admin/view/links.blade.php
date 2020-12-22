@extends('components.admin.layouts.default')


@section('title', __('Daftar Link'))


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Links</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Links</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Link</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-bordered table-striped table-hover users-table mb-2">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Slug</th>
                                <th>Gambar</th>
                                <th>Video</th>
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
<script>
    //init datatable

    $(document).ready(function() {
     counter = 0;

        //serverside
        var table = $('#example').DataTable({

            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.all-links') }}"
            , columns: [{
                    data: 'title'
                    , name: 'title'
                }
                , {
                    data: 'short_link'
                    , name: 'short_link'
                }
                , {
                    data: 'image_path'
                    , name: 'image_path'
                }
                , {
                    data: 'video_embed_url'
                    , name: 'video_embed_url'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });

    $('#example tbody').on('click', '#deletetBtn', function() {
            var data = table.row($(this).closest('tr')).data();
            $('p[name="confirm-delete-name"]').text(data.id);
            $('#id_delete_link').val(data.id);
            $('#modal-delete').modal('show');
        })
    });
        //submit form delete links
        $(document).on('submit', "#form-delete-link" ,  function(event) {
            event.preventDefault();

            id_link = $('#id_delete_link').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("admin.delete-link") }}'
                , method: 'post'
                , data: {
                    id: id_link
                , }
                , dataType: 'json'
                , beforeSend: function() {
                    {
                        toggleSpinner(true, "Submitting Your Data");
                    }
                }
                , success: function(data) {
                        toggleSpinner(false, "");
                        location.reload();
                },
                complete: function() {
                        toggleSpinner(false, "");
                        location.reload();
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        title: 'Oops!   ' +ajaxOptions 
                        , text: "error occured"
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });
</script>
@endpush
