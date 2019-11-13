@extends ('layout.layout')

@section('title')
    Input Pengunjung
@endsection
@section('css')
    <link href="{{url('https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/css/gijgo.min.css')}}"
          rel="stylesheet"/>
@endsection
@section('sub')
    EDIT PENGUNJUNG WISATA TAHUN {{(int)date('Y')}} KABUPATEN JEMBER
@endsection

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12" style="text-align: center">
                <div class="card card-chart">
                    <div class="card-header">
                        <div class="card-header" style="margin-bottom: 10px">{{ __('Edit Pengunjung Wisata') }}</div>

                        <div class="card-body">
                            {!! Form::open(['url'=>route('dataPengunjung.update',$pengunjung->id_dataPengunjung),  'method'=>'put']) !!}
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-5 col-form-label text-md-right">{{ __('Tanggal Berkunjung') }}</label>

                                <div class="col-md-3">
                                    <input type="text" class="form-control datepicker"
                                           value="{{$pengunjung->tanggal_dataPengunjung}}" id="datepicker" name="tgl"
                                           aria-describedby="emailHelp" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="wisatawan"
                                       class="col-md-5 col-form-label text-md-right">{{ __('Wisatawan') }}</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="pengunjung" id="list" required>
                                        <option value="">-- Pilih wisatawan --</option>
                                        @foreach($status as $st)
                                            <option value="{{$st->id_pengunjung}}"
                                                    @if($pengunjung->id_pengunjung == $st->id_pengunjung)
                                                    selected="selected"
                                                @endif>{{$st->status_pengunjung}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{--Mancanegara--}}
                            <div id="divnegara" class="form-group row" style="display: none">
                                <label for="wisatawan"
                                       class="col-md-5 col-form-label text-md-right">{{ __('Asal Negara') }}</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="negara" id="negara">
                                        <option value="">-- Pilih negara --</option>
                                        @foreach($negara as $value)
                                        <option value="{{$value->id}}">{{$value->negara_nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{--DOmestik--}}
                            <div id="divprovinsi" class="form-group row" style="display: none">
                                <label for="wisatawan"
                                       class="col-md-5 Nnticol-form-label text-md-right">{{ __('Provinsi') }}</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="provinsi" id="provinsi">
                                        <option value="">-- Pilih provinsi --</option>
                                        @foreach($provinsi as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="divkabupaten" class="form-group row" style="display: none">
                                <label for="wisatawan"
                                       class="col-md-5 col-form-label text-md-right">{{ __('Kabupaten') }}</label>
                                <div class="col-md-3">
                                    <select class="form-control" id="kabupaten" name="kabupaten">
                                        <option>-- Pilih kabupaten --</option>
                                    </select>
                                </div>
                            </div>

                            <div id="divjumlah" class="form-group row">
                                <label for="name"
                                       class="col-md-5 col-form-label text-md-right">{{ __('Jumlah Pengunjung') }}</label>

                                <div class="col-md-3">
                                    <input id="jumlah" type="number"
                                           class="form-control" name="jumlah"
                                           min="0" value="{{$pengunjung->jumlah_dataPengunjung}}" required>

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
    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/js/gijgo.min.js')}}"></script>
    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-m-d',
                autoclose: true,
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#list').change(function () {
                var list = $("#list").val();
                if (list == 1) {
                    $('#divnegara').fadeOut();
                    $("#negara").val("")
                    $("#divprovinsi").fadeIn();
                    $("#divkabupaten").fadeIn();
                    $("#divjumlah").fadeIn();
                } else if (list == 2) {
                    $("#divnegara").fadeIn();
                    $("#divprovinsi").fadeOut();
                    $("#provinsi").val("")
                    $("#divkabupaten").fadeOut();
                    $("#kabupaten").val("")
                    $("#divjumlah").fadeIn();
                }
            });

            $('#provinsi').change(function () {
                var id = $(this).val();
                $.ajax({
                    url: "/dataProvinsi/" + id,
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
