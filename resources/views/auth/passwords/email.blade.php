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
                            <img src="{{ asset('imgs/logo.png') }}" height="100px" style="padding: 0.25rem;max-width: 100%;height: auto;">
                        </a>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3><b>Recuperar contraseña</b></h3>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Enviar link de contraseña') }}
                            </button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-link btn-block" href="{{ route('login') }}">
                                {{ __('Iniciar sesión') }}
                            </a>
                        </div>
                    </form>
                </div>
                <div class="col-6 text-white showcase-img d-none d-md-block" style="background-image: url('{{ optional(\App\Models\Delegation::inRandomOrder()->first())->image }}'); height: 100%;background-size: cover;"></div>
            </div>
        </div>
    </section>
@endsection