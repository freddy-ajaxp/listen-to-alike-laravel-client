@extends('components.admin.layouts.default')


@section('title', __('Pengaturan Platform'))


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New Platform</h3>
                    </div>
                    <form id="form-platform" action="/admin/addPlatform" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Platform Name</label>
                                <input required name="platform_name" type="text" class="form-control" placeholder="cth: soundcloud">
                            </div>
                            <div class="form-group">
                                <label>Platform URL</label>
                                <input type="text" class="form-control" name="platform_url" placeholder="cth: https://soundcloud.com/">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Logo (format .SVG / .PNG)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="svg" id="svg" type="file" accept="image/*" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align:center">
                                <img id="image-preview-container" src="" style="max-height: 150px; max-width: 100%;">
                                <button id="clear-image" hidden> clear</button>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Platform List</h3>
                    </div>

                    @include('components.admin.components.spinner')
                    <div class="card-body">
                        <div class="table-responsive ">
                            <table id="example" class="table table-bordered table-striped table-hover users-table mb-2">
                                <thead>
                                    <tr>
                                        <th>Platform</th>
                                        <th>Image</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Actions <img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Tombol Publish membuat Platform dapat dipilih pengguna. tombol hide membuat tidak dapat dipilih pengguna"/></th>
                                    </tr>
                                </thead>

                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

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
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/adminlte.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
<script>
    //init datatable

    $(document).ready(function() {
        counter = 0;

        //server side
        var table = $('#example').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.all-platforms') }}"
            , columns: [{
                    data: 'platform_name'
                    , name: 'platform_name'
                }
                , {
                    data: null
                    , render: function(data, type, row) {
                        return `<img src="https://res.cloudinary.com/dfpmdlf8l/image/upload/${row.logo_image_path}",width=60px, height=30px />`
                    }
                    , orderable: false
                }
                , {
                    data: 'platform_regex'
                    , name: 'platform_regex'
                }
                 , {
                    data: null
                    , render: function(data, type, row) {
                        if (row.deletedAt) {
                            return 'Hidden';
                        } else {
                            return 'Aktif';
                        }
                    },
                    orderable: false
                    , searchable: true
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });

         var tableText = $('#table-text').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.all-texts') }}"
            , columns: [{
                    data: 'text'
                    , name: 'text'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ]
        });

         //img preview edit
        $(document).on('change','#image',function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image-preview-container-edit').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            $("#userErasingImage").val(false);
            $("#clear-image-platform").attr("hidden", false);    
        });

        $(document).on('click','#clear-image-platform',function(e){
            e.preventDefault();
            $('#image-preview-container-edit').attr('src', '');
            $("#form-platform-edit")[0].reset(); //menghilangkan file gambar
            $("#userErasingImage").val(true);
            $("#clear-image-platform").attr("hidden", true); 
        });

        $('#example tbody').on('click', '#deleteLogoBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $('#id_delete_logo').val(data.id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/delete-platform") }}'
                , method: 'get'
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    $('#id_delete_logo').val(data.id);
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
        });

        $('#example tbody').on('click', '#editLogoBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/edit-platform") }}'
                , method: 'get'
                , data: {
                    id: data.id
                }
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    $('#id_delete_logo').val(data.id);
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText);
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: returnMessage.error
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            , })
        })

         $('#example tbody').on('click', '#hideLogoBtn', function(e) {
             e.preventDefault()

            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/hidePlatform") }}'
                , method: 'post'
                , data: {
                    id: data.id
                }
                , success: function(linksPlatform) {
                    $('#example').DataTable().ajax.reload();
                    $('#modals').modal('hide');
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
        });
        
         $('#example tbody').on('click', '#publishLogoBtn', function() {
            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/publishPlatform") }}'
                , method: 'post'
                , data: {
                    id: data.id
                }
                , success: function(linksPlatform) {
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
        });

        //img preview
        $('#svg').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image-preview-container').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            $("#clear-image").attr("hidden", false);
        });

        //img preview deleted
        $('#clear-image').click(function(e) {
            e.preventDefault();
            $('#image-preview-container').attr('src', '');
            $('#svg').val('');
            $("#clear-image").attr("hidden", true);
        });
        //reset all form on modal close
        $('#modals').on('hidden.bs.modal', function() {
                $('#form-platform')[0].reset();
        });

        //submit form logo
        $('#form-platform').on('submit', function(event) {
            event.preventDefault();
            var files = $('#svg').get(0).files;
            formData = new FormData();
            platform_name = $('input[name="platform_name"]').val()
            platform_url = $('input[name="platform_url"]').val()
            formData.append('platform_name', platform_name);
            formData.append('platform_url', platform_url);
            if(files.length != 0){
                if(!validasiFileExt(files)){
                    Swal.fire({
                        title: "Error"
                        , text: "Harap piih file dengan format yang ditentukan"
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                    return 0;
                }
                else {
                    formData.append('image', files[0]); //only 1 image, the first index
                }
            }
            console.log(files)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , enctype: 'multipart/form-data'
                , url: '{{ route("admin.add-platform") }}'
                , method: 'post'
                , data: formData
                , dataType: 'json'
                , contentType: false
                , processData: false
                , beforeSend: function() {
                    {
                        toggleSpinner(true, "Processing your request");
                    }
                }
                , success: function(data) {
                    {
                        toggleSpinner(false, "");
                        $('#form-platform')[0].reset();
                        $('#image-preview-container').attr('src', '');
                        $('#svg').val('');
                        $("#clear-image").attr("hidden", true);
                        $('#example').DataTable().ajax.reload();
                        
                    }
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    toggleSpinner(false, "");
                    let returnMessage = JSON.parse(xhr.responseText)
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: returnMessage.error || returnMessage.errors.image.join()
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });

        //submit edit platform
        $(document).on('submit', "#form-platform-edit" ,  function(event) {
            event.preventDefault();
            var files = $('#image').get(0).files;
            formData = new FormData();
            id = $('#id').val()
            userErasingImage = $('#userErasingImage').val()
            //appending data to sent
            formData.append('id', id);
            formData.append('userErasingImage', userErasingImage);
            if(files.length !== 0){
                validasiFileExt(files);
            formData.append('image', files[0]); //only 1 image, the first index
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , enctype: 'multipart/form-data'
                , url: '{{ url("admin/editPlatform") }}'
                , method: 'post'
                , data: formData
                , dataType: 'json'
                , contentType: false
                , processData: false
                , beforeSend: function() {
                    {
                        toggleSpinner(true, "Processing your request");
                    }
                }
                , success: function(data) {
                    {
                        $('#modals').modal('hide');
                        toggleSpinner(false, "");
                        $('#example').DataTable().ajax.reload();
                    }
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText)
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: returnMessage.error || returnMessage.errors.image.join()
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });

        //submit form delete logo
        $(document).on('submit', "#form-delete-logo" ,  function(event) {
            event.preventDefault();
            id_logo = $('#id_delete_logo').val()
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ route("admin.delete-platform") }}'
                , method: 'post'
                , data: {
                    id: id_logo
                , }
                , dataType: 'json'
                , beforeSend: function() {
                    {
                        toggleSpinner(true, "Deleting Logo");
                    }
                }
                , success: function(data) {
                    {
                        $('#modals').modal('toggle');
                        toggleSpinner(false, "");
                        $('#example').DataTable().ajax.reload();
                    }
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    let returnMessage = JSON.parse(xhr.responseText)
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: returnMessage.error
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });
    });


function validasiFileExt(files){
    var validImageTypes = ["image/svg", "image/png", "image/svg+xml"];
                if ($.inArray(files[0].type, validImageTypes) < 0) {
                    return false;
                }
                else {
                    return true;
                    }
}
</script>
@endpush
