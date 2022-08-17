@extends('layouts.admin')

@section('content')
    <crud-component
        :token="'{{csrf_token()}}'"
        :title="'Temas sociales'"
        :description="'Listado de temas sociales'"
        :component_name="'themes-list'"
        :url_data="'{{ route('theme-socials.index') }}'"
        :url_store="'{{ route('theme-socials.store') }}'"
        :url_detail="'{{ route('theme-socials.show',['theme_social' => '#element_id']) }}'"
        :url_update="'{{ route('theme-socials.update',['theme_social' => '#element_id']) }}'"
        :url_delete="'{{ route('theme-socials.destroy',['theme_social' => '#element_id']) }}'"
        :columns="{{json_encode($columns)}}"
        :form_data="{{json_encode(\App\Models\ThemeSocial::getFieldsInfo())}}"
    ></crud-component>
@endsection
