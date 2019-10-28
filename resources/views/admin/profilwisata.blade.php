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
                        @if (session()->has('flash_notification.message'))
                            <div class="alert alert-{{ session()->get('flash_notification.level') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                {!! session()->get('flash_notification.message') !!}
                            </div>
                        @endif
                        <div class="col-lg-4">
                            @foreach($wisata->where('id_user',Auth::user()->id) as $data)
                                <div class="card card-chart">
                                    <div class="card-header">
                                        <h5 class="card-category">Global Sales</h5>
                                        <h4 class="card-title">{{$data->name}}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <img src="{{asset('images/'.$data->gambar)}}">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats">
                                            <i class="now-ui-icons location_world"></i> <a
                                                href="http://facebook.com/{{$data->facebook}}">facebook</a>
                                            <span> |</span>
                                            <i class="now-ui-icons location_world"></i> <a
                                                href="http://twitter.com/{{$data->twitter}}">twitter</a>
                                            <span> |</span>
                                            <i class="now-ui-icons location_world"></i> <a
                                                href="http://instagram.com/{{$data->instagram}}">instagram</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @can('admin')
                            <a class="btn btn-primary" href="{{route('wisata.create')}}">
                                <i class="now-ui-icons ui-1_simple-add"></i><span> Tambah Wisata</span></a>
                        @endcan
                        @can('adminwisata')
                            <a class="btn btn-primary" href="{{route('dataPengunjung.create')}}">
                                <i class="now-ui-icons ui-1_simple-add"></i><span> Tambah Data Pengunjung</span></a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @can('admin')
            <div class="col-lg-12">
                <div class="card card-chart">
                    <div class="card-header">
                        <table class="table table-bordered" id="tabelWisata">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Wisata</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endcan

        @can('adminwisata')
            <div class="col-lg-4">
                @foreach($wisata->where('id_user',Auth::user()->id) as $data)
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Global Sales</h5>
                            <h4 class="card-title">{{$data->name}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <img src="{{asset('images/'.$data->gambar)}}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons location_world"></i> <a
                                    href="http://facebook.com/{{$data->facebook}}">facebook</a>
                                <span> |</span>
                                <i class="now-ui-icons location_world"></i> <a
                                    href="http://twitter.com/{{$data->twitter}}">twitter</a>
                                <span> |</span>
                                <i class="now-ui-icons location_world"></i> <a
                                    href="http://instagram.com/{{$data->instagram}}">instagram</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endcan
    </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.bootstrap4.min.js')}}"></script>
    {{--<script src="{{asset('asetsba2/js/demo/datatables-demo.js')}}"></script>--}}

    <script>
        $(document).ready(function () {
            var dt = $('#tabelWisata').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('tabel.wisata')}}',
                columns: [
                    {
                        data: 'id_user',
                        name: 'id_user'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                ]
            });

            var del = function (id) {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Anda tidak dapat mengembalikan data yang sudah terhapus!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Iya!",
                    cancelButtonText: "Tidak!",
                }).then(
                    function (result) {
                        $.ajax({
                            url: "{{route('wisata.index')}}/" + id,
                            method: "DELETE",
                        }).done(function (msg) {
                            dt.ajax.reload();
                            swal("Deleted!", "Data sudah terhapus.", "success");
                        }).fail(function (textStatus) {
                            alert("Request failed: " + textStatus);
                        });
                    }, function (dismiss) {
                        // dismiss can be 'cancel', 'overlay', 'esc' or 'timer'
                        swal("Cancelled", "Data batal dihapus", "error");
                    });
            };
            $('body').on('click', '.hapus-data', function () {
                del($(this).attr('data-id'));
            });

        });
    </script>
@endpush
