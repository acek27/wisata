@extends ('layout.layout')

@section('css')
    <link href="{{asset('datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('title')
    DASHBOARD
@endsection

@section('sub')
    PENGUNJUNG WISATA TAHUN {{(int)date('Y')}} KABUPATEN JEMBER
@endsection

@section('content')
    <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
    </div>
    <div class="content">
        <div class="col-lg-12">
            <div class="card card-chart">
                <div class="card-header">
                    <!-- Example single danger button -->
                    @if(session()->has('message'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                            </button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="btn-group">
                        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" style="color: white">
                            Export PDF by Year
                        </a>
                        <div class="dropdown-menu">
                            @php($start = date('Y'))
                            @php($end =$start-4)
                            @for($year = $start; $year >= $end; $year--)
                                <a class="dropdown-item" href="{{url('generatePDFAdmin/')}}/{{$year}}">{{$year}}</a>
                            @endfor
                        </div>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" style="color: white">
                            Export PDF by Month
                        </a>
                        <div class="dropdown-menu">
                            @php($bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli',
                       'Agustus','September','Oktober','November','Desember'])
                            @for($i = 0; $i < 12; $i++)
                                <a class="dropdown-item"
                                   href="{{url('/generatePDFMonth/')}}/{{$i+1}}">{{$bulan[$i]}}</a>
                            @endfor
                        </div>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" style="color: white">
                            Export PDF by Tourism Name
                        </a>
                        <div class="dropdown-menu">
                            @foreach($wisata as $nama)
                                <a class="dropdown-item"
                                   href="{{url('/generatePDFName/')}}/{{$nama->id}}">{{$nama->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <table class="table table-bordered" id="tabelPengunjung">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Wisata</th>
                            <th>Jumlah Wisatawan</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Keterangan</th>
                            <th>Asal</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
            maintainAspectRatio: false,
            legend: {
                display: true
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            responsive: 1,
            scales: {
                yAxes: [{
                    display: 0,
                    gridLines: 0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    display: 0,
                    gridLines: 0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }]
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 15,
                    bottom: 15
                }
            }
        };

        gradientChartOptionsConfigurationWithNumbersAndGrid = {
            maintainAspectRatio: false,
            legend: {
                display: true,
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            responsive: true,
            scales: {
                yAxes: [{
                    gridLines: 0,
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    display: 0,
                    gridLines: 0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }]
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 15,
                    bottom: 15
                }
            }
        };

        var ctx = document.getElementById('bigDashboardChart').getContext("2d");

        var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, '#ffc9c1');

        var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                datasets: [{
                    label: "Domestik",
                    borderColor: '#ff938e',
                    pointBorderColor: '#ff938e',
                    pointBackgroundColor: "#1e3d60",
                    pointHoverBackgroundColor: "#1e3d60",
                    pointHoverBorderColor: '#ff938e',
                    borderCapStyle: 'square',
                    borderDash: [], // try [5, 15] for instance
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderWidth: 1,
                    pointHoverRadius: 7,
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    data: [
                        {{$data1}}
                    ],
                    spanGaps: true,
                }, {
                    label: "Mancanegara",
                    borderColor: '#FFFFFF',
                    pointBorderColor: '#FFFFFF',
                    pointBackgroundColor: "#1e3d60",
                    pointHoverBackgroundColor: "#1e3d60",
                    pointHoverBorderColor: '#FFFFFF',
                    pointBorderWidth: 1,
                    pointHoverRadius: 7,
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    data: [
                        {{$data2}}
                    ],
                    spanGaps: false,
                }]
            },
            options: {
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 0,
                        bottom: 0
                    }
                },
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: '#fff',
                    titleFontColor: '#333',
                    bodyFontColor: '#666',
                    bodySpacing: 4,
                    xPadding: 12,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest"
                },
                legend: {
                    position: "top",
                    fillStyle: "#FFF",
                    display: true,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(255,255,255,0.4)",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: true,
                            drawBorder: false,
                            display: true,
                            color: "rgba(255,255,255,0.1)",
                            zeroLineColor: "transparent"
                        },
                        scaleLabel: {
                            display: true,
                            fontColor: "rgba(255,255,255,0.4)",
                            labelString: 'Jumlah Pengunjung',
                        }

                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent",
                            display: false,

                        },
                        ticks: {
                            padding: 10,
                            fontColor: "rgba(255,255,255,0.4)",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        });
    </script>
@endpush
@push('script')
    <script src="{{asset('datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.bootstrap4.min.js')}}"></script>
    {{--<script src="{{asset('asetsba2/js/demo/datatables-demo.js')}}"></script>--}}

    <script>
        $(document).ready(function () {
            var dt = $('#tabelPengunjung').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('tabel.pengunjung')}}',
                columns: [{
                    data: 'id_dataPengunjung',
                    name: 'id_dataPengunjung'
                },
                    {
                        data: 'nama_wisata',
                        name: 'nama_wisata'
                    },
                    {
                        data: 'jumlah_dataPengunjung',
                        name: 'jumlah_dataPengunjung'
                    },
                    {
                        data: 'tanggal_dataPengunjung',
                        name: 'tanggal_dataPengunjung'
                    },
                    {
                        data: 'status_pengunjung',
                        name: 'status_pengunjung'
                    },
                    {
                        data: 'asal',
                        name: 'asal'
                    },
                ]
            });
        });
    </script>
@endpush


