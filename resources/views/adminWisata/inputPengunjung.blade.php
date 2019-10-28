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
                            <form method="POST" action="">
                                @csrf

                                <div class="form-group row">
                                    <label for="wisatawan"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Wisatawan') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="list">
                                            <option>-- Pilih wisatawan --</option>
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
                                        <select class="form-control" id="negara">
                                            <option>-- Pilih negara --</option>
                                            <option value="amerika">Amerika</option>
                                            <option value="korea selatan">Korea Selatan</option>
                                        </select>
                                    </div>
                                </div>

                                {{--DOmestik--}}
                                <div id="divprovinsi" class="form-group row">
                                    <label for="wisatawan"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Provinsi') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="provinsi">
                                            <option>-- Pilih provinsi --</option>
                                            <option value="jawa timur">Jawa Timur</option>
                                            <option value="jawa tengah">Jawa Tengah</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="divkabupaten" class="form-group row">
                                    <label for="wisatawan"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Kabupaten') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="kabupaten">
                                            <option>-- Pilih kabupaten --</option>
                                            <option value="jember">Jember</option>
                                            <option value="banyuwangi">Banyuwangi</option>
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
                            </form>
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
                if(list == 1){
                    $('#divnegara').fadeOut();
                    $( "#divprovinsi" ).fadeIn();
                    $( "#divkabupaten" ).fadeIn();
                }else if(list == 2){
                    $( "#divnegara" ).fadeIn();
                    $( "#divprovinsi" ).fadeOut();
                    $( "#divkabupaten" ).fadeOut();
                }
            });
        });
    </script>
@endpush
