@extends('components.user.layouts.default')
@section('title', $data['link'][0]['title'])
@push('stylesheets')
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/music-links.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2-overlay.css') }}">
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/plyr.css" />
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        overflow-x: hidden;
        background: #fff;
        display: flex;
        align-items: center;
        flex-direction: column;
        min-height: 100vh;
        padding: 0 1em;
    }

    #content {
        position: relative;
        padding: 0.5em;
        z-index: 555;
        width: 100%;
        margin: 0 auto 1em auto;
        max-width: 400px;
    }

    .platform-list {
        width: 100%;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 0 0 5px 5px;
        box-shadow: none;
        background: none;
    }

    .platforms-list__name {
        padding: 1.2em 1.5em;
        letter-spacing: 1px;
        text-align: center;
        font-family: 'Segoe UI', 'Helvetica', 'Arial', sans-serif;
        width: 100%;
        max-width: 40em;
        font-size: 1em;
        color: #fff;
        border-radius: 0;
        background: none;
        font-weight: bold;
        margin: 0.5em 0;

    }



    .platforms-list__container {
        width: 100%;
        margin-bottom: 1em;
    }

    #content,
    #youtube_video {
        max-width: 600px;
    }

    .music-link__logo {
        float: left;
        width: 7em;
    }

    @media(max-width:1100px) {
        .platforms-list__name {
            font-size: 1.1em;
        }
    }

    @media(max-width:700px) {
        .platforms-list__name {
            font-size: 1em;
        }

        #content,
        #youtube_video {
            max-width: 400px;
        }

        .music-link__logo {
            float: left;
            max-width: 60px;
        }

        .music-link__button {
            float: right;
            padding: 0.5em 1em;
            background: #fff;
            color: rgb(97 97 97);
            border: 1px solid rgb(218 218 218);
            font-weight: bold;
            border-radius: 25px;
            cursor: pointer;
            font-size: small;
            max-width: 70px;
        }
    }



    .music-link__container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7em 1em;
        border-top: 1px solid #f6f6f6;
        border-bottom: 1px solid #f6f6f6;
        width: 100%;
        overflow: hidden;
    }

    .music-link__container:last-child {
        border-bottom: none;
    }

    .music-link__text {
        text-align: center;
        font-weight: 500;
        width: 100%;
        font-family: 'Segoe UI', Helvetica, Arial, sans-serif;
    }



    .music-link__custom-platform {
        float: left;
        font-size: 1.1em;
        width: 100%;
        max-width: 12em;
        text-align: left;
        font-family: Arial;
        font-weight: 600;
        word-break: break-word;
    }

    .music-link__button {
        float: right;
        padding: 0.5em 1em;
        background: #fff;
        color: rgb(97 97 97);
        border: 1px solid rgb(218 218 218);
        font-weight: bold;
        border-radius: 25px;
        cursor: pointer;
    }

    .music-link__button:hover {
        background: rgb(60, 60, 60);
        border: 1px solid transparent;
        color: #fff;
    }

    /* Ads */
    .listento_ad {
        position: relative;
        font-family: 'Segoe UI', 'Helvetica', Arial, sans-serif;
        background: rgb(47, 103, 223);
        padding: 0.5em 1em;
        font-size: 0.9rem;
        border-radius: 5px;
        overflow: hidden;
    }

    .listento_ad b {
        display: inline-block;
        color: #fff;
        font-weight: 600;
        margin-bottom: 0.5em;
    }

    .listento_ad p {
        font-size: 0.85em;
        color: #fff;
        opacity: 0.75;
    }

    .listento_ad a {
        text-decoration: none;
        color: inherit;
    }

    .display_ad {
        display: flex;
        justify-content: center;
        position: relative;
        z-index: 555;
    }

    .mmtwrappos {
        position: relative;
        z-index: 5;
        padding: 10px;
        margin-bottom: 0 !important;
    }

    /* YouTube Embed */
    #youtube_video {
        margin-top: 1em;
        position: relative;
        width: 100%;
        background: #19202b;
        padding-bottom: 52.1%;
        /* 16:9 */
        padding-top: 25px;
    }

    #youtube_video iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }




    /* Themes */
    /* Common to all themes */

    #container {
        left: 0;
        right: 0;
        width: 100%;
        text-align: center;
    }

    /* Common to all except classic. Classic overrides this. */
    #user-artwork {
        border-radius: 5px;
    }

    .music-link__container:not(.music-link__container--custom-text):hover {
        cursor: pointer;
    }

    /* Themes */


    #container {
        position: absolute;
        top: 0;
        bottom: 0;
        background: #fff;
        background-size: cover;
        background-position: 0 -180px;
        height: 100vh;
    }

    #bg_container {
        position: fixed;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background-color: #000;
        -o-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0);
        -webkit-transform: translate3d(0, 0, 0);
    }

    #bg_img {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        min-width: 55%;
        min-height: 55%;
        -webkit-filter: blur(34px);
        -moz-filter: blur(34px);
        -o-filter: blur(34px);
        -ms-filter: blur(34px);
        filter: blur(34px);
    }

    .platform-list {
        background: #fff;
        box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.25);
    }

    .platforms-list__name {
        background: #222;
        font-weight: 400;
        margin: 0;
    }

    #user-artwork {
        border-radius: 5px 5px 0 0;
    }

    .music-link__container:not(.music-link__container--custom-text):hover {
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.2);
        border-top: 1px solid transparent;
        border-bottom: 1px solid transparent;
    }

    .music-link__container--custom-text {
        background: #f8f8f8;
    }

</style>
@endpush


@section('content')

