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
                                <th>Status<img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Laporan disetujui membuat sebuah link tidak dapat diakses"/></th>
                                <th>Jenis Laporan</th>
                                <th>Alasan Lain</th>
                                <th>Tanggal</th>
                                <th>Actions<img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Melarang sebuah Link akan membuat link tersebut tidak dapat dilihat oleh pengunjung. Pastikan anda memiliki alasan yang benar ketika melarang sebuah Link. untuk mengembalikan Link ke semula dengan menekan tombol pulihkan"/></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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
        idLink='';
        //serverside
        var table = $('#example').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.all-reports') }}"
            , "order": [[ 4, "desc" ]]
            , columns: [
                 {
                    data: null
                    , render: function(data, type, row) {
                        if (row.link) {
                            return `<a href="{{url('preview')}}/${row.shortLink}" target="__blank"> ${row.link} </a>`
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
                            return `-`
                        } else {
                            return "Disetujui"
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
                    data: 'date'
                    , name: 'date'
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
             idLink = data.link
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/ban-link") }}'
                , data: {
                    id: data.id,
                    idLink: idLink
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

        $('#example tbody').on('click', '#reportInfoBtn ', function() {
             var data = table.row($(this).parents('tr')).data();
             idLink = data.link
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/report-info") }}'
                , data: {
                    idLink: idLink
                }
                , method: 'get'
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    initDatatable(idLink);
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
            banReason = $('#banReason').val();
            Swal.fire({
                icon: 'warning',
                title: "Konfirmasi",
                text: "Pesan yang sudah dikirim tidak dapat diubah atau dihapus. Lanjutkan?",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((result) => {
                if (result['isConfirmed']){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url: '{{ route("admin.ban-link") }}'
                    , method: 'post'
                    , data: {
                        idReport: idReport,
                        banReason: banReason,
                        idLink: idLink,
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
                        toggleSpinner(false, "");
                        Swal.fire({
                            title: 'Oops! ' + ajaxOptions
                            , text: "error occured"
                            , icon: 'error'
                            , confirmButtonText: 'Confirm'
                        })
                        }
                    })   
                }
            })
        });


        function initDatatable(linkId){
            var table2 = $('#example2').DataTable({
            "dom": 'lf<"toolbar">rtip'
            , processing: true
            , serverSide: true
            , ajax: {
                "url" : "{{ route('admin.reports-by-link') }}"
                , data: {linkId: linkId}
                }
            , columns: [{
                    data: 'shortLink'
                    , name: 'shortLink'
                }
               
            , ]
        });
        }
    });

</script>
@endpush
