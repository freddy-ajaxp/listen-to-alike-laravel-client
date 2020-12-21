@extends('components.user.layouts.default')


@section('title', __('Daftar Link'))


@section('content')
<div class="wrapper">
    <div class="App">
        <div class="section section-1" style="background-image: url('images/background.jpg');
                background-size: cover;
              background-position: center center;
              background-attachment: fixed;" `>
            <div class="section-1-bg" style="background:linear-gradient( to right,rgb(6, 34, 62),rgba(5, 32, 68, 0.66));">
                @include('components/user/components/navbar')
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">DataTable with default features</h3>
                                    </div>

                                    {{-- <div id="overlay" style="display:none" onclick='toggleSpinner(false)'>
                                        <div id="text">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <div class="row">
                                                    <div class="spinner-border" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                                <div class="row" id="spinner-text">
                                                    <strong>Processing Your Request</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}



                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example" class="table table-bordererless">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>short_link</th>
                                                    <th>Image</th>
                                                    <th>Video Url</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div>
{{-- @include('components/user/components/modals') --}}
@include('components/user/components/modal-master')
@include('components/user/components/alert')
@endsection




@push('stylesheets')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/spinner.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/music-links.css') }}">

@endpush


@push('javascript')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>
<script>
    //init datatable
    $(document).ready(function() {
        counter = 0;

        //serverside
        var table = $('#example').DataTable({

            "dom": 'lf<"toolbar">rtip'
            , processing: true
            , serverSide: true
            , ajax: "{{ route('table.all-links') }}"
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
        $("div.toolbar").html('<button style type="button" name="remove" id="addNewLink" class="btn btn-info btn-sm remove">Create Link</button>');

        $("#btn-dashboard").click(function() {
            localStorage.clear();
        });

        $("#addNewLink").click(function() {
            $('#modal-add-link').modal('show');
        });

        $('#example tbody').on('click', '#deleteBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $('p[name="confirm-delete-name"]').text(data.title);
            $('#id_delete').val(data.id);
            $('#modals').modal('show');

             $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("table.modal-delete") }}'
                , method: 'get'
                , dataType: 'json'
                , data: {
                    id: data.id
                , }
                , success: function(linksPlatform) {
                    alert("success")
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    $('#modals .dynamic-modal-container').html(xhr.responseText)
                    Swal.fire({
                        title: ajaxOptions + '!'
                        , text: xhr.responseText
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })

                }
            , })
        })

        $('#example tbody').on('click', '#customBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("table.modal-custom") }}'
                , method: 'get'
                , success: function(modal) {
                    $('#modals').modal('show');
                    $('#modals .dynamic-modal-container').html(modal)
                     $('input[name="custom-link"]').val(data.short_link);
                    $('#id_custom').val(data.id);
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    $('#modals .dynamic-modal-container').html(xhr.responseText)
                    Swal.fire({
                        title: ajaxOptions + '!'
                        , text: xhr.responseText
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })

                }
            , })




        })
        $('#example tbody').on('click', '#viewBtn', function(e) {
            e.preventDefault();
        })

        $('#example tbody').on('click', '#editBtn', function() {
            // test get modal
            var data = table.row($(this).parents('tr')).data();        
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("table.get-link-by-platform") }}'
                , method: 'post'
                , data: {
                    id: data.id
                , }
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#id').val(data.id);
                    $('#link_title').val(data.title);
                    $('#short_link').val(data.short_link);
                    $('#video_embed_url').val(data.video_embed_url);
                    $('#modals').modal('show');
                    {{-- initModal(linksPlatform) --}}
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    $('#modals .dynamic-modal-container').html(xhr.responseText)
                    Swal.fire({
                        title: ajaxOptions + '!'
                        , text: xhr.responseText
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })

                }
            , })
             
 

        })

        //ini yg lama, yg masih modal jadi satu file
        $('#example tbody').on('click', '#editBtnxxx', function() {
            var data = table.row($(this).parents('tr')).data();
            $('#id').val(data.id);
            $('#link_title').val(data.title);
            $('#short_link').val(data.short_link);
            $('#video_embed_url').val(data.video_embed_url);
            $('#modal-edit').modal('show');

            // get that data
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("table.get-link-by-platform") }}'
                , method: 'post'
                , dataType: 'json'
                , data: {
                    id: data.id
                , },

                success: function(linksPlatform) {
                    initModal(linksPlatform)
                }
            , })
        });
    });

    //toggle spinner
    function toggleSpinner(status, text = "Processing Your Request") {
        $('#spinner-text strong').text(text);
        status ? $("#overlay").css("display", "block") : $("#overlay").css("display", "none")

    }

    //img preview edit
    $(document).on('change','#image',function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image-preview-container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        $("#clear-image").attr("hidden", false);    
    });
    
    //img preview add
    $('#image-add').change(function(evt) {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image-preview-container-add').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        $("#clear-image-add").attr("hidden", false);
    });
    //img delete edit
    $('#clear-image').click(function(e) {
        e.preventDefault();
        $('#image-preview-container').attr('src', '');
        $("#clear-image").attr("hidden", true);
    });

    //img delete add
    $('#clear-image-add').click(function(e) {
        e.preventDefault();
        $('#image-preview-container-add').attr('src', '');
        $("#clear-image-add").attr("hidden", true);
    });

    //clear form edit
    $('#modal-edit').on('hidden.bs.modal', function(e) {
        $('#modal-dynamic-form').html('');
        $(this).find('form').trigger('reset');
        $('#image-preview-container').attr('src', "");
        $('#form-platform').attr('src', "");
        $('#form-custom').attr('src', "");
        counter = 0;
    })

    //clear form modal add link
    $('#modal-add-link').on('hidden.bs.modal', function(e) {
        $('#modal-dynamic-form-add').html('');
        $(this).find('form').trigger('reset');
        $('#image-preview-container-add').attr('src', "");
        $('#form-platform-add').attr('src', "");
        $('#form-custom-add').attr('src', "");
        counter = 0;
    })

    $('#checkbox').click(function() {
        if ($(this).prop("checked") == true) {
            $("#video_embed_url_add").attr("disabled", false);
        } else {
            $("#video_embed_url_add").attr("disabled", true);
            $('#video_embed_url_add').val('')
        }
    });

    //add and remove platform edit
    $(document).on('click', '#add', function() {
        dynamic_field(counter, '#modal-dynamic-form');
        counter++;
    });
    $(document).on('click', '.remove', function() {
        $(this).closest('.form-group').remove();
    });

    //add and remove platform new link
    $(document).on('click', '#add-link-platform', function() {
        console.log("add button clicked")
        dynamic_field(counter, '#modal-dynamic-form-add');
        counter++;
    });
    $(document).on('click', '.remove', function() {
        $(this).closest('.form-group').remove();
    });

    $('#form-add-link').on('submit', function(event) {
        event.preventDefault();
        var files = $('#image-add').get(0).files;
        formData = new FormData();
        link_title = $('input[name="link_title"]').val()
        video_embed_url = $('input[name="video_embed_url"]').val()


        // getting data
        var data_platform = $("select[name='data_platform[]']")
            .map(function() {
                return ' ' + $(this).val();
            }).get();

        var data_url_platform = $("input[name='data_url_platform[]']")
            .map(function() {
                return ' ' + $(this).val();
            }).get();

        var data_text = $("select[name='data_text[]']")
            .map(function() {
                return ' ' + $(this).val();
            }).get();


        //log for debug purpose
    
        //appending data to sent
        formData.append('link_title', link_title);
        formData.append('image', files[0]); //only 1 image, the first index     
        formData.append('video_embed_url', video_embed_url);
        formData.append('data_platform', data_platform);
        formData.append('data_url_platform', data_url_platform);
        formData.append('data_text', data_text);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , enctype: 'multipart/form-data'
            , url: '{{ route("dynamic-field.insert") }}'
            , method: 'post'
            , data: formData
            , dataType: 'json'
            , contentType: false
            , processData: false
            , beforeSend: function() {
                toggleSpinner(true, "Submitting Your Data");
            }
            , success: function(data) {
                location.reload();
            }
            , error: function(xhr, ajaxOptions, thrownError) {
                let returnMessage = JSON.parse(xhr.responseText)
                Swal.fire({
                    title: ajaxOptions + '!'
                    , text: returnMessage.failed
                    , icon: 'error'
                    , confirmButtonText: 'Confirm'
                })

                toggleSpinner(false, ""); 
            }
        })
    });

    $('#form-platform').on('submit', function(event) {
        event.preventDefault();
        var files = $('#image').get(0).files;
        formData = new FormData();
        id = $('input[name="id"]').val()
        link_title = $('input[name="link_title"]').val()
        short_link = $('input[name="short_link"]').val()
        video_embed_url = $('input[name="video_embed_url"]').val()


        // getting data
        var data_platform = $("select[name='data_platform[]']")
            .map(function() {
                return ' ' + $(this).val();
            }).get();

        var data_url_platform = $("input[name='data_url_platform[]']")
            .map(function() {
                return ' ' + $(this).val();
            }).get();

        var data_text = $("select[name='data_text[]']")
            .map(function() {
                return ' ' + $(this).val();
            }).get();

        var id_platforms = $("input[name='id_platforms[]']")
            .map(function() {
                return ' ' + $(this).val();
            }).get();



        //appending data to sent
        formData.append('id', id);
        formData.append('link_title', link_title);
        formData.append('image', files[0]); //only 1 image, the first index     
        formData.append('video_embed_url', video_embed_url);
        formData.append('id_platforms', id_platforms);
        formData.append('data_platform', data_platform);
        formData.append('data_url_platform', data_url_platform);
        formData.append('data_text', data_text);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , enctype: 'multipart/form-data'
            , url: '{{ route("dynamic-field.upsert") }}'
            , method: 'post'
            , data: formData
            , dataType: 'json'
            , contentType: false
            , processData: false
            , beforeSend: function() {
                toggleSpinner(true, "Submitting Your Data");
            }
            , success: function(data) {
                location.reload();
            }
            , error: function(xhr, ajaxOptions, thrownError) {
                let returnMessage = JSON.parse(xhr.responseText)
                Swal.fire({
                    title: ajaxOptions + '!'
                    , text: returnMessage.failed
                    , icon: 'error'
                    , confirmButtonText: 'Confirm'
                })

                toggleSpinner(false, ""); 
                {{--toggleAlert(true, "error", ajaxOptions, returnMessage.failed);--}}
            }
        })
    });

    $('#form-custom').on('submit', function(event) {
        event.preventDefault();
        id = $('#id_custom').val()
        customLink = $('input[name="custom-link"]').val()
        //log for debug purpose
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: '{{ route("table.custom-link") }}'
            , enctype: 'multipart/form-data'
            , method: 'post'
            , data: {
                id: id
                , short_link: customLink
            , }
            , dataType: 'json'
            , beforeSend: function() {
                toggleSpinner(true, "Submitting Your Data");
            }
            , success: function(data) {
                toggleSpinner(false, "");
                location.reload();
            }
            , error: function(xhr, ajaxOptions, thrownError) {
                let returnMessage = JSON.parse(xhr.responseText)
                Swal.fire({
                    title: ajaxOptions + '!'
                    , text: returnMessage.failed
                    , icon: 'error'
                    , confirmButtonText: 'Confirm'
                })

                toggleSpinner(false, ""); 
                
            }
        })

    });
    $('#form-delete').on('submit', function(event) {
        event.preventDefault();
        id = $('#id_delete').val()
        //log for debug purpose

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: '{{ route("table.delete-link") }}'
            , enctype: 'multipart/form-data'
            , method: 'post'
            , data: {
                id: id
            }
            , dataType: 'json'
            , beforeSend: function() {
                toggleSpinner(true, "Deleting Your Data");
            }
            , success: function(data) {
                location.reload();
            }
            , error: function(xhr, ajaxOptions, thrownError) {
                let returnMessage = JSON.parse(xhr.responseText)
                Swal.fire({
                    title: ajaxOptions + '!'
                    , text: returnMessage.failed
                    , icon: 'error'
                    , confirmButtonText: 'Confirm'
                })

                toggleSpinner(false, ""); 
            }
        })
    });

    function initModal(linksPlatform) {
        linksPlatform.forEach(eachData => {
            $('#modal-dynamic-form').append(`
                            <div class="form-group">
                            <input type="hidden" name="id_platforms[]" value="${eachData.id}"/>
                                <div class="form-row">
                                    <div class="col-sm-2">
                                        <select id="data_platform${counter}" name="data_platform[]" class="form-control form-control-sm">
                                            <option disabled selected value=null>Platform</option>
                                            <option value="youtube">Youtube</option>
                                            <option value="spotify">Spotify</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" name="data_url_platform[]" class="form-control form-control-sm" placeholder="URL dari platform" value="${eachData.url_platform}"/>
                                    </div>
                                    <div class="col-sm-2">
                                        <select id="data_text${counter}" name="data_text[]" class="music-link__button-text-select">
                                        <option selected="selected" value="Listen" >Listen</option>
                                        <option value="Purchase">Purchase</option>
                                        <option value="Play">Play</option>
                                        <option value="Buy">Buy</option>
                                        <option value="Buy Online">Buy Online</option>
                                        <option value="Download">Download</option>
                                        <option value="Stream">Stream</option>
                                        <option value="Go To">Go To</option>
                                        <option value="Visit">Visit</option>
                                        <option value="Watch">Watch</option>
                                        <option value="View">View</option>
                                        <option value="Pre-Order">Pre-Order</option>
                                        <option value="Pre-Save">Pre-Save</option>
                                        <option value="Pre-Add">Pre-Add</option>
                                        <option value="Buy Tickets">Buy Tickets</option>
                                        <option value="Get Tickets">Get Tickets</option>
                                        <option value="View Ticket Prices">View Ticket Prices</option>
                                        <option value="Discover">Discover</option>                                    </select>
                                    </div>
                                    <div class="col-sm-1">
                                    <button type="button" name="remove" id="" class="btn btn-danger btn-sm remove">X</button>
                                    </div>
                            </div>`);
            $(`#data_platform${counter}`).val(eachData.jenis_platform);
            $(`#data_text${counter}`).val(eachData.text);
            counter++;
        });

    }

    function dynamic_field(counter, $idModal) {
        $($idModal).append(`
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-sm-2">
                                <input type="hidden" name="id_platforms[]" value="0"/>
                                    <select name="data_platform[]" class="form-control form-control-sm">
                                         <option selected value="youtube">Youtube</option>
                                        <option value="spotify">Spotify</option>
                                    </select>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="data_url_platform[]" class="form-control form-control-sm" placeholder="URL dari platform" value=" "/>
                                </div>
                                <div class="col-sm-2">
                                    <select name="data_text[]" class="music-link__button-text-select">
                                    <option selected="selected" value="Listen" >Listen</option>
                                    <option value="Purchase">Purchase</option>
                                    <option value="Play">Play</option>
                                    <option value="Buy">Buy</option>
                                    <option value="Buy Online">Buy Online</option>
                                    <option value="Download">Download</option>
                                    <option value="Stream">Stream</option>
                                    <option value="Go To">Go To</option>
                                    <option value="Visit">Visit</option>
                                    <option value="Watch">Watch</option>
                                    <option value="View">View</option>
                                    <option value="Pre-Order">Pre-Order</option>
                                    <option value="Pre-Save">Pre-Save</option>
                                    <option value="Pre-Add">Pre-Add</option>
                                    <option value="Buy Tickets">Buy Tickets</option>
                                    <option value="Get Tickets">Get Tickets</option>
                                    <option value="View Ticket Prices">View Ticket Prices</option>
                                    <option value="Discover">Discover</option>                                    </select>
                                </div>
                                <div class="col-sm-1">
                                <button type="button" name="remove" id="" class="btn btn-danger btn-sm remove">X</button>
                                </div>
                        </div>`);
    }

</script>



@endpush
