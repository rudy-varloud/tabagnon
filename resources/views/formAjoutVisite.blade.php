@extends('layouts.masterAdmin')
@section('content')
{!! Html::script('assets/pickadate.js/lib/picker.time.js') !!}  
{!! Html::script('assets/pickadate.js/lib/picker.js') !!}    
{!! Html::script('assets/pickadate.js/lib/picker.date.js') !!} 
{!! Html::style('assets/pickadate.js/lib/themes/default.css') !!}
{!! Html::style('assets/pickadate.js/lib/themes/default.date.css') !!}
{!! Html::style('assets/pickadate.js/lib/themes/default.time.css') !!}
{!! Html::script('assets/timepicker/jquery.timepicker.min.js') !!} 
{!! Html::style('assets/timepicker/jquery.timepicker.min.css') !!}
{!! Form::open(['url' => 'postFormVisite', 'files' => true]) !!}
<div class="col-lg-12 col-md-12 col-s-12 box">
    <center><h2 class='formVisite'> Créer une visite </h2></center>
    <!--    <div class="form-horizontal">-->
    <!--        <div class="form-control">-->
    <div class="form-group">
        <label class="col-md-3 control-label">Nom de la visite: </label>
        <input name="nomVisite" class="visiteform form-control" type="text" value="{{$nomVisite or ''}}" placeholder="Titre de la visite" required autofocus>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-3 control-label">Lieu de la visite:</label>
        <input name="lieuxVisite" class="visiteform form-control" type="text" value="{{$lieuxVisite or ''}}" placeholder="Lieux de la visite" required>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Description de la visite: </label>
        <input name='description' class="visiteform form-control" type="text" value="{{$descVisite or ''}}" placeholder="Description de l'article" required autofocus>
    </div>
    <br>
    <input name="cpt" type="hidden" value="{{$cpt}}">
    <div class='form-group'>
        <label class="col-md-3 control-label"> Date(s) de la visite: </label>    
        @while($cpt>0)
        <br>
        <input name="date{{$cpt}}" type="text" class="visiteform datepicker form-control"  value="{{$dateVisite or ''}}" placeholder="Choisir la date" required>
        <input name="heure{{$cpt}}" type="text" class="visiteform timepicker form-control"  value="{{$heureVisite or ''}}" placeholder="Choisir l'heure" required>
        @php(
        $cpt = $cpt - 1)
        @endwhile
    </div>
    <br>
    <div class="form-group">
        <label class='col-md-3 control-label'>Prix de la visite: </label>
        <input name='prix' class="visiteform form-control" type="number" value="{{$prixVisite or ''}}" placeholder="Prix de la visite" required>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-4 control-label">Nombre de place(s) pour la visite: </label>
        <input name="nbPlace" class="visiteform form-control" value="{{$nbPlaceVisite or ''}}" type="number" placeholder="Nombre de place dispo pour cette visite" required>
    </div>
    <br>


    <div class='form-group'>
        @if($idGuide != null)
        <label class='col-md-4 control-label selectGuide'>Sélectionnez le guide pour cette visite: </label>
        <select name="idGuideVisite" class="visiteform form-control nomGuideVis" required >
            <option value="Selectionnez le guide souhaité" disabled>Selectionnez le guide souhaité</option>
            @foreach($mesVisiteurs as $unVisiteur)
            @if($idGuide == $unVisiteur->idVis)
            <option value="{{$unVisiteur -> idVis}}" selected>{{$unVisiteur->prenomVis}} {{$unVisiteur->nomVis}} @if(($unVisiteur->ncptVis) == 5)<span class='ct'>(Compte temporaire)</span>@endif</option>
            @endif
            @if($idGuide != $unVisiteur->idVis)
            <option value="{{$unVisiteur -> idVis}}">{{$unVisiteur->prenomVis}} {{$unVisiteur->nomVis}} @if(($unVisiteur->ncptVis) == 5)<span class='ct'>(Compte temporaire)</span>@endif</option>
            @endif
            @endforeach
        </select>
        <br>

        @endif
        @if($idGuide == null)
        <label class='col-md-4 control-label'>Sélectionnez le guide pour cette visite: </label>
        <select name="idGuideVisite" class="visiteform form-control nomGuideVis" required >
            <option value="Selectionnez le guide souhaité" selected disabled>Selectionnez le guide souhaité</option>
            @foreach($mesVisiteurs as $unVisiteur)
            <option value="{{$unVisiteur -> idVis}}">{{$unVisiteur->prenomVis}} {{$unVisiteur->nomVis}} @if(($unVisiteur->ncptVis) == 5)<span class='ct'>(Compte temporaire)</span>@endif</option>
            @endforeach
        </select>
        <br>
        @endif
    </div>
    <div class="form-group">
        <center> <button onClick="formCheckGuide();" class="btn btn-info" type="button" data-toggle="modal" data-target="#guideModal">Créer un guide manuellement</button> </center>
    </div> 
    <br>
    <div class="form-group">
        <br><br>
        <center> <button onsubmit ="formCheck();" type="submit" class="btn btn-default btn-primary">
                <span class="glyphicon glyphicon-ok"></span> Valider
            </button>
            &nbsp;
            <button type="button" class="btn btn-default btn-primary" 
                    onclick="javascript: window.location = '{{url('/getPageAdmin')}}';">
                <span class="glyphicon glyphicon-remove" ></span> Annuler</button> </center>
    </div>
    <input id="formCheck" value="0" name="formCheck" type="hidden">
    <div id="guideModal" class="modal fade" role="dialog" type="hidden">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Créer un guide manuellement</h4>
                </div>          
                <div class="modal-body">
                    <label>Prénom du guide:</label>
                    <input name="prenomGuideMan" class="guide form-control"  placeholder="Prénom du guide">
                    <br>
                    <label>Nom du guide:</label>
                    <input name="nomGuideMan" class="guide form-control" placeholder="Nom du guide">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Ajouter</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
@stop
