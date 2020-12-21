<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/laravel.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/landing.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/music-links.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/spinner.css') }}">
</head>

<body>
    <div class="App">
        <div class="section section-1" style="background-image: url('images/background.jpg');
                background-size: cover;
              background-position: center center;
              background-attachment: fixed;" `>
            <div class="section-1-bg" style="background:linear-gradient( to right,rgb(6, 34, 62),rgba(5, 32, 68, 0.66));">
            @yield('content')
                @include('components/navbar')
                @include('components/header')
                @include('components/form_link')
                @include('components/platform_icons')


            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- <script src="{{ asset('index.js')}}"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/landing.css') }}"> -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
<script>
    $(document).ready(function() {
        var count = 0;
        dynamic_field(count);
        createTempLink();
        count++;

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
                <div class="presignup-link__buttons" style="float:right"><button class="btn btn-sm presignup-link__copy btn-secondary mr-1">Copy</button><a href="/register" class="btn btn-sm btn-secondary presignup-link__edit mr-1">Edit</a><a target="_blank" href="https://li.sten.to/iHl6het" class="btn btn-sm btn-secondary presignup-link__copy">View
                    </a></div>
            </div>
                `);
            });
        }

        function dynamic_field(number) {
            html = '<tr>';
            html += `
            <div class="music-link__platform" data-platform='spotify'>
            <td style="width: 20%">
            <div>
                        <label for="form-control form-control-sm"> Platform </label>
                    </div>
                <select name="data_platform[]" class="form-control form-control-sm">
                        <option disabled selected value=null>Platform</option>
                        <option value="Youtube" >Youtube</option>
                        <option value="Spotify">Spotify</option>
                    </select>
                                </td>`;
            html += `
            <td style="width: 50%">
            <div class="form-group">
            <div class='music-link__platform__input music-link__platform__input__url'>
                <div>
                <label for="music-link__platform__url-input">URL</label>
                </div>
                <input type="text" id="platform${count}" name="data_url_platform[]" class="music-link__platform__url-input" placeholder="Enter Platform link"/>
            </div>
            </div>
            </td>`;
            html += `
            <td style="width: 20%">
            <div class='music-link__platform__input music-link__platform__input__button'>
                    <div>
                        <label> Button Text</label>
                    </div>
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
                        <option value="Discover">Discover</option>
                    </select>
                </div>
            </td>`;


            if (number > 1) {
                html += `<td style="width: 10%"> 
                        <div class="music-link__reposition">
            <button type="button" name="remove" id="" class="btn btn-danger remove">X</button>
            </div>
            </td></tr>`;
                $('tbody').append(html);
            } else {
                html += `<td style="width: 10%"> 
                        <div class="music-link__reposition">
                               <button type="button" name="remove" id="" class="btn btn-danger remove">X</button>
                            </div>
                              </td></tr>`;
                $('tbody').html(html);
            }
        }

        $(document).on('click', '#add', function() {
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function() {
            count--;
            $(this).closest("tr").remove();
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
                console.log('data_platform', data_platform)
                console.log('data_url_platform', data_url_platform)
                console.log('data_text', data_text)
                console.log('files[0]', files[0])


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
                    },
                    enctype: 'multipart/form-data',
                    url: '{{ route("dynamic-field.insert") }}',
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {},
                    success: function(data) {
                        var a = [];
                        dataLink = JSON.parse(localStorage.getItem('links')) || [];
                        dataLink.push(data.result);
                        localStorage.setItem('links', JSON.stringify(dataLink))
                        window.location.reload();
                    }
                })
            }
        });

    });
</script>
<script type="text/javascript" src="{{ asset('assets/js/form-validation.js') }}"></script>