@extends('layouts.app')

@section('title')
    Tambah Wisata
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tambah Wisata') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nama Wisata') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deskripsi"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi Wisata') }}</label>

                                <div class="col-md-6">
                                    <textarea id="deskripsi" class="form-control" name="deskripsi"
                                              required></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fb"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Facebook') }}</label>

                                <div class="col-md-6">
                                    <input id="fb" type="url" class="form-control"
                                           name="fb">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tw"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Twitter') }}</label>

                                <div class="col-md-6">
                                    <input id="tw" type="url" class="form-control"
                                           name="tw">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ig"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Instagram') }}</label>

                                <div class="col-md-6">
                                    <input id="ig" type="url" class="form-control"
                                           name="ig">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gambar"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Gambar') }}</label>

                                <div class="col-md-6">
                                    <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-top: -10px">
                                        <span class="btn btn-round btn-outline-primary btn-file">
                                        <span class="fileinput-new">Select Image</span>
	                                    <input type="file" name="gambar"/></span>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
