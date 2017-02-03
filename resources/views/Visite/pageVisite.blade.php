@extends('layouts.master')
@section('content')

    <div class="col-lg-12 col-md-12 col-s-12 box">
        @foreach ($mesVisites as $uneVisite)
        <a href='{{url ('/getVisiteSpe/'.$uneVisite->idVisite)}}' style='text-decoration: none;' title="Cliquez pour plus d'informations"> <div class='takeVisite'>
        <h3>-/ Informations concernant la visite : {{$uneVisite->libelleVisite}}</h3> 
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th width="40%">Nom de la visite</th>
                    <th width="40%">Lieu</th>
                    <th width="10%">Prix</th>        
                    @if(Session::get('ncpt') == 4)
                    <th width="10%">Réservations</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$uneVisite->libelleVisite}}</td>
                    <td>{{$uneVisite->lieuxVisite}}</td>
                    <td>{{$uneVisite->prixVisite}}€</td>                   
                    @if(Session::get('ncpt') == 4)
                    <th ><a href="{{url('/getReservationVis/'.$uneVisite->idVisite)}}"><span class="glyphicon glyphicon-calendar"></span></a></th>
                    @endif
                </tr>
        </table>
        <br>
            </div></a>
        @endforeach
    </div>
@stop

