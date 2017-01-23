@extends('layouts.master')
@section('content')
<div class='box'>
    <h3>Liste des conférences du Tabagnon !</h3>
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
            <tr>
                <td>{{$uneConference -> idConf}}</td>
                <td>{{$uneConference -> libConf}}</td>
                <td>{{$uneConference -> dateConf}}</td>
                <td>{{$uneConference -> adresseConf}} </td>
                <td>{{$uneConference -> heureConf}}</td>
                <td>{{$uneConference -> prixConf}}</td>
                <td>{{$uneConference -> cpConf}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
