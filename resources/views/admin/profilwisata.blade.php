@extends ('layout.layout')
@section('css')
    <link href="{{asset('datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('title')
    DASHBOARD
@endsection

@section('sub')
    PROFIL WISATA KABUPATEN JEMBER
@endsection

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-chart">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{route('wisata.create')}}">
                            <i class="now-ui-icons ui-1_simple-add"></i><span> Tambah Wisata</span></a>
                        <table class="table table-bordered" id="tabelPengunjung" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Jumlah Pengunjung</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
