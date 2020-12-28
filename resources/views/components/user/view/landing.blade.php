@extends('components.user.layouts.default')


@section('title', __('Daftar Link'))


@section('content')
@include('components/user/components/navbar')
@include('components/user/components/header')
<div id="music-link__create" class="music-link__create" style="margin-top:3em">
    <div class="presignup-links p-3 mb-3">
        <span style='font-family:"Rubik";font-size:1.4em;margin-right:0.5em;display:inline-block;color:#444;'>Your Links</span>
        <div class="presignup-links__list" id="dynamic-temp-link">
        </div>
    </div>

    
    <div class="music-link__inputs-container" style='border-radius:1px;padding:4.5em 1em 1em 1em;'>
        <form method="post" id="dynamic_form" enctype="multipart/form-data">
            <div class="music-link__top-block">
                <div class="music-link__top-block-left">
                    <div class="music-link__artwork-card">
                        <div class="music-link__artwork-delete">&times;</div>
                        <img class="music-link__artwork">
                        <div>
                            <label>
                                <input class="music-link__artwork-checkbox" type="checkbox" style='margin:0.5em 0.5em 0 0;font-size:0.75em'>Embed artwork
                            </label>
                        </div>
                    </div>
                    <!-- <form method="post" id="dynamic_form"> -->


                    <div class="music-link__upload-art">
                        <ion-icon name="download-outline" />

                        <b style=" font-weight: 500; margin-bottom: '0.5em'">
                            Upload Image
                        </b>
                        <p style="font-size: '0.8em'; opacity: '0.8' ">
                            jpg | jpeg | png
                        </p>
                        <p style="font-size: '0.8em'; opacity: '0.8' ">Max 10MB</p>
                        <p style="font-size: '0.8em'; opacity: '0.8' ">
                            Drop file here.
                        </p>
                        <img id="image-preview-container" src="" style="max-height: 150px;">
                        <input id="image" class="music-link__upload-input" type="file" name="image" accept="image/*" />
                    </div>
                    <button id="clear-image" hidden> clear</button>
                </div>
                <div class="music-link__top-block-right">
                    <div class="form-group">
                        <div class='music-link__platform__input'>
                            <label class='d-block' style='color:#444'>Link Title</label>
                            <input type="text" name="link_title" class="music-link__name" placeholder='Song, album, or artist title'>
                        </div>
                    </div>
                    <div class='music-link__platform__input'>
                        <div>
                            <label>
                                <input class="music-link__youtube-embed-checkbox" type="checkbox" id="checkbox" style='margin-right:1em;width:auto'>Embed YouTube Video
                            </label>
                        </div>
                        <div class="music-link__youtube-embed ">
                            <input disabled type="text" name="embed_url_video" id="embedVideo" class="music-link__youtube" placeholder='E.g. youtube.com/watch?v=dQw4w9WgXcQ'>

                            <div class="music-link__youtube-card">
                                <img class="music-link__youtube-thumbnail" height="75" width="110">
                                <div>
                                    <p class="music-link__youtube-title"></p>
                                    <small class="music-link__youtube-description"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <label class='d-block' style='color:#444'>Your platforms:</label>
            <div class="music-link__platforms" id="dynamic_platform">

                <button type="button" name="add" id="add" class="btn btn-outline-secondary">Add New Row</button>
                
                
                <span id="result"></span>
                {{-- <div class="table-responsive">
                    <table class="table table-borderless " id="user_table">
                        <tbody id="select-master">
                        </tbody>
                    </table>
                </div> --}}
                <div id="modal-dynamic-form"></div>
            </div>
            <div>
                <p class="music-link__error"></p>
                {{-- <input type="submit" name="save" id="save" class="btn btn-red mr-1 music-link__create-btn music-link__create-btn--landing py-3" value="Create Link"> --}}
                <button type="submit" class="btn btn-danger btn-lg btn-block">Create Link</button>
                <!-- <button class='btn btn-red mr-1 music-link__create-btn music-link__create-btn--landing py-3'></button> -->
        </form>
        <div style='padding:0.5em;text-align:center'>
            <p style='font-size:0.8em;color:#a5a5a5'>By using this service, you agree to
                ListenTo's
                <a href="../terms" style='color:#a5a5a5'>Terms of Service</a> and <a href="../privacy" style='color:#a5a5a5'>Privacy Policy.</a></p>
        </div>
    </div>
