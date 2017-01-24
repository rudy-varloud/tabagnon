@extends('layouts.master')
@section('content')
@php
    $placeRes = 0;
@endphp
<div class='box'>
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th><center>Pseudo</center></th>
                <th><center>Nom</center></th>
                <th><center>Prénom</center></th>
                <th><center>Téléphone</center></th>
                <th><center>Adresse mail</center></th>
                <th><center>Nombre de places réservée(s)</center></th>
            </tr>
        </thead>
        <tbody>
            @foreach($mesConferences as $uneConference)
            @php
                $placeRes += $uneConference -> qteBillet;
            @endphp
            <tr>
                <td><center>{{$uneConference -> login}}</center></td>
                <td><center>{{$uneConference -> nomVis}}</center></td>
                <td><center>{{$uneConference -> prenomVis}}</center></td>
                <td><center>{{$uneConference -> telVis}}</center></td>
                <td><center>{{$uneConference -> mailVis}}</center></td>
                <td><center>{{$uneConference -> qteBillet}}</center></td> 
            </tr>
            @endforeach
    </tbody>
    </table>
    <center><h5>Nombre de places actuellement réservée(s): {{$placeRes}}</h5></center>
</div>
@stop