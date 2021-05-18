@extends('components.user.layouts.default')


@section('title', __('Detail Link'))


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
                                        <h3>Detail Link <a href="{{ url('m/' .$data['link'][0]['short_link']) }}" target="__blank">{{$data['link'][0]['short_link']}}</a></h3>
                                        @if(session()->has('admin'))
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

                                                <h3 class="profile-username text-center">{{$data['link'][0]['title']}}</h3>

                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        <b>Visit count</b> <a class="float-right">{{$data['link'][0]['count']}}</a>
                                                        <img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Jumlah kunjungan ke kedalam Link Anda" />
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Status</b> <a class="float-right">
                                                        @if($data['link'][0]['show_status'] == 2)
                                                            Dibanned
                                                        @else
                                                            Normal
                                                        @endif
                                                        </a>
                                                    </li>
                                                </ul>


                                                <div style="text-align:center">
                                                <button id='reportInfoBtn' class='btn btn-info'>Lihat Laporan Pengunjung</button>
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <div class="card">
                                            <div class="card-header border-0">
                                                <h3 class="card-title">Clickthroughs
                                                    <img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Jumlah klik pada tiap platform" />
                                                </h3>
                                                <div class="card-tools">
                                                    <a href="#" class="btn btn-tool btn-sm">
                                                        <i class="fas fa-bars"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body table-responsive p-0" style="max-height:250px; overflow:scroll;">
                                                <table class="table table-striped table-valign-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>Platform</th>
                                                            <th>Visits</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data['platform'] as $key => $platform)
                                                        <tr>
                                                            {{-- <td>{{ print_r($platform) }}</td> --}}
                                                            <td>
                                                                <a target="__blank" href="{{$platform->url_platform }}">
                                                                    {{$platform->url_platform }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                {{ $platform->count }}
                                                            </td>
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header border-0">
                                                <h3 class="card-title">Referring Domains
                                                    <img src="{{asset('images/icons/question-circle.svg')}}" style="margin-bottom: 10px;" data-toggle="tooltip" title="Asal domain seseorang yang mengunjungi Link Anda" />
                                                </h3>
                                                <div class="card-tools">
                                                    <a href="#" class="btn btn-tool btn-sm">
                                                        <i class="fas fa-bars"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body table-responsive p-0" style="max-height:250px; overflow:scroll;">
                                                <table class="table table-striped table-valign-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>Referer</th>
                                                            <th>Count</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data['referer'] as $key => $referer)
                                                        <tr>
                                                            {{-- <td>{{ print_r($platform) }}</td> --}}
                                                            <td>
                                                                {{$referer->referer }}
                                                            </td>
                                                            <td>
                                                                {{ $referer->count }}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <form class="form-inline" id="form-visit-chart">
                                                    <label>Bulan</label>
                                                    <div class="form-group col-md-2">
                                                        <select id="visit-mth" class="form-control">
                                                             @foreach($monthList as $key => $month)
                                                            <option @php if(date("m")==$month['urutan']){ echo "selected" ;}; @endphp value="{{$month['urutan']}}">{{$month['bulan']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label>Tahun</label>
                                                    <div class="form-group col-md-4">
                                                        <select id="visit-year" class="form-control">
                                                        @unless($yearList)
                                                            <option value="2021">2021</option>
                                                        @endunless
                                                            @foreach($yearList as $key => $year)
                                                            <option @php if(date("Y")==$year){ echo "selected" ;}; @endphp value="{{$year}}">{{$year}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                                </form>
                                                <div class="d-flex">
                                                    <p class="d-flex flex-column">
                                                        <span class="text-bold text-lg" id="visitorThisMth">{{$data['link'][0]['count']}}</span>
                                                        <span>Visitors This Month</span>
                                                    </p>
                                                </div>
                                                <div class="position-relative mb-4">
                                                    <canvas id="visitors-chart" height="200"></canvas>
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
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/landing.css') }}"> --}}
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/app.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/adminlte.min.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
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
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>
<script>
    $(function() {
        var calendar = {!!json_encode($calendar) !!};
        calendar = Object.keys(calendar)
        var visits = {!!json_encode($visits) !!};
        visits = Object.values(visits)
        var maxVisit = {!!json_encode($maxVisit) !!};

        var ticksStyle = {
            fontColor: '#495057'
            , fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true
        var $visitorsChart = $('#visitors-chart')
        var visitorsChart = new Chart($visitorsChart, {
            data: {
                labels: calendar
                , datasets: [{
                    type: 'line'
                    , data: visits
                    , backgroundColor: 'transparent'
                    , borderColor: '#007bff'
                    , pointBorderColor: '#007bff'
                    , pointBackgroundColor: '#007bff'
                    , fill: false
                    // pointHoverBackgroundColor: '#007bff',
                    // pointHoverBorderColor    : '#007bff'
                }]
            }
            , options: {
                maintainAspectRatio: false
                , tooltips: {
                    mode: mode
                    , intersect: intersect
                }
                , hover: {
                    mode: mode
                    , intersect: intersect
                }
                , legend: {
                    display: false
                }
                , scales: {
                    yAxes: [{
                        gridLines: {
                            display: true
                            , lineWidth: '4px'
                            , color: 'rgba(0, 0, 0, .2)'
                            , zeroLineColor: 'transparent'
                        }
                        , ticks: $.extend({
                            beginAtZero: true
                            , stepSize: 1
                            , suggestedMax: maxVisit
                        }, ticksStyle)
                    }]
                    , xAxes: [{
                        display: true
                        , gridLines: {
                            display: false
                        }
                        , ticks: ticksStyle
                    }]
                }
            }
        })



        //updating visit chart
        function updateConfigAsNewObject(chartData) {
            visitorsChart.data.datasets[0].data = chartData.arrDaysInMth;
            visitorsChart.data.labels = Object.keys(chartData.calendar);
            visitorsChart.options.scales.yAxes[0].ticks.suggestedMax = chartData.maxVisit;
            $('#visitorThisMth').text(chartData.visitsInMonth)
            visitorsChart.update();
        }



        $(document).on('submit', '#form-visit-chart', function(event) {
            event.preventDefault();
            linkId = {!!$data['link'][0]['id'] !!}
            month = $('#visit-mth').val();
            year = $('#visit-year').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , dataType: "JSON"
                , url: '{{ url("getCountLinkChart") }}'
                , method: 'get'
                , data: {
                    linkId: linkId
                    , month: month
                    , year: year
                }
                , beforeSend: function() {
                    toggleSpinner(true, "Processing request");
                }
                , success: function(chartData) {
                    toggleSpinner(false, "") 
                    updateConfigAsNewObject(chartData)
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
                , complete: function() {}
            })
        });


        $(document).on('click', '#reportInfoBtn ', function() {
             idLink = {!!$data['link'][0]['id']!!}
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{ url("admin/modal/report-info") }}'
                , data: {
                    idLink: idLink
                }
                , method: 'get'
                , success: function(linksPlatform) {
                    $('#modals .dynamic-modal-container').html(linksPlatform)
                    $('#modals').modal('show');
                    initDatatable(idLink);
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
        })

        function initDatatable(linkId){
            var table2 = $('#example2').DataTable({
            "dom": 'lf<"toolbar">rtip'
            , processing: true
            , serverSide: true
            , ajax: {
                "url" : "{{ route('admin.reports-by-link') }}"
                , data: {linkId: linkId}
                }
            , columns: [{
                    data: 'shortLink'
                    , name: 'shortLink'
                }
               
            , ]
        });
        }

    })
</script>
@endpush
