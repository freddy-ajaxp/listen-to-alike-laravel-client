@extends('components.admin.layouts.default')


@section('title', __('Daftar Aduan'))


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Report Config</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Report - Config</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Reason</h3>
                    </div>
                    <form id="form-reason" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Reason Category</label>
                                <input required name="reason" type="text" class="form-control" placeholder="cth: Hak Cipta" minlength="5">
                            </div>
                            <div class="form-group">
                                <label>Text</label>
                                <input type="text" class="form-control" name="text" placeholder="cth: Konten ini melanggar hak cipta saya" minlength="12">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Reason List</h3>
                    </div>

                    {{-- @include('components.admin.components.spinner') --}}
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example" class="table table-bordered table-striped table-hover users-table mb-2">
                                <thead>
                                    <tr>
                                        <th>Reason<img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Kategori dari laporan"/></th>
                                        <th>Text <img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Text yang dapat dipilih oleh pelapor"/></th>
                                        <th>Actions <img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title=""/></th>
                                    </tr>
                                </thead>

                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- modal delete -->
    @include('components.admin.components.modal-master')
    <!-- modal delete end -->

</div>
@endsection


@push('stylesheets')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/adminlte.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/datatables.min.css" /> --}}
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

        //server side
        var table = $('#example').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.all-reasons') }}"
            , columns: [{
                    data: 'reason'
                    , name: 'reason'
                }
                , {
                    data: 'text'
                    , name: 'text'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        }); 

        $('#example tbody').on('click', '#deleteReasonBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/delete-reason") }}'
                , method: 'get'
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    $('#id_delete_reason').val(data.id);
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
        });

        $('#example tbody').on('click', '#editReasonBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/edit-reason") }}'
                , method: 'get'
                , data: {
                    id: data.id
                }
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    $('#id_delete_logo').val(data.id);
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText);
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: returnMessage.error
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            , })
        })

        //submit form logo
        $('#form-reason').on('submit', function(event) {
            event.preventDefault();
            formData = new FormData();
            reason = $('input[name="reason"]').val()
            text = $('input[name="text"]').val()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , enctype: 'multipart/form-data'
                , url: '{{ route("admin.add-reason") }}'
                , method: 'post'
                , data: {reason:reason, text:text}
                , dataType: 'json'
                , beforeSend: function() {
                    {
                        toggleSpinner(true, "Processing your request");
                    }
                }
                , success: function(data) {
                    {
                        toggleSpinner(false, "");
                        $('#form-reason')[0].reset();
                        $('#example').DataTable().ajax.reload();
                    }
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    toggleSpinner(false, "");
                    let returnMessage = JSON.parse(xhr.responseText)
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: returnMessage.error || returnMessage.errors.image.join()
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });

        //submit edit platform
        $(document).on('submit', "#form-reason-edit" ,  function(event) {
            event.preventDefault();
            id = $('#id').val()
            reason = $('#report_reason').val()
            text = $('#report_text').val()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , enctype: 'multipart/form-data'
                , url: '{{ url("admin/editReason") }}'
                , method: 'post'
                , data: {
                    id:id, reason:reason, text:text
                }
                , dataType: 'json'
                , beforeSend: function() {
                    {
                        toggleSpinner(true, "Processing your request");
                    }
                }
                , success: function(data) {
                    {
                        toggleSpinner(false, "");
                        $('#modals').modal('hide');
                        $('#example').DataTable().ajax.reload();
                    }
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText)
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: returnMessage.error || returnMessage.errors.image.join()
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });

        //submit form delete logo
        $(document).on('submit', "#form-delete-reason" ,  function(event) {
            event.preventDefault();
            id_reason = $('#id_delete_reason').val()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("admin.delete-reason") }}'
                , method: 'post'
                , data: {
                    id: id_reason
                , }
                , beforeSend: function() {
                        toggleSpinner(true, "Deleting Reason");
        
                }
                , success: function(data) {
                        $('#modals').modal('toggle');
                        toggleSpinner(false, "");
                        $('#example').DataTable().ajax.reload();
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText)
                    $('#modals').modal('hide');
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: returnMessage.error
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });
    });


</script>
@endpush
