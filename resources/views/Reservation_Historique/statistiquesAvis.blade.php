@extends('layouts.masterAdmin')
@section('content')
@php
$nbPlaceDispo = 0;
$nbPlaceRes = 0;
$nbVisite = 0;
$nbStarP = 0;
$nbStarP = 0;
$cpt = 0;
$cptVis = 0;
$cptConf = 0;
@endphp
<div class="box">
    <h1>Statistiques des visites</h1>
    <br>
    <div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Places reservées</th>
                        <th>Guide</th>
                        <th>Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $lesVisites as $uneVisite )
                    @php
                    $nbStarP = 0;
                    $cpt = 0;
                    $lastNum = 0;
                    $nbStarV = 0;
                    @endphp
                    @foreach ($placeVisites as $unePlaceVisite)
                    @if ($uneVisite->idVisite == $unePlaceVisite->idVisite)
                    @php
                    $nbPlaceDispo += $uneVisite->nbPlace;
                    $nbPlaceRes += $unePlaceVisite->nbPlaceRes;
                    $nbVisite += 1;
                    @endphp
                    @endif
                    @endforeach
                    @foreach($lesAvisVisite as $unAvisVis)                  
                    @if($unAvisVis->idVisite == $uneVisite->idVisite)
                    @php
                    $nbStarP += $unAvisVis->note;
                    $cpt += 1;               
                    @endphp
                    @endif
                    @endforeach
                    @php
                    if($cpt != 0){
                    $moy = $nbStarP / $cpt;
                    $nbStarV = round(5 - $moy, 0, PHP_ROUND_HALF_DOWN);
                    }
                    @endphp
                    <tr>
                        <td>{{$uneVisite -> libelleVisite}}</td>
                        <td>{{$uneVisite -> lieuxVisite}} </td>
                        <td>{{$nbPlaceRes}} places reservées sur {{$nbPlaceDispo}} ({{$nbVisite}} visites)</td>
                        <td>{{$uneVisite -> nomVis}} {{$uneVisite -> prenomVis}}</td>
                        <td class="yellow">@for ($i = 0; $i < $moy; $i++)  
                            @php
                            $lastNum = $moy - $i;
                            @endphp
                            @if ($lastNum < 1 && $lastNum > 0)
                            <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
                            @endif
                            @if ($lastNum >= 1 && $lastNum > 0)
                            <i class="fa fa-star fa-2x" aria-hidden="true"></i>
                            @endif                      
                            @endfor
                            @for ($i = 0; $i < $nbStarV; $i++)
                            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
                            @endfor</td>
                        <td><a data-target="#avisVisModal{{$cptVis}}" data-toggle="modal" data-target=".navbar-collapse.in">Voir les avis <i class="fa fa-commenting" aria-hidden="true"></i></a></td>
                        <td><a href="{{url('/supprimerVisEffec/'.$uneVisite->idVisite)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                    <!-- Modal -->
                <div id="avisVisModal{{$cptVis}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <center> <h3 class="modal-title">Les avis pour la visite : {{$uneVisite -> libelleVisite}}</h3> </center>
                            </div>
                            <div class="modal-body">                   
                                @foreach($lesAvisVisite as $unAvisVis)                  
                                @if($unAvisVis->idVisite == $uneVisite->idVisite)
                                @php
                                $nbStarV = 5 - $unAvisVis->note;
                                @endphp
                                <div class="yellow avis">
                                    <center>
                                        <p><small>  Posté par :</small> {{$unAvisVis->prenomVis}} {{$unAvisVis->nomVis}}</p>
                                        <div>
                                            @for ($i = 0; $i < $unAvisVis->note; $i++)
                                            <i class="fa fa-star fa-2x" aria-hidden="true"></i>
                                            @endfor
                                            @for ($i = 0; $i < $nbStarV; $i++)
                                            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                        <p>{{$unAvisVis->avis}}</p>
                                    </center>
                                </div> 
                                <hr>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $moy = 0;
                $nbPlaceDispo = 0;
                $nbPlaceRes = 0;
                $nbVisite = 0;  
                $cptVis += 1;
                @endphp
                @endforeach
                </tbody>
            </table>   
        </div>
    </div>
    <br>
    <h1>Statistiques des conférences</h1>
    <br>
    <div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Places reservées</th>
                        <th>Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $lesConferences as $uneConference )
                    @php
                    $nbStarP = 0;
                    $cpt = 0;
                    $lastNum = 0;
                    $nbStarV = 0;
                    @endphp
                    @foreach($lesAvisConference as $unAvisConf)                  
                    @if($unAvisConf->idConf == $uneConference->idConf)
                    @php
                    $nbStarP += $unAvisConf->note;
                    $cpt += 1;               
                    @endphp
                    @endif
                    @endforeach
                    @php
                    if($cpt != 0){
                    $moy = $nbStarP / $cpt;
                    $nbStarV = round(5 - $moy, 0, PHP_ROUND_HALF_DOWN);
                    }               
                    @endphp
                    <tr>
                        <td>{{$uneConference -> libConf}}</td>
                        <td>{{$uneConference -> adresseConf}} </td>
                        <td>{{$uneConference->placeReserConf}} places reservées sur {{$uneConference->placeDispoConf}}</td>
                        <td class="yellow">@for ($i = 0; $i < $moy; $i++)  
                            @php
                            $lastNum = $moy - $i;
                            @endphp
                            @if ($lastNum < 1 && $lastNum > 0)
                            <i class="fa fa-star-half-o fa-2x" aria-hidden="true"></i>
                            @endif
                            @if ($lastNum >= 1 && $lastNum > 0)
                            <i class="fa fa-star fa-2x" aria-hidden="true"></i>
                            @endif                      
                            @endfor
                            @for ($i = 0; $i < $nbStarV; $i++)
                            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
                            @endfor</td>
                        <td><a data-target="#avisConfModal{{$cptConf}}" data-toggle="modal" data-target=".navbar-collapse.in">Voir les avis <i class="fa fa-commenting" aria-hidden="true"></i></a></td>
                        <td><a href="{{url('/supprimerConfEffec/'.$uneConference->idConf)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                    <!-- Modal -->
                <div id="avisConfModal{{$cptConf}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <center>            <h3 class="modal-title">Les avis pour la conférence : {{$uneConference -> libConf}}</h3> </center>
                            </div>
                            <div class="modal-body">                   
                                @foreach($lesAvisConference as $unAvisConf)                    
                                @if($unAvisConf->idConf == $uneConference->idConf)
                                @php
                                $nbStarV = 5 - $unAvisConf->note;
                                @endphp
                                <div class="yellow avis">
                                    <center>
                                        <p><small>  Posté par :</small> {{$unAvisConf->prenomVis}} {{$unAvisConf->nomVis}}</p>
                                        <div>
                                            @for ($i = 0; $i < $unAvisConf->note; $i++)
                                            <i class="fa fa-star fa-2x" aria-hidden="true"></i>
                                            @endfor
                                            @for ($i = 0; $i < $nbStarV; $i++)
                                            <i class="fa fa-star-o fa-2x" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                        <p>{{$unAvisConf->avis}}</p>
                                    </center>
                                </div> 
                                <hr>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $moy = 0;
                $cptConf += 1
                @endphp
                @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</div>
@stop