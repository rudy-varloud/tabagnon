@extends('layouts.master')
@section('content')
@php($uneVisite = $mesVisites[0])
{!! Form::open(['url' => 'reservationPlace', 'files' => true]) !!}
<div class="box">
    @php
    $uneVisite = $mesVisites[0];
    $placeDispo = (($uneVisite->nbPlace) - ($uneVisite->nbPlaceRes));
    $i = 0;
    @endphp
    <input type="hidden" class="form-control idVisite" value="{{ $uneVisite->idVisite }}" name="nbPlaceDispo">
    <h3> Bienvenue sur la balade: {{$uneVisite->libelleVisite}}</h3>
    <p> {{$uneVisite->descriptionVisite}} </p>
    <h5> Le prix par personne de cette visite est de : {{$uneVisite->prixVisite}} €</h5>
    <div class="reserverPlace">
        <div class="col-lg-6 place"> - Nombre de place disponible(s): {{$placeDispo}}</div>
        <div class="col-lg-4 reservation"> 
            <select name='nbPlaceVoulu' class="form-control">
                <option value="Selectionnez le nombre de place souhaité" disabled selected required>Selectionnez le nombre de place(s) souhaité(s)</option>
                @for($i = 1; $i<= $placeDispo; $i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
            <select name='dateVisite' class="form-control">
                <option value="Selectionnez la date souhaitée" disabled selected required>Selectionnez une date</option>
                @foreach($mesVisites as $uneVisite)
                <option value="{{$uneVisite->dateVisite}}">{{$uneVisite->dateVisite}}</option>
                @endforeach
            </select>           
        </div>
        <button type="submit" class="btn btn-info sub" value="Réserver"> Réserver </button>
    </div>
</div>
{{ Form::close() }}
@stop