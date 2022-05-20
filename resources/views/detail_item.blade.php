@extends('layouts.app')

@section('content')
    <project-proposal-law-detail-component
        :item="{{json_encode($item)}}"
        :type="'{{$type}}'"
    ></project-proposal-law-detail-component>
@endsection
