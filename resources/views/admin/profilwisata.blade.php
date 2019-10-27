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
                        <a class="btn btn-primary" href="{{route('wisata.create')}}">
                            <i class="now-ui-icons ui-1_simple-add"></i><span> Tambah Wisata</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @foreach($wisata as $data)
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
                            <i class="now-ui-icons location_world"></i> <a href="http://facebook.com/{{$data->facebook}}">facebook</a>
                            <span> |</span>
                            <i class="now-ui-icons location_world"></i> <a href="http://twitter.com/{{$data->twitter}}">twitter</a>
                            <span> |</span>
                            <i class="now-ui-icons location_world"></i> <a href="http://instagram.com/{{$data->instagram}}">instagram</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
