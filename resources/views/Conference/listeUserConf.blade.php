@extends('layouts.master')
@section('content')
@php
$placeRes = 0;
@endphp
<div class='box'>
    <div class='col-md-12'>
        {!! Form::open(['url' => 'getPrintConf']) !!}
        <input type="hidden" value="{{ $uneConference->idConf }}" name="idConf">
        <button type='submit' class='btn btn-info sub'><i class="fa fa-print" aria-hidden="true"></i>Version imprimable</button>
        {{ Form::close() }}
    </div>
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th><center>Pseudo</center></th>
        <th><center>Nom</center></th>
        <th><center>Prénom</center></th>
        <th><center>Mobile</center></th>
        <th><center>Fixe</center></th>
        <th><center>Adresse mail</center></th>
        <th><center>Nombre de place(s) réservée(s)</center></th>
        <th><center>Supprimer cette réservation</center></th>
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
        <td><center>{{$uneConference -> telFixeVis}}</center></td>
        <td><center>{{$uneConference -> mobileVis}}</center></td>
        <td><center>{{$uneConference -> mailVis}}</center></td>
        <td><center>{{$uneConference -> qteBillet}}</center></td>
        {!! Form::open(['url' => 'supprimerResaConference', 'files' => true]) !!}
            <input type='hidden' name='idConf' value='{{$uneConference -> idConf}}'>
            <input type='hidden' name='idVisiteur' value='{{$uneConference -> idVisiteur}}'>
            <input type='hidden' name='qteBillet' value='{{$uneConference -> qteBillet}}'>
            <td><center><button type='submit'>Supprimer</button></center></td>
            {!! form::Close() !!}
        </tr>
        @endforeach
        </tbody>
    </table>
    <center><h5>Nombre de place(s) actuellement réservée(s): {{$placeRes}}</h5></center>
</div>
@stop