@extends ('layout.userLayout')

@section('title')
    PROFIL WISATA
@endsection

@section('sub')
    PENGUNJUNG WISATA (NAMA WISATA) TAHUN {{(int)date('Y')}} KABUPATEN JEMBER
@endsection

@section('content')
    <div class="panel-header">
        GRAFIK WISATA YBS
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-category">Profil Wisata (Nama Wisata)</h5>
                        <div class="recent-report__chart">
                            <img src="assets/img/jbr.png" alt="Daster">
                        </div>
                        <h4 class="card-title">Foto, Deskripsi Wisata, Sosial Media</h4>
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
                            <div class="chartjs-size-monitor"
                                 style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand"
                                     style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink"
                                     style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>
                            <canvas id="lineChartExample" width="440" height="380" class="chartjs-render-monitor"
                                    style="display: block; width: 220px; height: 190px;"></canvas>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
