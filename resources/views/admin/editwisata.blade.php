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
                        {!! Form::model($data,['url'=>route('wisata.update',$data->id_user),'method'=>'put','files'=> true  ]) !!}
                        @csrf
                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Nama Wisata') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{$data->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-mail Wisata') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ $data->email}}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="fb"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                            <div class="col-md-6">
                                <input id="fb" value="{{$data->alamat}}" type="text" class="form-control"
                                       name="alamat" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deskripsi"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi Wisata') }}</label>

                            <div class="col-md-6">
                                    <textarea id="deskripsi" type="text" class="form-control" name="deskripsi"
                                              required>{{$data->deskripsi}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fb"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Facebook') }}</label>

                            <div class="col-md-6">
                                <input value="{{$data->facebook}}" id="fb" type="text" class="form-control"
                                       name="fb" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tw"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Twitter') }}</label>

                            <div class="col-md-6">
                                <input value="{{$data->twitter}}" id="tw" type="text" class="form-control"
                                       name="tw" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ig"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Instagram') }}</label>

                            <div class="col-md-6">
                                <input value="{{$data->instagram}}" id="ig" type="text" class="form-control"
                                       name="ig" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gambar"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Gambar') }}</label>

                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput"
                                     style="margin-top: -10px">
                                        <span class="btn btn-round btn-outline-primary btn-file">
                                        <span class="fileinput-new">Select Image</span>
	                                    <input type="file" name="gambar" onchange="readURL(this);" id="gambar" required></span>
                                    {{--<a href="#pablo" class="btn btn-danger btn-round fileinput-exists"--}}
                                    {{--data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>--}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Preview Gambar</h4>
                    </div>

                    <div class="card-body table-responsive" style="height: 520px">
                        <img id="blah" src="{{asset('images/'.$data->gambar)}}" alt=""
                             style="width:100%;max-width: 100%;max-height: 100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
