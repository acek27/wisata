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
            <div class="col-lg-8">
                <div class="card card-chart">
                    <div class="card-header">
                        {!! Form::open(['url'=>route('wisata.store'), 'method'=>'post']) !!}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Email Wisata</label>
                                    <input type="text" name="email" class="form-control" placeholder="email"
                                           value="">
                                </div>
                            </div>

                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="password" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Nama Wisata</label>
                                    <input type="text" name="wisata" class="form-control" placeholder="nama wisata"
                                           value="">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control" placeholder="alamat"
                                           value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Deskripsi wisata</label>
                                    <input name="deskripsi" type="text" class="form-control"
                                           placeholder="Deskripsi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Upload gambar</label>
                                    <input name="upload" type="file" class="form-control"
                                           placeholder="choose file...">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit"> simpan</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
