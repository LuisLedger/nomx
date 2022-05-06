@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <chamber-one-component
            :states="{{ json_encode(\App\Models\State::select(['id','name'])->get()) }}"
            :today="'{{date('Y-m-d')}}'"
        ></chamber-one-component>
    </div>
@endsection
