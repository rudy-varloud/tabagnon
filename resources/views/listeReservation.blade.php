@extends('layouts.master')
@section('content')
<div class='box'>
    <h3>Liste de vos conférences</h3>
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th>Numéro conférence</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Adresse</th>
                <th>Prix</th>
                <th>Code Postal</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $mesConferences as $uneConference )
            @php
            $dateConf = date_create($uneConference->dateConf);
            @endphp
            <tr>
                <td>{{$uneConference -> idConf}}</td>
                <td>{{$uneConference -> libConf}}</td>
                <td>{{$dateConf->format('d-m-Y')}}</td>
                <td>{{$uneConference -> adresseConf}} </td>
                <td>{{$uneConference -> heureConf}}</td>
                <td>{{$uneConference -> prixConf}}€</td>
                <td>{{$uneConference -> cpConf}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    <h3>Liste de vos visites</h3>
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th>Numéro de la visite</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Adresse</th>
                <th>Prix</th>
                <th>Nombre de place reservé</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $mesVisites as $uneVisite )
            @php
            $dateVis = date_create($uneVisite->dateVisite);
            @endphp
            <tr>
                <td>{{$uneVisite -> idVisite}}</td>
                <td>{{$uneVisite -> libelleVisite}}</td>
                <td>{{$dateVis->format('d/m/Y')}}</td>
                <td>{{$dateVis->format('H:i')}}</td>
                <td>{{$uneVisite -> lieuxVisite}} </td>
                <td>{{$uneVisite -> prixVisite}}€</td>
                <td>{{$uneVisite -> qteBillet}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop