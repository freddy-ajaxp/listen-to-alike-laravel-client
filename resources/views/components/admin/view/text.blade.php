@extends('components.admin.layouts.default')


@section('title', __('Pengaturan Text'))

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Text Option</h3>
                    </div>
                    <form id="form-text" action="/admin/addPlatform" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Text</label>
                                <input name="text" type="text" class="form-control" placeholder="cth: Kunjungi">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Text List</h3>
                    </div>

                    @include('components.admin.components.spinner')
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="table-text" class="table table-bordered table-striped table-hover users-table mb-2">
                                <thead>
                                    <tr>
                                        <th>Text</th>
                                        <th>Actions</th>
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
        counter = 0;

        

         var table = $('#table-text').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.all-texts') }}"
            , columns: [{
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
         
        $(document).on('click', '#deleteTextBtn', function() {
            var data = table.row($(this).parents('tr')).data(); //data tidak tertangkap
            idText = $(this).data('id'); // id diambil dari dalam attribute button #deleteTextBtn
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/delete-text") }}'
                , data: {idText: idText}
                , method: 'get'
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    $('#id_delete_logo').val(idText);
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
        })

        //img preview
        $('#svg').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image-preview-container').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            $("#clear-image").attr("hidden", false);
        });

        //img preview deleted
        $('#clear-image').click(function(e) {
            e.preventDefault();
            $('#image-preview-container').attr('src', '');
            $('#svg').val('');
            $("#clear-image").attr("hidden", true);
        });

        //click overlay to hide
        $('#overlay').click(function(e) {
            e.preventDefault();
            toggleSpinner(false);
        });

        //submit form text
        $('#form-text').on('submit', function(event) {
            event.preventDefault();
            text_name = $('input[name="text"]').val()

            //appending data to sent
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("admin.add-text") }}'
                , method: 'post'
                , data: {text: text_name}
                , dataType: 'json'
                , beforeSend: function() {
                    {
                        toggleSpinner(true, "Processing your request");
                    }
                }
                , success: function(data) {
                    {
                        $('#example').DataTable().ajax.reload();
                    }
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: "error occured"
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });
    });

</script>
@endpush