</div>


</div>
@include('components/user/components/sponsors')
@include('components/user/components/spinner')
@include('components/user/components/modal-master')
@include('components/user/components/alert')

@endsection




@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/landing.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navbar.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">  

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/music-links.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/spinner.css') }}">
@endpush


@push('javascript')
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>
<script>


</script>
<script>
    $(document).ready(function() {
        var count = 0;
        var platformContainer;
        dynamic_field(count);
        {{-- createTempLink(); --}}
        function dynamic_field() {
            $.get("{{ url('partial/view-select') }}", function(data, status) {
                platformContainer = data;
                $('#modal-dynamic-form').append(platformContainer);
            });
        }
        count++;
            $('select.selectpicker').selectpicker();

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

        //delete temp link when entering dashboard
        $("#btn-dashboard").click(function() {
            // localStorage.removeItem('links');
            localStorage.clear();
        });

        function createTempLink() {
            dataLink = JSON.parse(localStorage.getItem('links')) || [];
            dataLink.forEach(function(data) {
                $('#dynamic-temp-link').append(`
                <div class="presignup-link" style="overflow:hidden" id="dynamic-temp-link">
                <a class="mr-2" target="_blank" style="display:inline-block;font-weight:bold;color:#1a436d" href="preview/${data.link}">
                    hard.co.ded/${data.link}
                </a>
                <span style="color:#888;font-size:0.85em">${data.title}</span>
                <div class="presignup-link__buttons" style="float:right">

                <a href="/dasboard" class="btn btn-sm btn-secondary mr-1">Edit</a><a target="_blank" href="preview/${data.link}" class="btn btn-sm btn-secondary ">View
                    </a></div>
            </div>
                `);
            });
        }



        $(document).on('click', '#add', function() {
            count++;
            $(platformContainer).appendTo("#modal-dynamic-form");
        });

        $(document).on('click', '.remove', function() {
            count--;
        $(this).closest('.form-group').remove();
        });

        $('#checkbox').click(function() {
            if ($(this).prop("checked") == true) {
                $("#embedVideo").attr("disabled", false);
            } else {
                $("#embedVideo").attr("disabled", true);
                $('#embedVideo').val('')
            }
        });

        $('#dynamic_form').on('submit', function(event) {
            event.preventDefault();
            var IsValid = $("#dynamic_form").valid();
            if (IsValid) {

                var files = $('#image').get(0).files;
                formData = new FormData();
                link_title = $('input[name="link_title"]').val()
                embed_url_video = $('input[name="embed_url_video"]').val()

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
                {{-- console.log('data_platform', data_platform) --}}
                {{-- console.log('data_url_platform', data_url_platform) --}}
                {{-- console.log('data_text', data_text) --}}
                {{-- console.log('files[0]', files[0]) --}}

                //appending data to sent
                formData.append('link_title', link_title);
                formData.append('image', files[0]); //only 1 image, the first index     
                formData.append('video_embed_url', embed_url_video);
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
                    {{-- , dataType: 'json' --}}
                    , contentType: false
                    , processData: false
                    , beforeSend: function() {
                        toggleSpinner(true, "Submitting Your Data");
                    }
                    , success: function(html) {

                        //ini yg lama yg gapake mdal
                        {{-- var a = [];
                        alert("what");
                        dataLink = JSON.parse(localStorage.getItem('links')) || [];
                        dataLink.push(data.result);
                        localStorage.setItem('links', JSON.stringify(dataLink))
                        toggleSpinner(false, "");
                        window.location.reload(); --}}
                        
                        //ini yg baru dgn modal konfirmasi
                        toggleSpinner(false, "");
                        $('#modals .dynamic-modal-container').html(html)
                        $('#modals').modal('show');

                    }
                    , error: function(xhr, ajaxOptions, thrownError) {
                        let returnMessage = JSON.parse(xhr.responseText)
                        toggleSpinner(false, "");
                        toggleAlert(true, "error", ajaxOptions, returnMessage.failed);
                    }
                })
            }
        });
    });

</script>

<script type="text/javascript" src="{{ asset('assets/js/form-validation.js') }}"></script>
@endpush
