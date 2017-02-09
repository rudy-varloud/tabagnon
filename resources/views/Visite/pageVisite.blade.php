@extends('layouts.master')
@section('content')
@php($cptVis =0)
<div class="col-lg-12 col-md-12 col-s-12 box">
    @foreach ($mesVisites as $uneVisite)
    <a href='{{url ('/getVisiteSpe/'.$uneVisite->idVisite)}}'  title="Cliquez pour plus d'informations"> 
        <h3>-/ Informations concernant la visite : {{$uneVisite->libelleVisite}}</h3> </a>
    <div class="table-responsive">
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Nom de la visite</th>
                    <th>Lieu</th>
                    <th>Prix</th>        
                    @if(Session::get('ncpt') == 4)
                    <th>Réservations</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$uneVisite->libelleVisite}}</td>
                    <td>{{$uneVisite->lieuxVisite}}</td>
                    <td>{{$uneVisite->prixVisite}}€</td>                   
                    @if(Session::get('ncpt') == 4)
                    <th ><a href="{{url('/getReservationVis/'.$uneVisite->idVisite)}}"><i class="fa fa-calendar-o fa-2x" aria-hidden="true"></i></a></th>
                    <th ><a href="{{url('/getReservationVis/'.$uneVisite->idVisite)}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></th>
                    <th ><a data-target="#supprDateModal{{$cptVis}}" data-toggle="modal" data-target=".navbar-collapse.in"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></th>
                    @endif
                </tr>
        </table>
    </div>
    <br>
    <!-- Modal -->
    <div id="supprDateModal{{$cptVis}}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> <h3 class="modal-title">Les dates pour la visite : {{$uneVisite -> libelleVisite}}</h3> </center>
                </div>
                <div class="modal-body">  
                    @php($cpt = 0)
                    <p>Sélectionnez les dates que vous voulez supprimer :</p>
                    {!! Form::open(['url' => 'supprimerDateVisite']) !!}
                    <input type='hidden' name='idVisite' value='{{$uneVisite -> idVisite}}'>
                    @foreach ($mesVisitesND as $uneVisiteND)      
                    @if($uneVisiteND->idVisite == $uneVisite->idVisite)
                    <input type="checkbox" name="choixdateVisite{{$cpt}}"> {{$uneVisiteND->datevisite}}<br>
                    <input type='hidden' name='dateVisite{{$cpt}}' value='{{$uneVisiteND->datevisite}}'>
                    @php($cpt += 1)
                    @endif 
                    <input type='hidden' name='cpt' value='{{$cpt}}'>
                    @endforeach
                    
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="submit" class="btn btn-info">Supprimer</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </center>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @php($cptVis+=1)
    @endforeach
</div>
@stop

