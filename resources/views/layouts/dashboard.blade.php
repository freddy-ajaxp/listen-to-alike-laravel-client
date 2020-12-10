<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <style>
        #overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.3);
            z-index: 1051;
            cursor: pointer;
        }

        #text {
            position: absolute;
            top: 50%;
            left: 50%;
            /* font-size: 50px; */
            /* color: black; */
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Landing</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/laravel.css') }}"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/landing.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/spinner.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/music-links.css') }}">

</head>

<body>
    <div class="wrapper">
        <div class="App">
            <div class="section section-1" style="background-image: url('images/background.jpg');
                background-size: cover;
              background-position: center center;
              background-attachment: fixed;" `>
                <div class="section-1-bg" style="background:linear-gradient( to right,rgb(6, 34, 62),rgba(5, 32, 68, 0.66));">
                    @include('components/navbar')
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">DataTable with default features</h3>
                                        </div>

                                        <div id="overlay" style="display:none" onclick='toggleSpinner(false)'>
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
                                        </div>



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
    </div>
    </div>

    <!-- modal edit -->
    <div class="modal bd-example-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="form-platform" name="form-platform" class="form-horizontal" novalidate="">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Title</label>
                            <div>
                                <input type="text" class="form-control has-error" id="link_title" name="link_title" placeholder="title" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Link</label>
                            <div>
                                <input disabled type="text" class="form-control has-error" id="short_link" name="short_link" placeholder="link" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDetail" class="col-sm-3 control-label">Video URL</label>
                            <div>
                                <input type="text" class="form-control" id="video_embed_url" name="video_embed_url" placeholder="Video URL" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 mb-2">
                            </div>
                            <label for="inputDetail" class="col-sm-3 control-label">Image</label>
                            <div class="music-link__upload-art">
                                <ion-icon name="download-outline" />
                                <b style=" font-weight: 500; margin-bottom: '0.5em'">
                                    Upload Image
                                </b>
                                <p style="font-size: '0.8em'; opacity: '0.8' ">
                                    jpg | jpeg | png <br> Max 10MB <br> Drop file here.
                                </p>
                                <img id="image-preview-container" src="" style="max-height: 150px;">
                                <input id="image" class="music-link__upload-input" type="file" name="image" accept="image/*" />
                            </div>
                            <button id="clear-image" hidden> clear</button>
                        </div>
                        <div>
                            <button type="button" name="add" id="add" class="">Add New Row</button>
                        </div>
                        <div id="modal-dynamic-form">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-update" value="add">Update</button>
                    </div>
        </form>
    </div>
    </div>
    </div>
    <!-- modal edit end -->


    <!-- modal delete -->
    <div class="modal" id="modal-delete" role="dialog">
        <form id="form-delete" name="form-delete" class="form-horizontal" novalidate="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>konfirmasi hapus data:</p>
                        <input type="hidden" id="id_delete" />
                        <p name="confirm-delete-name"> asdasd</p>
                        <p>Lanjutkan?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- modal delete end -->

    <!-- modal Custom -->
    <div class="modal" id="modal-custom" role="dialog">
        <form id="form-custom" name="form-custom" class="form-horizontal" novalidate="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Customize URL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Data Link:</p>
                        <input type="hidden" id="id_custom" />
                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInputGroup">Username</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">link.pendek/</div>
                                </div>
                                <input type="text" name="custom-link" class="form-control form-control-sm" placeholder="URL dari platform" value="${eachData.url_platform}" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-custom" class="btn btn-success">Custom</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- modal Custom end -->


    </div>

</body>

</html>


