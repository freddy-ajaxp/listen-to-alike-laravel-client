@extends('components.user.layouts.default')


@section('title', __('Daftar Link'))


@section('content')
<div class="wrapper">
    <div class="App">
        <div class="section section-1" style="background-image: url('images/background.jpg');
                background-size: cover;
              background-position: center center;
              background-attachment: fixed;">
            <div class="section-1-bg" style="background:linear-gradient( to right,rgb(6, 34, 62),rgba(5, 32, 68, 0.66));">
                @include('components/user/components/navbar')
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Your Music Links</h3>
                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-bordererless">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>short_link</th>
                                                        <th>Image</th>
                                                        <th>Video Url</th>
                                                        <th>Status</th>
                                                        <th>Visit Count</th>
                                                        <th>Dibuat</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
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

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/adminlte.min.css') }}"> --}}

@endpush


@push('javascript')

{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> --}}
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>

<script>
    //init datatable
    $(document).ready(function() {
        counter = 0;
        getPlatformField();
        var platformContainer;
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
                    data: 'status'
                    , name: 'status'
                }
                , {
                    data: 'count'
                    , name: 'count'
                }

                ,{
                    data: 'createdAt',
                    type: 'num',
                    render: {
                        _: 'display',
                        sort: 'timestamp'
                    }
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ],
            order: [[6, "DESC"]] 
        });
        $("div.toolbar").html('&nbsp <button style type="button" id="addNewLink" class="btn btn-info btn-sm remove"><i class="fas fa-plus"></i> Create Link</button>');

        $("#btn-dashboard").click(function() {
            localStorage.clear();
        });

        $("#addNewLink").click(function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("table.modal-add") }}'
                , method: 'get'
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modal-dynamic-form').find('div[class="form-group"]').remove();
                    $('#modals').modal('show');
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
        });

        $('#example tbody').on('click', '#deleteBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("table.modal-delete") }}'
                , method: 'get'
                , data: {
                    id: data.id
                , }
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    $('#id_delete').val(data.id);

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

        $('#example tbody').on('click', '#customBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("table.modal-custom") }}'
                , method: 'get'
                , success: function(modal) {
                    $('#modals .dynamic-modal-container').html(modal)
                    $('#modals').modal('show');
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
        
        $('#example tbody').on('click', '#shareBtn', function() {
            copyText = $(this).data('url')
            var textarea = document.createElement("textarea");
            textarea.setAttribute("type", "hidden");
            textarea.textContent = copyText;
            textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");   
            Swal.fire({
            position: 'top',
            title: 'URL link berhasil di copy',
            showConfirmButton: false,
            timer: 1000
            })
        })

        $('#example tbody').on('click', '#viewBtn', function(e) {
            e.preventDefault();
        })

        $('#example tbody').on('click', '#editBtn', function() {

            // get modal
            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("table.get-link-by-id") }}'
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

                    //hide disini
                  
                    {{-- console.log(select) --}}
                    var data_platform = $("img[name='data_platform[]']")
                        .map(function() {
                            return `[data-id-platform='${$(this).attr('data-value')}']`;
                        }).get();
                    data_platform = data_platform.join(", ");
                    optionsToHide = $("#selectAddPlatform").find(data_platform)
                    $(optionsToHide).hide();
                    $('#modals').modal('show');
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


        //BATASA UJI COBA SCROPT DASHBOARD DIGABUNG DALAM 1 FILE
        //toggle spinner
        function toggleSpinner(status, text = "Processing Your Request") {
            $('#spinner-text strong').text(text);
            status ? $("#overlay").css("display", "block") : $("#overlay").css("display", "none")

        }
        
        $(document).on('click', '#checkbox', function(event) {
            if ($(this).prop("checked") == true) {
                $("#video_embed_url").attr("disabled", false);
            } else {
                $("#video_embed_url").attr("disabled", true);
                $('#video_embed_url').val('')
            }   
        });

        $(document).on('submit', '#form-platform', function(event) {
            //FORM EDIT
            event.preventDefault();
            var files = $('#image').get(0).files;
            formData = new FormData();
            id = $('input[name="id"]').val()
            link_title = $('input[name="link_title"]').val()
            short_link = $('input[name="short_link"]').val()
            video_embed_url = $('input[name="video_embed_url"]').val()
            userErasingImage = $('#userErasingImage').val()

            // getting data
            var data_platform = $("img[name='data_platform[]']")
                .map(function() {
                    return ' ' + $(this).attr('data-value');
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
            if (files.length !== 0) {
                formData.append('image', files[0]); //only 1 image, the first index
            }
            formData.append('image', files[0]); //only 1 image, the first index
            formData.append('video_embed_url', video_embed_url);
            formData.append('id_platforms', id_platforms);
            formData.append('data_platform', data_platform);
            formData.append('data_url_platform', data_url_platform);
            formData.append('data_text', data_text);
            formData.append('userErasingImage', userErasingImage);

            console.log('video_embed_url', video_embed_url);
            console.log('id_platforms', id_platforms);
            console.log('data_platform', data_platform);
            console.log('data_url_platform', data_url_platform);
            console.log('data_text', data_text);
            console.log('userErasingImage', userErasingImage);            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , enctype: 'multipart/form-data'
                , url: '{{ route("dynamic-field.upsert") }}'
                , method: 'POST'
                , data: formData
                , dataType: 'json'
                , contentType: false
                , processData: false
                , beforeSend: function() {
                    toggleSpinner(true, "Submitting Your Data");
                }
                , success: function(data) {
                    $('#modals').modal('hide');
                    toggleSpinner(false, "");
                    $('#example').DataTable().ajax.reload();
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText)
                    Swal.fire({
                        title: ajaxOptions + '!'
                        , text: returnMessage.error || returnMessage.errors.image.join()
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })

                    toggleSpinner(false, "");
                }
            })
            return false;
        });

        $(document).on('submit', '#form-custom', function(event) {
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
                    $('#modals').modal('hide');
                    $('#example').DataTable().ajax.reload();
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText)
                    Swal.fire({
                        title: ajaxOptions + '!'
                        , text: returnMessage.error
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                    toggleSpinner(false, "");

                }
            })

        });

        $(document).on('click', '.music-link__reposition-up', function() {
            $($this).before($(""));
        })

        $(document).on('submit', '#form-delete', function(event) {
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
                    $('#modals').modal('hide');
                    toggleSpinner(false, "");
                    $('#example').DataTable().ajax.reload();
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

        function getPlatformField() {
            $.get("{{ url('partial/view-select') }}", function(data, status) {
                platformContainer = data;
            });
            
        }

        function dynamic_field(counter, $idModal) {
            $($idModal).append(platformContainer);
        }

        //img preview add
        $(document).on('change', '#image-add', function(e) {
            e.preventDefault();
            let reader = new FileReader();
            reader.onload = (evt) => {
                $('#image-preview-container-add').attr('src', evt.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            $("#clear-image-add").attr("hidden", false);
            $("#upload-text").attr("hidden", true);
        });


        //img remove preview add
        $(document).on('click', '#clear-image-add', function(e) {
            e.preventDefault();
            $('#image-preview-container-add').attr('src', '');
            $("#form-add-link")[0].reset();
            $("#clear-image-add").attr("hidden", true);
            $("#upload-text").attr("hidden", false);
        });

        //clear form modal add link
        $('#modal-add-link').on('hidden.bs.modal', function(e) {
            $('#modal-dynamic-form-add').html('');
            $(this).find('form').trigger('reset');
            $('#image-preview-container-add').attr('src', "");
            $('#form-platform-add').attr('src', "");
            $('#form-custom-add').attr('src', "");
            counter = 0;
        })

        //add and remove platform new link
        $(document).on('click', '#add-link-platform', function() {
            dynamic_field(counter, '#modal-dynamic-form-add');
            counter++;
        });

        $(document).on('click', '.remove', function() {
            $(this).closest('.form-group').remove();
            let idPlatform = ($(this).parents('div[class="form-row"]').find('#logoContainer').find('img').attr('data-platform'));
            $(`[data-id-platform="${idPlatform}"]`).show();
        });


        $(document).on('submit', '#form-add-link', function(event) {
            event.preventDefault();
            var files = $('#image-add').get(0).files;
            formData = new FormData();
            link_title = $('input[name="link_title"]').val()
            video_embed_url = $('input[name="video_embed_url"]').val()

            // getting data
            var data_platform = $("img[name='data_platform[]']")
                .map(function() {
                    return ' ' + $(this).attr('data-value');
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
            //appending data to sent
            formData.append('link_title', link_title);
            formData.append('image', files[0]); //only 1 image, the first index     
            formData.append('id_platforms', id_platforms);
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
                , contentType: false
                , processData: false
                , beforeSend: function() {
                    toggleSpinner(true, "Submitting Your Data");
                }
                , success: function(data) {
                    $('#example').DataTable().ajax.reload();
                    toggleSpinner(false, "");
                    $('#modals .dynamic-modal-container').html(data)
                    $('#modals').modal('show');
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    toggleSpinner(false, "");
                    let returnMessage = JSON.parse(xhr.responseText)
                    Swal.fire({
                        title: ajaxOptions + '!'
                        , text: returnMessage.error || returnMessage.errors.image.join()
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })

                    toggleSpinner(false, "");
                }
            })
        });
        //img preview edit
        $(document).on("change", "#image", function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $("#image-preview-container").attr("src", e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
            $("#userErasingImage").val(false);
            $("#clear-image").attr("hidden", false);
            $("#upload-text").attr("hidden", true);
        });

        //img remove preview edit
        $(document).on("click", "#clear-image", function(e) {
            e.preventDefault();
            $("#image-preview-container").attr("src", "");
            $("#form-platform")[0].reset(); //menghilangkan file gambar
            $("#userErasingImage").val(true);
            $("#clear-image").attr("hidden", true);
            $("#upload-text").attr("hidden", false);
        });

        //clear form edit
        $("#modal-edit").on("hidden.bs.modal", function(e) {
            $("#modal-dynamic-form").html("");
            $(this).find("form").trigger("reset");
            $("#image-preview-container").attr("src", "");
            $("#form-platform").attr("src", "");
            $("#form-custom").attr("src", "");
            counter = 0;
        });

        //add platform edit
        // remove nya di onclick .remove
        $(document).on("click", "#add", function() {
            dynamic_field(counter, "#modal-dynamic-form");
            counter++;
        });

        $(document).on("click", "#selectAddPlatform a", function(e) {
            //ketika pilih platform di select
            e.preventDefault();
            var temp = $(platformContainer);
            $(temp).find('#logoContainer').html(
                '<img src="https://res.cloudinary.com/dfpmdlf8l/image/upload/'+$(this).attr('data-img')  
                +'" name="data_platform[]"'
                +'data-id-platform="0' 
                +'" name="data_platform[]"'
                +'data-platform="'+$(this).attr('data-id-platform')+'"'
                + 'data-value="' +$(this).attr('data-id-platform')+'"'
                +'style="max-width: 100%;max-height: 100%;height: 41px;">')
            $('#modal-dynamic-form').append(temp);
            $(this).hide();
        });

      
    });

</script>



@endpush
