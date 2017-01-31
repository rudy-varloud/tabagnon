@extends('layouts.master')
@section('content')
<div class='box'>
    <h3>Liste des conférences du Tabagnon !</h3>
    <div class="table-responsive">
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
                    @if (Session::get('ncpt') != 0)
                    <th>Reservez vos places !</th>
                    @endif
                    @if (Session::get('ncpt') == 4)
                    <th>Voir réservation</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach( $mesConferences as $uneConference )
                @php
                $date = date_create($uneConference->dateConf);
                @endphp
                <tr>
                    <td>{{$uneConference -> idConf}}</td>
                    <td>{{$uneConference -> libConf}}</td>
                    <td>{{$date->format('d-m-Y')}}</td>
                    <td>{{$date->format('H:i')}}</td>
                    <td>{{$uneConference -> adresseConf}} </td>               
                    <td>{{$uneConference -> prixConf}}€</td>
                    <td>{{$uneConference -> cpConf}}</td>
                    @if (Session::get('ncpt') != 0)
                    <td><center><a href='{{url('/getConfSpe/'.$uneConference->idConf)}}'><span class='glyphicon glyphicon-tags'></span></a></center></td>
            @endif
            @if (Session::get('ncpt') == 4)
            <td><center><a href='{{url('/getUserConf/'.$uneConference->idConf)}}'><span class='glyphicon glyphicon-th-list'></span></a></center></td>
            <td><center><a href="{{url('/modifConference/'.$uneConference->idConf)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></center></td>
            <td><center><a href="{{url('/supprimerConference/'.$uneConference->idConf)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></center></td>
            @endif
            </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
