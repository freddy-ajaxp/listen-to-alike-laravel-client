<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Landing</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/music-links.css') }}">
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
            z-index: 5555;
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

        @media(max-width:1100px) {
            .platforms-list__name {
                font-size: 1.1em;
            }
        }

        @media(max-width:700px) {
            .platforms-list__name {
                font-size: 1em;
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

        .music-link__logo {
            float: left;
            width: 7em;
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

        #youtube_video {
            max-width: 400px;
        }

        #content,
        #youtube_video {
            max-width: 600px;
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
</head>

<body>
    <div id="container" class="container">
        <div id="bg_container" style='display:none'>
            <img id="bg_img" />
        </div>



        <div id="content">
            <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{$data['link'][0]['video_embed_url']}}">

                <div id="youtube_video">

                </div>
            </div>
            <h1 class="platforms-list__name">
                 {{$data['link'][0]['title']}}
            </h1>
            <div class="platforms-list__container">
                <div class="platform-list" id='dynamic-platform'>
                    @foreach($data['platforms'] as $data)
                    <div class='music-link__container' data-url="{{$data['url_platform'] }}">
                        <img class='music-link__logo' src="{{$data['jenis_platform'] }}" alt="{{$data['jenis_platform'] }}">
                        <button class='music-link__button' data-url="{{$data['url_platform'] }}">{{$data['text'] }}</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div style='position:relative;margin-bottom:1em;z-index:50'>
            <a target="_blank" style='color:#ccc;text-decoration: none;font-family:"Segoe UI",Helvetica,Arial,sans-serif;font-size:11px' href="https://li.sten.to/privacy">Privacy &amp; Cookies</a>
        </div>
    </div>
</body>

</html>


<script src="https://cdn.plyr.io/3.6.3/plyr.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    const player = new Plyr('#player');
</script>