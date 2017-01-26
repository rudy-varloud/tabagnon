@extends('layouts.masterAdmin')
@section('content')

{!! Form::open(['url' => 'getReservations']) !!}
<div class="box">
    <input type="hidden" value="{{ $uneVisite->idVisite }}" name="idVisite">
    <div class="reserverPlace">
        <div class="col-lg-4 reservation"> 
            <select id="date_selected" name='dateVisite' onclick="checkSelected()" class="form-control">
                <option value="Selectionnez la date souhaitée" disabled selected required>Selectionnez une date</option>
                @foreach($mesVisites as $uneVisite)
                @php
                    $date = date_create($uneVisite->dateVisite);
                @endphp
                <option value="{{$date->format('d-m-Y')}}">{{$date->format('d-m-Y')}}</option>
                @endforeach
            </select>
            <br>       
            <div class="testReser">
                <button type="submit" class="btn btn-info sub" value="Réserver"> Voir les réservations </button>
            </div>
        </div>
    </div>

    {{ Form::close() }}
    @if($lesReservations != null)
    <h3>Liste des réservations pour la visite {{$uneVisite->libelleVisite}} </h3>
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone fixe</th>
                <th>Téléphone portable</th>
                <th>Adresse mail</th>
                <th>Adresse</th>
                <th>Nombre de place réservées</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $lesReservations as $uneReservation )
            @if($uneReservation->nbPlaceRes != 0)
            <tr>
                <td>{{$uneReservation -> nomVis}}</td>
                <td>{{$uneReservation -> prenomVis}}</td>
                <td>{{$uneReservation -> telFixeVis}}</td>
                <td>{{$uneReservation -> mobileVis}}</td>
                <td>{{$uneReservation -> mailVis}}</td>
                <td>{{$uneReservation -> adresseVis}}</td>
                <td>{{$uneReservation -> nbPlaceRes}}</td>

            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@stop