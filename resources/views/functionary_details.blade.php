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
                        <b>{{$functionary->functionary_type_name}}</b>
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
                <div class="form-group mb-3">
                    <label>Periodos de gobierno</label>
                    <select name="period_id" id="period_id" multiple class="form-control" size="1">
                        @foreach ($functionary->functionary_periods as $functionary_period)
                            <option value="{{$functionary_period->period_id}}" @if ($loop->first)
                                selected
                            @endif>{{$functionary_period->full_period}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <functionary-laws-component
                            :functionary="{{ json_encode($functionary) }}"
                        ></functionary-laws-component>
                    </div>
                    <div class="col-md-6">
                        <functionary-proposal-component
                            :functionary="{{ json_encode($functionary) }}"
                        ></functionary-proposal-component>
                    </div>
                </div>
                <functionary-projects-component
                    :functionary="{{ json_encode($functionary) }}"
                ></functionary-projects-component>
                <functionary-activities-component
                    :functionary="{{ json_encode($functionary) }}"
                ></functionary-activities-component>
            </div>
        </div>
    </div>
@endsection
