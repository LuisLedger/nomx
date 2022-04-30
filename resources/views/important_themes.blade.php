@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <important-themes-component
            :themes="{{json_encode(\App\Models\ThemeSocial::orderBy('name','ASC')->get())}}"
            :levels="{{json_encode(\App\Models\Level::get())}}"
            :states="{{ json_encode(\App\Models\State::get()) }}"
        ></important-themes-component>
    </div>
@endsection
