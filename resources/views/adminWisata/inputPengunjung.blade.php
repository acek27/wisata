@extends ('layout.layout')

@section('title')
    Input Pengunjung
@endsection

@section('sub')
    INPUT PENGUNJUNG WISATA TAHUN {{(int)date('Y')}} KABUPATEN JEMBER
@endsection

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <div class="card-header">{{ __('Input Pengunjung Wisata') }}</div>

                        <div class="card-body">
                            {!! Form::open(['url'=>route('dataPengunjung.store'),  'method'=>'post']) !!}
                            @csrf

                            <div class="form-group row">
                                <label for="wisatawan"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Wisatawan') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="list" required>
                                        <option value="">-- Pilih wisatawan --</option>
                                        <option value="1">Domestik</option>
                                        <option value="2">Mancanegara</option>
                                    </select>
                                </div>
                            </div>

                            {{--Mancanegara--}}
                            <div id="divnegara" class="form-group row">
                                <label for="wisatawan"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Asal Negara') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="negara" required>
                                        <option value="">-- Pilih negara --</option>
                                        @foreach($negara as $value)
                                            <option value="{{$value->id}}">{{$value->negara_nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{--DOmestik--}}
                            <div id="divprovinsi" class="form-group row">
                                <label for="wisatawan"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Provinsi') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="provinsi" required>
                                        <option value="">-- Pilih provinsi --</option>
                                        @foreach($provinsi as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="divkabupaten" class="form-group row">
                                <label for="wisatawan"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Kabupaten') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="kabupaten">
                                        <option>-- Pilih kabupaten --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Jumlah Pengunjung') }}</label>

                                <div class="col-md-6">
                                    <input id="jumlah" type="number"
                                           class="form-control" name="jumlah"
                                           min="0" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row text-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Simpan') }}
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#list').change(function () {
                var list = $("#list").val();
                if (list == 1) {
                    $('#divnegara').fadeOut();
                    $("#divprovinsi").fadeIn();
                    $("#divkabupaten").fadeIn();
                } else if (list == 2) {
                    $("#divnegara").fadeIn();
                    $("#divprovinsi").fadeOut();
                    $("#divkabupaten").fadeOut();
                }
            });

            $('#provinsi').change(function () {
                var id = $(this).val();
                $.ajax({
                    url: "/dataProvinsi/"+id,
                    method: "POST",
                    data: {id: id},
                    async: true,
                    dataType: 'json',
                    success: function (data) {

                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value=' + data[i].id + '>' + data[i].name + '</option>';
                        }
                        $('#kabupaten').html(html);

                    }
                });
                return false;
            });

        });
    </script>
@endpush
