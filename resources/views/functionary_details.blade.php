@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-4">
                <div class="text-center">
                    <img src="{{$functionary->profile_url}}" class="image-functionary-detail">
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <p class="text-muted m-0">Nombre:</p>
                        <b>{{$functionary->full_name}}</b>
                    </li>
                    <li class="list-group-item">
                        <p class="text-muted m-0">Cargo:</p>
                        <b>{{$functionary->functionary_type_name}} - {{$functionary->level_name}}</b>
                    </li>
                    <li class="list-group-item">
                        <p class="text-muted m-0">Partido Político:</p>
                        <b>{{$functionary->political_group->name}}</b>
                    </li>
                    <li class="list-group-item">
                        <p class="text-muted m-0">Fecha de inicio en el cargo:</p>
                        <b>{{date('d/m/Y',strtotime($functionary->start_time))}}</b>
                    </li>
                    <li class="list-group-item">
                        <p class="text-muted m-0">Entidad:</p>
                        <b>{{$functionary->state_name}}</b>
                    </li>
                    <li class="list-group-item">
                        <p class="text-muted m-0">Municipio:</p>
                        <b>{{$functionary->delegation_name}}</b>
                    </li>
                    <li class="list-group-item">
                        <p class="text-muted m-0">Localidad:</p>
                        <b>{{$functionary->location_name}}</b>
                    </li>
                    @if (in_array($functionary->functionary_type_id, [4,5,10,11]))
                        <li class="list-group-item">
                            <p class="text-muted m-0">Comisión:</p>
                            <b>{{$functionary->commission_name}}</b>
                        </li>
                    @endif
                    @if ($functionary->district)
                        <li class="list-group-item">
                            <p class="text-muted m-0">Distrito:</p>
                            <b>{{optional($functionary->district)->district}}</b>
                        </li>
                    @endif
                    @if ($functionary->functionary_contacts)
                        <li class="list-group-item">
                            <p class="text-muted m-0">Contacto:</p>
                            @foreach ($functionary->functionary_contacts as $contact)
                                <b>{{ $contact->phone . ' ' . $contact->email }}</b><br>
                            @endforeach
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-8">
                <functionary-details-component
                    :functionary="{{ json_encode($functionary) }}"
                    :functionary_periods="{{ json_encode($functionary->functionary_periods) }}"
                ></functionary-details-component>
            </div>
        </div>
    </div>
@endsection
