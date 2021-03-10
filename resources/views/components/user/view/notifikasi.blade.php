@extends('components.user.layouts.default')


@section('title', __('Notifikasi'))


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
                                        <h3>Notifikasi</h3>
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
                                                <h3 class="profile-username text-center">Notifikasi</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-6 col-md-4">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Notifikasi</h3>
                                            </div>

                                            @include('components.admin.components.spinner')
                                            <div class="card-body">
                                                <div class="table-responsive ">
                                                    <table id="example" class="table table-bordered table-striped table-hover users-table mb-2">
                                                        <thead>
                                                            <tr>
                                                            <th>Status</th>
                                                                <th>Pesan</th>
                                                                <th>Tanggal</th>
                                                                <th>Perihal</th>
                                                                {{-- <th>Actions <img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Tombol Publish membuat Platform dapat dipilih pengguna. tombol hide membuat tidak dapat dipilih pengguna" /></th> --}}
                                                            </tr>
                                                        </thead>

                                                        <tbody></tbody>
                                                    </table>
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
        </div>
</div>
</section>

</div>
@endsection

@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/adminlte.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/music-links.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/form-validation.css') }}">
@endpush


@push('javascript')
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<script type="text/javascript" src=" {{ asset('assets/js/chart/Chart.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/spinner.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>
<script>
    $(document).ready(function() {
        counter = 0;
        //server side
        var table = $('#example').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('table.all-notifications') }}"
            , columnDefs: [ { type: 'date', 'targets': [2] } ]
            , order: [[ 2, 'desc' ]]
            , columns: [{
                    data: null
                    , render: function(data, type, row) {
                        if(row.read_at){
                            return `<i class="far fa-envelope-open"></i>`;
                        }
                        else{
                            return `<i class="far fa-envelope"></i>`;
                        }
                    }
                    , orderable: false
                }
                , {
                    data: 'data'
                    , name: 'data'
                    , orderable: false
                }
                , {
                    data: 'created_at'
                    , name: 'created_at'
                }
                , {
                    data: 'notifiable_type'
                    , name: 'notifiable_type'
                }
            , ]
        });
    });
    </script>
@endpush
