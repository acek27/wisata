@extends ('layout.layout')

@section('title')
    DASHBOARD
@endsection

@section('sub')
    PENGUNJUNG WISATA TAHUN {{(int)date('Y')}} KABUPATEN JEMBER
@endsection

@section('content')
    <div class="panel-header panel-header-lg">

        <canvas id="bigDashboardChart" height="200px"></canvas>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Global Sales</h5>
                        <h4 class="card-title">Shipped Products</h4>
                        <div class="dropdown">
                            <button type="button"
                                    class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                                    data-toggle="dropdown">
                                <i class="now-ui-icons loader_gear"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <a class="dropdown-item text-danger" href="#">Remove Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="lineChartExample"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">2018 Sales</h5>
                        <h4 class="card-title">All products</h4>
                        <div class="dropdown">
                            <button type="button"
                                    class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                                    data-toggle="dropdown">
                                <i class="now-ui-icons loader_gear"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <a class="dropdown-item text-danger" href="#">Remove Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="lineChartExampleWithNumbersAndGrid"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Email Statistics</h5>
                        <h4 class="card-title">24 Hours Performance</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="barChartSimpleGradientsNumbers"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card  card-tasks">
                    <div class="card-header ">
                        <h5 class="card-category">Backend development</h5>
                        <h4 class="card-title">Tasks</h4>
                        @foreach($data as $value)
                            {{$value->tahun }} - {{$value->bulan }} - {{ $value->jumlah }} - {{ $value->id_pengunjung}}
                            <br>
                        @endforeach
                    </div>
                    <div class="card-body ">
                        <div class="table-full-width table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" checked>
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-left">Sign contract for "What are conference organizers afraid
                                        of?"
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title=""
                                                class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                                data-original-title="Edit Task">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title=""
                                                class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox">
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-left">Lines From Great Russian Literature? Or E-mails From My
                                        Boss?
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title=""
                                                class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                                data-original-title="Edit Task">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title=""
                                                class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" checked>
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-left">Flooded: One year later, assessing what was lost and what was
                                        found when a ravaging rain swept through metro Detroit
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title=""
                                                class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                                data-original-title="Edit Task">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title=""
                                                class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-category">All Persons List</h5>
                        <h4 class="card-title"> Employees Stats</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <th>
                                    Name
                                </th>
                                <th>
                                    Country
                                </th>
                                <th>
                                    City
                                </th>
                                <th class="text-right">
                                    Salary
                                </th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        Niger
                                    </td>
                                    <td>
                                        Oud-Turnhout
                                    </td>
                                    <td class="text-right">
                                        $36,738
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Minerva Hooper
                                    </td>
                                    <td>
                                        Curaçao
                                    </td>
                                    <td>
                                        Sinaai-Waas
                                    </td>
                                    <td class="text-right">
                                        $23,789
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Sage Rodriguez
                                    </td>
                                    <td>
                                        Netherlands
                                    </td>
                                    <td>
                                        Baileux
                                    </td>
                                    <td class="text-right">
                                        $56,142
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Doris Greene
                                    </td>
                                    <td>
                                        Malawi
                                    </td>
                                    <td>
                                        Feldkirchen in Kärnten
                                    </td>
                                    <td class="text-right">
                                        $63,542
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Mason Porter
                                    </td>
                                    <td>
                                        Chile
                                    </td>
                                    <td>
                                        Gloucester
                                    </td>
                                    <td class="text-right">
                                        $78,615
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                            @foreach($data->where('id_pengunjung',1) as $value)
                            {{$value->jumlah}},
                            @endforeach
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
                            @foreach($data->where('id_pengunjung',2) as $value)
                            {{$value->jumlah}},
                            @endforeach
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