<div id="container" class="container">

    {{-- menentukan gambar di background, gambar menjadi prioritas ditampilkan baru kemudian thumbnail video --}}
    <div id="bg_container" style="display: block;">
        @if($data['image_path'])
        <img id="bg_img" src="https://res.cloudinary.com/dfpmdlf8l/image/upload/{{$data['image_path']}}.jpg">
        @elseif($data['link'][0]['video_embed_url'])
        <img id="bg_img" src="https://img.youtube.com/vi/{{$data['video_id']}}/1.jpg">
        @else
        <img id="bg_img" src="https://images.pexels.com/photos/144429/pexels-photo-144429.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260">
        @endif
    </div>



    <div id="content">
        @if($data['link'][0]['video_embed_url'])
        <div id="youtube_video">
            <iframe id="videoFrame" src={{$data['link'][0]['video_embed_url']}} allowfullscreen="" frameborder="0">
            </iframe>
        </div>
        @endif
        @if($data['image_path'] && !$data['link'][0]['video_embed_url'])
        <img id="user-artwork" src="https://res.cloudinary.com/dfpmdlf8l/image/upload/{{$data['image_path']}}.jpg" style="display:block;width:100%;">
        @endif
        <input type="hidden" name="id-link" value="{{$data['link'][0]['id']}}" />
        <div>
            <h1 class="platforms-list__name">
                {{$data['link'][0]['title']}}
                <button id='shareBtn' data-url="{{config('constants.site_title')}}/m/{{$data['link'][0]['short_link']}}" class='btn btn-default'>
                    <span style="color: White;">
                        <i class='fas fa-copy'></i>
                    </span>
                </button>
            </h1>

        </div>


        <div class="platforms-list__container">
            <div class="platform-list" id='dynamic-platform'>

                @foreach($data['platforms'] as $platform)
                <div class='music-link__container' data-url="{{$platform['url_platform'] }}">
                    {{-- onerror=this.src="{{asset('images/icons/headphone.svg')}}" --}}
                    <img class='music-link__logo' src="https://res.cloudinary.com/dfpmdlf8l/image/upload/{{$platform->list_platform->logo_image_path }}" style="max-height:40px">
                    <button class='music-link__button' data-id-platform="{{$platform['id'] }}" data-url="{{$platform['url_platform'] }}">{{$platform->list_text->text }}</button>
                </div>
                @endforeach
            </div>
        </div>
        @if($data['image_path'] && $data['link'][0]['video_embed_url'])
        <img id="user-artwork" src="https://res.cloudinary.com/dfpmdlf8l/image/upload/{{$data['image_path']}}.jpg" style="display:block;width:100%;">
        @endif
    </div>
    <div style='position:relative;margin-bottom:1em;z-index:50'>
        {{-- <a target="_blank" style='color:#ccc;text-decoration: none;font-family:"Segoe UI",Helvetica,Arial,sans-serif;font-size:11px' href="https://li.sten.to/privacy">Privacy &amp; Cookies</a> --}}
    </div>
</div>
@include('components/user/components/report-button')
@endsection


@push('javascript')
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script>
    $(document).ready(function() {


        $('#videoFrame').on('load', function(e) {
            $(this).show();
        });

        $('.music-link__button').on('click', function(e) {
            var loadurl = $(this).attr('data-url');
            var idPlatform = $(this).attr('data-id-platform');
            var idLink = $("input[name='id-link']").val();
            var win = window.open(loadurl, '_blank');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("/click") }}'
                , method: 'post'
                , data: {
                    link_platform_id: idPlatform
                    , link_id: idLink
                }
                , dataType: 'json'
            })

            if (win) {
                //Browser has allowed it to be opened
                win.focus();
            } else {
                //Browser has blocked it
                alert('Please allow popups for this website');
            }


        });
    });


    $('#modals').on('hidden.bs.modal', function() {
        $('#form-report')[0].reset();
    });
    $(document).on('submit', '#form-report', function(e) {
        e.preventDefault();
        var idLink = $("input[name='id-link']").val();
        var messageText = $('textarea#reason').val();
        var reportedReasons = $('input[name="reasons[]"]:checked').map(function() {
            return $(this).data('id');
        }).get();
        if (!messageText && !reportedReasons.length) {
            Swal.fire({
                position: 'top'
                , title: 'Harap isi paling sedikit kolom "More"'
                , showConfirmButton: false
                , timer: 1000
            })
            return 0;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: '{{ url("/report") }}'
            , method: 'post'
            , data: {
                reasons: reportedReasons
                , messageText: messageText
                , idLink: idLink
            }
            , dataType: 'json'
            , beforeSend: function(xhr) {
                toggleSpinner(true, "Submitting your report");
            }
            , success: function(response) {
                toggleSpinner(false, "");
                $('#modals').modal('hide');
                Swal.fire({
                    title: 'success'
                    , text: response.success || "laporan Anda sudah kami terima"
                    , icon: 'success'
                    , confirmButtonText: 'Confirm'
                })
            }
            , error: function(xhr, ajaxOptions, thrownError) {
                let returnMessage = JSON.parse(xhr.responseText)
                toggleSpinner(false, "");
                Swal.fire({
                    title: ajaxOptions + '!'
                    , text: returnMessage.error || returnMessage.errors.image.join()
                    , icon: 'error'
                    , confirmButtonText: 'Confirm'
                })
            }
        })


    });


    $('#shareBtn').on('click', function() {
        copyText = $(this).data('url')
        var textarea = document.createElement("textarea");
        textarea.setAttribute("type", "hidden");
        textarea.textContent = copyText;
        textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        textarea.remove()
        Swal.fire({
            position: 'top'
            , title: 'URL link berhasil di copy'
            , showConfirmButton: false
            , timer: 1000
        })
    })

</script>

@endpush
