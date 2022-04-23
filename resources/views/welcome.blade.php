@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <h1 class="text-center">
            ¡Bienvenido!
        </h1>
        <p class="text-center text-muted">
            ¿Que quieres saber?
        </p>
        <form accept-charset="utf-8" action="#" method="get">
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
                    <input class="form-control" id="search-cities" name="q" placeholder="Búscar información general" type="text" value="">
                        <button class="input-group-append btn btn-primary" type="submit">
                            Búscar
                        </button>
                    </input>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-5">
        <functionaries-by-level-component 
            :levels="{{ json_encode(\App\Models\Level::get()) }}"
        >
        </functionaries-by-level-component>
    </div>
@endsection
