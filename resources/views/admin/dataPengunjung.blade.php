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
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-chart">
                    <div class="card-header">
                        <table class="table table-bordered" id="tabelPengunjung">
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
                ]
            });
        });
    </script>
@endpush