<!-- <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script> -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
<script>
    //init datatable
    $(document).ready(function() {
        counter = 0;
        var table = $('#example').DataTable({
            "ajax": {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("table.all-links") }}',
                method: 'get',
                contentType: false,
                processData: false,
            },
            "columns": [{
                    "data": "title"
                },
                {
                    "data": "short_link"
                },
                {
                    "data": "image_path"
                },
                {
                    "data": "video_embed_url"
                },
                {
                    "defaultContent": `<button id='editBtn'>Edit</button> 
                    <button id='deleteBtn'>Delete</button>
                    <button id='customBtn'>Customize</button>
                    <button id='viewBtn'>Visit</button>`
                },

            ]
        });

        $("#btn-dashboard").click(function() {
            // localStorage.removeItem('links');
            localStorage.clear();
        });

        $('#example tbody').on('click', '#deleteBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $('p[name="confirm-delete-name"]').text(data.title);
            $('#id_delete').val(data.id);
            $('#modal-delete').modal('show');
        })
        $('#example tbody').on('click', '#customBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $('input[name="custom-link"]').val(data.short_link);
            $('#id_custom').val(data.id);
            $('#modal-custom').modal('show');
        })
        $('#example tbody').on('click', '#viewBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            window.open(`http://localhost:8000/previewData/${data.short_link}`, '_blank');
        })
        $('#example tbody').on('click', '#editBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            console.log('data', data)
            $('#id').val(data.id);
            $('#link_title').val(data.title);
            $('#short_link').val(data.short_link);
            $('#video_embed_url').val(data.video_embed_url);
            $('#modal-edit').modal('show');

            // get that data
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("table.get-link-by-platform") }}',
                method: 'post',
                dataType: 'json',
                data: {
                    id: data.id,
                },

                success: function(linksPlatform) {
                    initModal(linksPlatform)
                },
            })
        });
    });

    //toggle spinner
    function toggleSpinner(status, text = "Processing Your Request") {
        $('#spinner-text strong').text(text);
        status ? $("#overlay").css("display", "block") : $("#overlay").css("display", "none")

    }

    //img preview
    $('#image').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image-preview-container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        $("#clear-image").attr("hidden", false);
    });
    //img delete
    $('#clear-image').click(function(e) {
        e.preventDefault();
        $('#image-preview-container').attr('src', '');
        $("#clear-image").attr("hidden", true);
    });

    //clear form
    $('#modal-edit').on('hidden.bs.modal', function(e) {
        $('#modal-dynamic-form').html('');
        $(this).find('form').trigger('reset');
        $('#image-preview-container').attr('src', "");
        $('#form-platform').attr('src', "");
        $('#form-custom').attr('src', "");
    })

    $(document).on('click', '#add', function() {
        dynamic_field(counter);
        counter++;
    });
    $(document).on('click', '.remove', function() {
        $(this).closest('.form-group').remove();
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

        //log for debug purpose
        console.log('data yg akan dikirim')
        console.log('id', id)
        console.log('link_title', link_title)
        console.log('short_link', short_link)
        console.log('video_embed_url', video_embed_url)
        console.log('data_platform', data_platform)
        console.log('id_platforms', id_platforms)
        console.log('data_url_platform', data_url_platform)
        console.log('data_text', data_text)
        console.log('files[0]', files[0])

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
            },
            enctype: 'multipart/form-data',
            url: '{{ route("dynamic-field.upsert") }}',
            method: 'post',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function() {
                toggleSpinner(true, "Submitting Your Data");
            },
            success: function(data) {
                location.reload();
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
            },
            url: '{{ route("table.custom-link") }}',
            enctype: 'multipart/form-data',
            method: 'post',
            data: {
                id: id,
                short_link: customLink,
            },
            dataType: 'json',
            beforeSend: function() {
                toggleSpinner(true, "Submitting Your Data");
            },
            success: function(data) {
                toggleSpinner(false, "");
                location.reload();
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
            },
            url: '{{ route("table.delete-link") }}',
            enctype: 'multipart/form-data',
            method: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            beforeSend: function() {
                toggleSpinner(true, "Deleting Your Data");
            },
            success: function(data) {
                location.reload();
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

    function dynamic_field(counter) {
        $('#modal-dynamic-form').append(`
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