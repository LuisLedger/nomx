@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:15rem; margin-bottom: 15rem;">
        <h1 class="text-center">
            ¡Bienvenido!
        </h1>
        <p class="text-center text-muted">
            Encuentra a tus funcionarios, propuestas, leyes o proyectos que y el estatus que tienen <br>
            en los distintos niveles de gobierno
        </p>
        <form accept-charset="utf-8" action="{{ route('search') }}" method="get">
            <div class="form-group col-8 m-auto">
                <label class="sr-only" for="search-cities">
                    Búscar
                </label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search">
                            </i>
                        </div>
                    </div>
                    <input class="form-control" id="search-cities" name="q" placeholder="Búscar información general" type="text" autocomplete="off">
                        <button class="input-group-append btn btn-primary" type="submit">
                            Búscar
                        </button>
                    </input>
                </div>
            </div>
        </form>
    </div>
@endsection
