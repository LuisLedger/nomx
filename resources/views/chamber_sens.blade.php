@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <h4 class="text-center"><b>{{date('d')}} de {{ \App\Models\Period::$months[date('m')] }} de {{date('Y')}}</b></h4>
        <chamber-two-component
            :states="{{ json_encode(\App\Models\State::select(['id','name'])->get()) }}"
            :today="'{{date('Y-m-d')}}'"
        ></chamber-two-component>
    </div>
@endsection
