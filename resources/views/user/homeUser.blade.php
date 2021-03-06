@extends ('layout.userLayout')

@section('title')
    HOME
@endsection

@section('sub')
    PENGUNJUNG WISATA TAHUN {{$tahun}} KABUPATEN JEMBER
@endsection

@section('year')
    <div class="col-lg-1">
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
                {{--@guest--}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {{(int)date('Y')}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        @php($start = date('Y'))
                        @php($end =$start-4)
                        @for($year = $start; $year >= $end; $year--)
                            <a class="dropdown-item" href="{{route('userWisata.tahun',$year)}}">{{$year}}</a>
                        @endfor
                    </div>
                </li>
                {{--@endguest--}}
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
    </div>
    <div class="content">
        <div class="row">
            @foreach($wisata as $value)
                <div class="col-lg-4">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h4 class="card-title" style="text-transform: capitalize">{{$value->name}}</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{route('userWisata.show',$value->id_user)}}"><img
                                    src="{{asset('images/'.$value->gambar)}}" height="300px" width="600px"></a>
                        </div>
                        <div class="card-footer" style="margin-top: -5px">
                            <div class="stats">
                                <i class="now-ui-icons location_world"></i> <a
                                    href="http://facebook.com/{{$value->facebook}}">facebook</a>
                                <span> |</span>
                                <i class="now-ui-icons location_world"></i> <a
                                    href="http://twitter.com/{{$value->twitter}}">twitter</a>
                                <span> |</span>
                                <i class="now-ui-icons location_world"></i> <a
                                    href="http://instagram.com/{{$value->instagram}}">instagram</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
