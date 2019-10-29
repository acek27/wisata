@extends ('layout.layout')

@section('css')
    <link href="{{asset('datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('title')
    DASHBOARD
@endsection

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
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
                    @can('admin')
                        <a class="btn btn-primary" href="{{route('wisata.create')}}">
                            <i class="now-ui-icons ui-1_simple-add"></i><span> Tambah Wisata</span></a>
                    @endcan
                    @can('adminwisata')
                        <a class="btn btn-primary" href="{{route('wisata.edit', Auth::user()->id)}}">
                            <i class="now-ui-icons ui-1_settings-gear-63"></i><span> Edit Wisata</span></a>
                    @endcan
                    @can('admin')
                    @section('sub')
                        DAFTAR WISATA KABUPATEN JEMBER
                    @endsection
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
                    <div class="card-footer">
                    </div>
                    @endcan

                    @can('adminwisata')
                        @foreach($wisata->where('id_user',Auth::user()->id) as $data)
                    @section('sub')
                        PROFIL WISATA {{$data->name}} KABUPATEN JEMBER
                    @endsection
                    <h5 class="card-category" style="text-transform: capitalize;">Profil
                        Wisata {{$data->name}}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="recent-report__chart">
                                <img src="{{asset('images/'.$data->gambar)}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">Deksripsi Wisata</h4>
                            <p style="text-align: justify">{{$data->deskripsi}}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row" style="text-align: center">
                            <div class="col-md-4">
                                <i class="now-ui-icons location_world"></i> facebook : <a
                                    href="http://facebook.com/{{$data->facebook}}"><span> http://facebook.com/{{$data->facebook}}</span></a>
                            </div>
                            <div class="col-md-4">
                                <i class="now-ui-icons location_world"></i> twitter : <a
                                    href="http://twitter.com/{{$data->twitter}}"><span> http://twitter.com/{{$data->twitter}}</span></a>
                            </div>
                            <div class="col-md-4">
                                <i class="now-ui-icons location_world"></i> instagram : <a
                                    href="http://instagram.com/{{$data->instagram}}"><span> http://instagram.com/{{$data->instagram}}</span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endcan
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
