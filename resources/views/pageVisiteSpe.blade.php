@extends('layouts.master')
@section('content')

<div class="box">
    @foreach($mesVisites as $uneVisite)
    @php
    $date = date_create($uneVisite->dateVisite);
    $placeDispo = (($uneVisite->nbPlace) - ($uneVisite->nbPlaceRes))
    @endphp
    <h3> Bienvenue sur la balade: {{$uneVisite->libelleVisite}} du {{$date->format('d/m/Y')}} </h3>
    <p> {{$uneVisite->descriptionVisite}} </p>
    
    <div class="place"> Nombre de place global: {{$uneVisite->nbPlace}}. / .Nombre de place Disponible: {{$placeDispo}}</div>
    @endforeach
</div>

@stop