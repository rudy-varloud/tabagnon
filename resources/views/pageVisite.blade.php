@extends('layouts.master')
@section('content')

    <div class="col-lg-12 col-md-12 col-s-12 box">
        @foreach ($mesVisites as $uneVisite)
        @php
        $date = date_create($uneVisite->dateVisite);
        $placeDispo = (($uneVisite->nbPlace) - ($uneVisite->nbPlaceRes))
        @endphp
        <a href='{{url ('/getVisiteSpe/'.$uneVisite->idVisite)}}' style='text-decoration: none;' title="Cliquez pour plus d'informations"> <div class='takeVisite'>
        <h3>-/ Informations concernant la visite : {{$uneVisite->libelleVisite}}</h3> 
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Numéro de visite</th>
                    <th>Nom de la visite</th>
                    <th>Prix de la visite</th>
                    <th>Place(s) restante(s)</th>
                    <th>Lieu</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$uneVisite->idVisite}}</td>
                    <td>{{$uneVisite->libelleVisite}}</td>
                    <td>{{$uneVisite->prixVisite}}€</td>
                    <td>{{$placeDispo}}</td>
                    <td>{{$uneVisite->lieuxVisite}}</td>
                    <td>{{$date->format('d/m/Y')}}</td>
                </tr>
        </table>
        <br>
            </div></a>
        @endforeach
    </div>
@stop

