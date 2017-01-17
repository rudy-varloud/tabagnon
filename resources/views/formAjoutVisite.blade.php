@extends('layouts.masterAdmin')
@section('content')
{!! Form::open(['url' => 'postFormVisite', 'files' => true]) !!}
<div class="col-lg-12 col-md-12 col-s-12 box">
    <center><h2 class='formVisite'> Créer une visite </h2></center>
    <!--    <div class="form-horizontal">-->
    <!--        <div class="form-control">-->
    <div class="form-group">
        <label class="col-md-3 control-label">Nom de la visite: </label>
        <input name="nomVisite" class="form-control" type="text" value="{{$titreArticle or ''}}" placeholder="Titre de l'aticle" required autofocus>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-3 control-label">Lieu de la visite:</label>
        <input name="lieuxVisite" class="form-control" type="text" placeholder="Lieux de la visite" required>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Description de la visite: </label>
        <input name='description' class="form-control" type="text" value="{{$description or ''}}" placeholder="Description de l'article" required autofocus>
    </div>
    <br>
    <div class='form-group'>
        <label class="col-md-3 control-label"> Date de la visite: </label>
        <input name="date" class="form-control" type="date" value="" placeholder="Date et heure souhaitez pour la visite" required>
    </div>
    <br>
    <div class="form-group">
        <label class='col-md-3 control-label'>Prix de la visite: </label>
        <input name='prix' class="form-control" type="number" placeholder="Prix de la visite" required>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-4 control-label">Nombre de place(s) pour la visite: </label>
        <input name="nbPlace" class="form-control" type="number" placeholder="Nombre de place dispo pour cette visite" required>
    </div>
    <br>
    <div class='form-group'>
        <label class='col-md-4 control-label'>Sélectionnez le guide pour cette visite: </label>
        <select name="nomGuideVisite" class="form-control nomGuideVis" required>
            <option value="Selectionnez le guide souhaité" selected disabled>Selectionnez le guide souhaité</option>
            @foreach($mesVisiteurs as $unVisiteur)
            <option value="{{$unVisiteur -> idVis}}">{{$unVisiteur->prenomVis}} {{$unVisiteur->nomVis}} @if(($unVisiteur->ncptVis) == 4){(Compte temporaire}@endif</option>
            @endforeach
        </select>
        <br>
        <div class="form-group">
            <center> <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal">Créer un guide manuellement</button> </center>
        </div>
    </div>
    
    <br>
    <div class="form-group">
        <br><br>
        <center> <button type="submit" class="btn btn-default btn-primary">
                <span class="glyphicon glyphicon-ok"></span> Valider
            </button>
            &nbsp;
            <button type="button" class="btn btn-default btn-primary" 
                    onclick="javascript: window.location = '{{url('/accueil')}}';">
                <span class="glyphicon glyphicon-remove" ></span> Annuler</button> </center>
    </div>
</div>
{{ Form::close() }}
{!! Form::open(['url' => 'subscribeGuideTemp', 'files' => true]) !!}
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Créer un guide manuellement</h4>
            </div>
            <div class="modal-body">
                <label>Prénom du guide:</label>
                <input name="prenomGuideMan" class="form-control" value="" placeholder="Prénom du guide">
                <br>
                <label>Nom du guide:</label>
                <input name="nomGuideMan" class="form-control" value="" placeholder="Nom du guide">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Ajouter</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>
    {{ Form::close() }}
@stop
