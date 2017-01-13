@extends('layouts.master')
@section('content')

<body>
    <div class="col-lg-12 col-md-12 col-s-12 box">
        @foreach ($mesVisites as $uneVisite)
        <h3>-/ Informations concernant la visite: {{$uneVisite->libelleVisite}}</h3> 
        <div class='visiteContour'>
            <span class='mepVis'>Visite:</span> N°{{$uneVisite->idVisite}}
            <span class='mepVis'> Nom de la visite: </span>{{$uneVisite->libelleVisite}}
            <span class='mepVis'>Prix de la visite: </span>{{$uneVisite->prixVisite}}
            <span class='mepVis'>Place pour cette balade: </span>{{$uneVisite->nbPlace}}
            <span class='mepVis'>Place déjà reservé: </span>{{$uneVisite->nbPlaceRes}}
            <span class='mepVis'>Lieux: </span>{{$uneVisite->lieuxVisite}}
            <span class='mepVis'>Date: </span>{{$uneVisite->dateVisite}}
        </div>
        <br>
        @endforeach
    </div>
</body>
@stop

