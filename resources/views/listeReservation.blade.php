@extends('layouts.master')
@section('content')
<div class='box'>
    <h3>Liste de vos conférences</h3>
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $mesConferences as $uneConference )
            @php
            $dateConf = date_create($uneConference->dateConf);
            @endphp
            <tr>
                <td>{{$uneConference -> libConf}}</td>
                <td>{{$dateConf->format('d/m/Y')}}</td>               
                <td>{{$dateConf->format('H:i')}}</td>
                <td>{{$uneConference -> adresseConf}} </td>
                <td>{{$uneConference -> cpConf}}</td>
                <td>{{$uneConference -> prixConf * $uneConference -> qteBillet}} € pour {{$uneConference -> qteBillet}} places<a data-toggle="modal" data-target="#nbPlaceConf" ><i class="fa fa-ellipsis-v fa-pull-right fa-2x" aria-hidden="true"></i></a></td>
            </tr>
        <div id="nbPlaceConf" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nombre de places reservées</h4>
                    </div>
                    {!! Form::open(['url' => '/modifierPlaceConf']) !!}
                    <div class="modal-body">    
                        <input type="hidden" name="nbPlaceRes" value="{{$uneConference->qteBillet}}">
                        <input type="hidden" name="idVis" value="{{$uneConference->idVisiteur}}">
                        <input type="hidden" name="idConf" value="{{$uneConference->idConf}}">
                        <label class="control-label">Nombres de places reservées (dans la limite disponible) : </label>
                        <input type="number" value="{{$uneConference -> qteBillet}}" min="1" max="{{$uneConference->placeDispoConf - $uneConference->placeReserConf + $uneConference->qteBillet}}" name="qteBillet" class="form-control" required>             
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Modifier</button>                      
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                    {{ Form::close() }}
                    <div>
                        {!! Form::open(['url' => '/annulerConf']) !!}
                        <input type="hidden" name="idVis" value="{{$uneConference->idVisiteur}}">
                        <input type="hidden" name="idConf" value="{{$uneConference->idConf}}">
                        <input type="hidden" name="qteBillet" value="{{$uneConference->qteBillet}}">
                        <button type = "submit" class="btn btn-default btn-primary"><span class="fa fa-ban"></span> Annuler la réservation</button>
                        {{ Form::close() }}
                    </div> 
                </div>
            </div>
        </div>
        @endforeach
        </tbody>
    </table>
    <br><br>
    <h3>Liste de vos visites</h3>
    <table class="table table-striped listeFiltree">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Adresse</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $mesVisites as $uneVisite )
            @php
            $dateVis = date_create($uneVisite->dateVisite);
            @endphp
            <tr>
                <td>{{$uneVisite -> libelleVisite}}</td>
                <td>{{$dateVis->format('d/m/Y')}}</td>
                <td>{{$dateVis->format('H:i')}}</td>
                <td>{{$uneVisite -> lieuxVisite}} </td>
                <td>{{$uneVisite -> prixVisite * $uneVisite -> qteBillet}} € pour {{$uneVisite -> qteBillet}} places<a data-toggle="modal" data-target="#nbPlaceVis" class="btnModif" ><i class="fa fa-ellipsis-v fa-pull-right fa-2x" aria-hidden="true"></i></a></td>
            </tr>
        <div id="nbPlaceVis" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nombre de places reservées</h4>
                    </div>
                    {!! Form::open(['url' => '/modifierPlaceVis']) !!}
                    <div class="modal-body">    
                        <input type="hidden" name="dateVisite" value="{{$uneVisite->dateVisite}}">
                        <input type="hidden" name="nbPlaceRes" value="{{$uneVisite->qteBillet}}">
                        <input type="hidden" name="idVisiteur" value="{{$uneVisite->idVisiteur}}">
                        <input type="hidden" name="idVisite" value="{{$uneVisite->idVisite}}">
                        <label class="control-label">Nombres de places reservées (dans la limite disponible) : </label>
                        <input type="number" value="{{$uneVisite -> qteBillet}}" min="1" max="{{$uneVisite->nbPlace - $uneVisite->nbPlaceRes + $uneVisite->qteBillet}}" name="qteBillet" class="form-control" required>             
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Modifier</button>                      
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                    {{ Form::close() }}
                    <div>
                        {!! Form::open(['url' => '/annulerVis']) !!}
                        <input type="hidden" name="dateVisite" value="{{$uneVisite->dateVisite}}">
                        <input type="hidden" name="idVisiteur" value="{{$uneVisite->idVisiteur}}">
                        <input type="hidden" name="idVisite" value="{{$uneVisite->idVisite}}">
                        <input type="hidden" name="qteBillet" value="{{$uneVisite->qteBillet}}">
                        <button type = "submit" class="btn btn-default btn-primary"><span class="fa fa-ban"></span> Annuler la réservation</button>
                        {{ Form::close() }}
                    </div> 
                </div>
            </div>
        </div>        
        @endforeach
        </tbody>
    </table>
</div>
@stop

