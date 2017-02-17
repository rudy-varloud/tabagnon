@extends('layouts.masterAdmin')
@section('content')
{!! Form::open(['url' => 'getReservations']) !!}
<div class="box">
    <center><h2>Voir les réservation:</h2></center>
    <center><h3>Choisissez une date et une heure pour votre visite</h3></center>
    <input type="hidden" value="{{ $uneVisite->idVisite }}" name="idVisite">
    <center><div class="reserverPlace">
        <div class="col-lg-offset-4 col-lg-4 reservation"> 
            <select id="date_selected" name='dateVisite' onclick="checkSelected()" class="form-control">
                <option value="Sélectionnez la date souhaitée" disabled selected required>Selectionnez une date</option>
                @foreach($mesVisites as $uneVisite)
                @php
                $date = date_create($uneVisite->dateVisite);
                @endphp
                <option value="{{$uneVisite->dateVisite}}">Le {{$date->format("d/m/Y")}} à {{$date->format("H:i")}}</option>
                @endforeach
            </select>
            <br>       
            <div >
                <button type="submit" class="btn btn-info sub" value="Réserver"> Voir les réservations </button>
            </div>
        </div>
        </div></center>

    {{ Form::close() }}
    <center><h3 class="listeResa">Liste des réservations pour la visite {{$uneVisite->libelleVisite}} </h3></center>
    <div class="table-responsive">
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
                    @if(Session::get('ncpt') == 4)
                    <th>Supprimer réservation</th>
                    @endif
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
                    <td><center>{{$uneReservation -> nbPlaceRes}}</center></td>
                    @if(Session::get('ncpt') == 4)
                    <td><center><a href="{{url('/supprimerResaVisite/'.$uneReservation->idVis)}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></center></td>
                    @endif

                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
