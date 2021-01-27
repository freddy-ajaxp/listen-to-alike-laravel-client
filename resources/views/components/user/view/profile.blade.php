@extends('components.user.layouts.default')


@section('title', __('Profil'))


@section('content')
@include('components/user/components/navbar')
@include('components/user/components/modal-master')
@include('components/user/components/alert')
{{-- jika ingin side scrolling margin 250px dikiri --}}
{{-- <div class="content-wrapper">  --}}
<div class="section-1-bg" style="background:linear-gradient( to right,rgb(6, 34, 62),rgba(5, 32, 68, 0.66));">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="container-fluid">
                                <div class="row ">
                                    <div class="col-sm-6">
                                        <h3>Profile and Settings</h3>
                                        @if(session()->has('admin') && session()->get('admin') == 1 )
                                        <a href="{{url('/admin')}}">
                                            < kembali</a>
                                                @else
                                                <a href="{{url('/dashboard')}}">
                                                    < kembali</a>
                                                        @endif

                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <h3 class="profile-username text-center">{{$data['name']}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Change Username</h3>
                                            </div>
                                            <form class="form-change-username" id="form-change-username">
                                                <div class="card-body">
                                                    <input type="hidden" class="form-control" id="id_user" value="{{ $data['id'] }}">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                                                        <div class="col-sm-9">
                                                            <input type="email" disabled class="form-control" id="email" aria-describedby="basic-addon3" placeholder="User's Email" value="{{ $data['email'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text"  class="form-control" id="name" aria-describedby="basic-addon3" placeholder="User's Email" value="{{ $data['name'] }}" minlength="8">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info float-right">Change</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Change Password</h3>
                                            </div>
                                            <form id="form-change-password">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="password" class="col-sm-3 col-form-label">Old Password</label>
                                                        <div class="col-sm-9">
                                                            <input type="password" required class="form-control" name="pwd" id="old-password" placeholder="Enter your old password" minlength="8"  >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="password" class="col-sm-3 col-form-label">New Password</label>
                                                        <div class="col-sm-9">
                                                            <input type="password" required class="form-control" name="pwd" id="password" placeholder="Password minimal 8 characters" minlength="8" pattern=".{8,12}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="password-confirmation" class="col-sm-3 col-form-label">Re-enter New Password</label>
                                                        <div class="col-sm-9">
                                                            <input type="password" required class="form-control" name="pwd" id="password-confirmation" arplaceholder="Re-enter password" minlength="8" pattern=".{8,12}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class=" col-sm-10">
                                                            <div class="form-check">
                                                                <input type="checkbox" id="show-pwd"> <label for="show-pwd">Show Password</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-info float-right">Change</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>

</div>
@endsection

@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/adminlte.min.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/music-links.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-validation.css') }}">
@endpush


@push('javascript')
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<script type="text/javascript" src=" {{ asset('assets/js/chart/Chart.js') }}">
    <script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}">

</script>
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>
<script>
    $(document).ready(function() {
        //form change password
        $(document).on('submit', '#form-change-password', function(event) {
            event.preventDefault();
            id_user = $('#id_user').val();
            password = $('#password').val();
            oldpassword = $('#old-password').val();
            password2 = $('#password-confirmation').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("user/changePassword") }}'
                , method: 'post'
                , data: {
                    id: id_user
                    , name: name
                    , oldpassword: oldpassword
                    , password: password
                    , password2: password2
                }
                , beforeSend: function() {
                    toggleSpinner(true, "Processing request");
                }
                , success: function(data) {
                    toggleSpinner(false, "")
                    Swal.fire({
                        title: 'success'
                        , text: "update password success"
                        , icon: 'success'
                        , confirmButtonText: 'Confirm'
                    })
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: xhr.responseJSON.error
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
                , complete : function(){
                    $('#old-password').val("");
                    $('#password').val("");
                    $('#password-confirmation').val("");
                }
            })
        });

        $(document).on('submit', '#form-change-username', function(event) {
            event.preventDefault();
            id_user = $('#id_user').val();
            name = $('#name').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("user/changeUsername") }}'
                , method: 'post'
                , data: {
                    id: id_user
                    , name: name
                }
                , beforeSend: function() {
                    toggleSpinner(true, "Processing request");
                }
                , success: function(data) {
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'success'
                        , text: "update username success"
                        , icon: 'success'
                        , confirmButtonText: 'Confirm'
                    })
                    $('#password').val("");
                    $('#password-confirmation').val("");
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    toggleSpinner(false, "");
                    Swal.fire({
                        title: 'Oops! ' + ajaxOptions
                        , text: xhr.responseJSON.error
                        , icon: 'error'
                        , confirmButtonText: 'Confirm'
                    })
                }
            })
        });

        //show password on-mousedown
        $(document).on('click', '#show-pwd', function() {
            if ($('input:checkbox').is(':checked')) {
                $("input[name=pwd]").attr('type', 'text')
            } else if (!$('input:checkbox').is(':checked')) {
                $("input[name=pwd]").attr('type', 'password')
            }
        });

    });

</script>
@endpush
