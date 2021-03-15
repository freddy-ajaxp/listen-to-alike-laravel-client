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
            {{-- filter form --}}
                {{-- <div class="row">
                    <!-- /.col -->
                    <div class="col-md-8">
                        <form class="form-horizontal" id="form-filter">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Filter</label>
                                    <div class="col-sm-">
                                        <select id="select2" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                            @foreach( $components['platforms'] as $key => $value)
                                            <option value="{{$value->platform_name}}">{{$value->platform_name}}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="filter-submit">filter</button>
                                </div>
                        </form>
                    </div>
                </div> --}}

                <div class="table-responsive ">
                    <table id="example" class="table table-bordered table-striped table-hover users-table mb-2">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Slug</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th>Video Embed</th>
                                <th>Video Embed</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                                <tr>
                                    <th>Judul</th>
                                <th>Slug</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th>Video Embed</th>
                                <th>Platform</th>
                                <th>#</th>
                                </tr>
                        </tfoot>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css"> --}}
{{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.18/datatables.min.css" /> --}}
@endpush


@push('javascript')
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/adminlte.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    //init datatable

    $(document).ready(function() {
        counter = 0;
        //kolom search table
        $('#example tfoot th').each( function () {
        var title = $(this).text();
        {{-- $(this).html( '<input type="text" placeholder="Search '+title+'" />' ); --}}
        if(!['#', 'Gambar'].includes(title)){
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }
        else{
            $(this).html(title);   
        }
    } );

        //inisiasi select2
        $('.select2').select2()

        //serverside
        var table = $('#example').DataTable({
            initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        },
            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.all-links') }}"
            , orderCellsTop: true
            , columns: [{
                    data: 'title'
                    , name: 'title'
                }
                , {
                    data: 'short_link'
                    , name: 'short_link'
                }
                , {
                    data: null
                    , render: function(data, type, row) {
                        if (row.image_path) {
                            return `<img src="https://res.cloudinary.com/dfpmdlf8l/image/upload/${row.image_path}",width=60px, height=30px alt="image not found" />`
                        } else {
                            return "No image"
                        }
                    }
                    , orderable: false
                }
                , {
                    data: null
                    , render: function(data, type, row) {
                        if (row.deletedAt) {
                            return 'Dihapus Sementara';
                        } else if (row.show_status == 2) {
                            return 'Dibanned';
                        } else {
                            return "Normal";
                        }
                    }
                    , orderable: false
                    , searchable: false
                }
                , {
                    data: null
                    , render: function(data, type, row) {
                        if (row.video_embed_url) {
                            return `<a href="${row.video_embed_url}" target="__blank"> ${row.video_embed_url} </a>`
                        } else {
                            return "No Video URL"
                        }
                    }
                    , orderable: false
                    , searchable: false

                }
                , {
                    data: 'platforms'
                    , name: 'platforms'
                    {{-- , "visible": false --}}
                    , "searchable": true
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
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/delete-link") }}'
                , method: 'get'

                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    $('#id_delete_link').val(data.id);

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
    });

    //submit form filter links
    
    $(document).on('submit', "#form-filter", function(event) {
        event.preventDefault();
         $pilihanFilter =  $("#select2").select2("data")

         if($pilihanFilter.length == 0){
             alert("pilih")
             return 0;
         }
         console.log($pilihanFilter)
         
         let result = $pilihanFilter.map(a => a.id);
         var url = '?filter=' + result.join(',');
         console.log(url)
         {{-- $('#example').DataTable().ajax.url('admin/getAllLinks'+url).load(); --}}
         $('#example').DataTable().ajax.url('admin/getAllLinks'+url).load();

    });
    //submit form delete links
    $(document).on('submit', "#form-delete-link", function(event) {
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
                    toggleSpinner(true, "Processing your request");
                }
            }
            , success: function(data) {
                toggleSpinner(false, "");
                $('#example').DataTable().ajax.reload();
                $('#modals').modal('toggle');
            }
            , complete: function() {
                toggleSpinner(false, "");
            }
            , error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    title: 'Oops!   ' + ajaxOptions
                    , text: "error occured"
                    , icon: 'error'
                    , confirmButtonText: 'Confirm'
                })
            }
        })
    });

</script>
@endpush
