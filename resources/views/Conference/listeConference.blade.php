@extends('layouts.master')
@section('content')
<div class='box'>
    @if($message != null)
    <div class="alert alert-info alert-dismissable fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>{{$message}}</p>
    </div>
    @endif
    <h3>Liste des conférences du Tabagnon !</h3>
    @if ($mesConferences == null)
    Aucune conférences n'est disponible actuellement revenez plus tard.
    @endif
    @if ($mesConferences != null)
    <div class="table-responsive">
        <table class="table table-striped listeFiltree">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Adresse</th>
                    <th>Prix</th>
                    <th>Code Postal</th>
                    @if (Session::get('ncpt') != 0)
                    <th>Réserver vos places !</th>
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
            <td><center><a href="{{url('/modifConference/'.$uneConference->idConf)}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></center></td>
            <td><center><a class="fa fa-trash fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                           onclick="javascript:if (confirm('Voulez vous vraiment supprimer ce compte ?'))
                               { window.location ='{{ url('/supprimerConference') }}/{{ $uneConference -> idConf }}'; }"></center></td>
            @endif
            </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@stop
