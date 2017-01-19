@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'reservationPlace', 'files' => true]) !!}
<div class="box">
    @foreach($mesVisites as $uneVisite)
    @php
    $date = date_create($uneVisite->dateVisite);
    $placeDispo = (($uneVisite->nbPlace) - ($uneVisite->nbPlaceRes));
    $i = 0;
    @endphp
    <input type="hidden" class="form-control idVisite" value="{{ $uneVisite->idVisite }}" name="nbPlaceDispo">
    <h3> Bienvenue sur la balade: {{$uneVisite->libelleVisite}} du {{$date->format('d/m/Y')}} </h3>
    <p> {{$uneVisite->descriptionVisite}} </p>
    <h5> Le prix par personne de cette visite est de: {{$uneVisite->prixVisite}} €</h5>
    <div class="reserverPlace">

        <div class="col-lg-6 place"> - Nombre de place disponible(s): {{$placeDispo}}</div>
        <div class="testReser">
            <div class="col-lg-4 reservation"> 
                <select name='nbPlaceVoulu' class="form-control">
                    <option value="Selectionnez le nombre de place souhaité" disabled selected required>Selectionnez le nombre de place(s) souhaité(s)</option>
                    @for($i = 1; $i<= $placeDispo; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-info sub" value="Réserver"> Réserver </button>
        </div>
    </div>
    @endforeach
</div>
{{ Form::close() }}
@stop