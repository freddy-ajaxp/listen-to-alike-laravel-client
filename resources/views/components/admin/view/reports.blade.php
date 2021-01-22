@extends('components.admin.layouts.default')


@section('title', __('Daftar Aduan'))


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Aduan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-bordered table-striped table-hover users-table mb-2">
                        <thead>
                            <tr>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Jenis Alasan</th>
                                <th>Alasan Lain</th>
                                <th>Actions<img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Melarng sebuah Link akan membuat link tersebut tidak dapat dilihat oleh pengunjung. Pastikan anda memiliki alasan yang benar ketika melarang sebuah Link. untuk mengembalikan Link ke semula dengan menekan tombol pulihkan"/></th>
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
            , ajax: "{{ route('admin.all-reports') }}"
            , columns: [
                 {
                    data: null
                    , render: function(data, type, row) {
                        if (row.link) {
                            return `<a href="{{ url("admin") }}" target="__blank"> ${row.link} </a>`
                            {{-- return `<a href="{{ url("detail/` .`${row.link}`  .`") }}" target="__blank"> ${row.link} </a>` --}}
                        } else {
                            return "Not found"
                        }
                    }
                    , orderable: false

                }

                , {
                    data: null
                    , render: function(data, type, row) {
                        if (row.validated == 0) {
                            return `Normal`
                        } else {
                            return "Banned/Dilarang"
                        }
                    }
                    , orderable: false
                }
                , {
                    data: 'reasons'
                    , name: 'reasons'
                }
                , {
                    data: 'additional_reason'
                    , name: 'additional_reason'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });

        $('#example tbody').on('click', '#pulihkanBtn', function() {
             var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/pulihkanLink") }}'
                , data: {
                    idReport: data.id
                }
                , method: 'post'
                , beforeSend: function() {
                    toggleSpinner(true, "Performing Your request");
                }
                , success: function(linksPlatform) {
                        toggleSpinner(false, "");
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
        })


        $('#example tbody').on('click', '#banBtn', function() {
             var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/ban-link") }}'
                , data: {
                    id: data.id
                }
                , method: 'get'
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
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

        //submit form delete user
        $(document).on('submit', '#form-ban-link', function(event) {
            event.preventDefault();
            idReport = $('#id_ban_link').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("admin.ban-link") }}'
                , method: 'post'
                , data: {
                    idReport: idReport
                }
                , dataType: 'json'
                , beforeSend: function() {
                    toggleSpinner(true, "Performing Your request");
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

    });

</script>
@endpush
