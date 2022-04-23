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
                <div class="col-md-6" style="padding-top: 10rem; padding-right: 4rem; padding-left: 6rem;">
                    <div class="text-center mb-3">
                        <a href="{{ url('/') }}" style="text-align:!important;">
                            {{-- <img src="{{ asset('imgs/logo.png') }}" height="100px" style="padding: 0.25rem;max-width: 100%;height: auto;"> --}}
                            {{ env('APP_NAME')}}
                        </a>
                    </div>
                    <h3><b>Ingresar</b></h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('Correo') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recordarme') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Ingresar') }}
                            </button>
                        </div>
                        <div class="form-group">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link btn-block" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste la contraseña?') }}
                                </a>
                            @endif
                        </div>
                        <hr>
                        <div class="flex items-center justify-end mt-4">
                            <a class="btn" href="{{ url('auth/twitter') }}"
                                style="background: #1E9DEA; padding: 10px; width: 100%; text-align: center; display: block; border-radius:4px; color: #ffffff;">
                                Login with Twitter
                            </a>
                        </div>
                        <div class="form-group mb-0">
                            <a href="{{ route('register') }}" class="btn btn-link btn-block">
                                No tengo cuenta
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-white showcase-img d-none d-md-block" style="background-image: url('https://fakeimg.pl/800x800/?text=Imagen Informativa'); height: 100%;background-size: cover;"></div>
            </div>
        </div>
    </section>
@endsection
