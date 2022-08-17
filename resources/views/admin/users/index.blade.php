@extends('layouts.admin')

@section('content')
    <crud-component
        :token="'{{csrf_token()}}'"
        :title="'Usuarios'"
        :description="'Listado de usuarios'"
        :component_name="'users-list'"
        :url_data="'{{ route('users.index') }}'"
        :url_store="'{{ route('users.store') }}'"
        :url_detail="'{{ route('users.show',['user' => '#element_id']) }}'"
        :url_update="'{{ route('users.update',['user' => '#element_id']) }}'"
        :url_delete="'{{ route('users.destroy',['user' => '#element_id']) }}'"
        :columns="{{json_encode($columns)}}"
        :form_data="{{json_encode(\App\Models\User::getFieldsInfo())}}"
    ></crud-component>
@endsection
