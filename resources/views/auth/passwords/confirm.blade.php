@extends('layouts.app',[
    'no_padding_top' => true,
    'show_header'    => false
])

@section('css')
    <style type="text/css" media="screen">
        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .no-gutters {
            margin-right: 0;
            margin-left: 0;
        }
        .showcase .showcase-img {
            min-height: 30rem;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <section style="background-color: white;">
        <div class="container-fluid p-0">
            <div class="row no-gutters" style="height: 100vh">
                <div class="col-md-6" style="padding-top: 13rem; padding-right: 4rem; padding-left: 6rem;">
                    <div class="text-center mb-5">
                        <a href="{{ route('cities') }}" style="text-align:!important;">
                            <img src="{{ asset('imgs/logo.png') }}" height="100px">
                        </a>
                    </div>
                    <h3><b>Ingresar</b></h3>
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-6 text-white showcase-img d-none d-md-block" style="background-image: url('{{ optional(\App\Models\Delegation::inRandomOrder()->first())->image }}'); height: 100%;background-size: cover;"></div>
            </div>
        </div>
    </section>
@endsection