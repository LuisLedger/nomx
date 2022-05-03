@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <functionaries-by-level-component 
            :levels="{{ json_encode(\App\Models\Level::get()) }}"
            :states="{{ json_encode(\App\Models\State::get()) }}"
        >
        </functionaries-by-level-component>
    </div>
@endsection
