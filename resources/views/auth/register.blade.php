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
                <div class="col-md-6 text-white showcase-img d-none d-md-block" style="background-image: url('{{ \App\Models\Delegation::inRandomOrder()->first()->image }}'); height: 100%;background-size: cover;"></div>
                <div class="col-md-6" style="padding-top: 4rem; padding-left: 4rem;padding-right: 4rem;">
                    <h3><b>Registro</b></h3>
                    <form class="mb-5" method="POST" action="{{ route('register') }}">
                        @csrf
                        <label for="role">{{ __('Tipo Cuenta') }}</label>
                        <div class="form-group">
                            @foreach (\App\Models\User::$rol_aliases as $idx => $role)
                                @if ($loop->iteration > 1)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="radio_{{$loop->iteration}}" value="{{$idx}}" required>
                                        <label class="form-check-label" for="radio_{{$loop->iteration}}"><i class="fa {{\App\User::$icon_roles[$idx]}} mr-3"></i>{{$role}}</label>
                                    </div>
                                @endif
                            @endforeach
                            @if ($errors->has('role'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="">{{ __('Nombre(s)') }}</label>
                            <input id="first_name" type="text" class="form-control @error('name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="">{{ __('Apellido(s)') }}</label>
                            <input id="last_name" type="text" class="form-control @error('name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="">{{ __('Correo electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password-confirm" class="">{{ __('Confirmar Contraseña') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>  
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a class="btn" href="{{ url('auth/twitter') }}"
                                style="background: #1E9DEA; padding: 10px; width: 100%; text-align: center; display: block; border-radius:4px; color: #ffffff;">
                                Login with Twitter
                            </a>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Registrarse') }}
                            </button>
                        </div>
                        <div class="form-group mb-0">
                            <a href="{{ url('/') }}" class="btn btn-link btn-block">
                                Ir al inicio
                            </a>
                        </div>
                        <hr>
                        <div class="form-group mb-0">
                            <a href="{{ route('login') }}" class="btn btn-link btn-block">
                                Ya tengo cuenta
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
