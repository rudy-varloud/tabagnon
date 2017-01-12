@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'postFormVisite', 'files' => true]) !!}

<div class="col-lg-12 col-md-12 col-s-12">
    <center><h2> Créer une visite </h2></center>
    <!--    <div class="form-horizontal">-->
    <!--        <div class="form-control">-->
    <div class="form-group">
        <label class="col-md-3 control-label">Nom de la visite: </label>
        <input name="nomVisite" class="form-control" type="text" value="{{$titreArticle or ''}}" placeholder="Titre de l'aticle" required autofocus>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-3 control-label">Lieux de la visite</label>
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
        <label class="col-md-3 control-label">Nombre de place pour la visite: </label>
        <input name="nbPlace" class="form-control" type="number" placeholder="Nombre de place dispo pour cette visite" required>
    </div>
    <br>
    <div class='form-group'>
        <label class='col-md-3 control-label'>Selectionnez le guide pour cette visite: </label>
        <select name="nomGuideVisite" class="form-control">
            <option value="Selectionnez le guide souhaité" selected disabled required>Selectionnez le guide souhaité</option>
            @foreach($mesVisiteurs as $unVisiteur)
            <option value="{{$unVisiteur -> idVis}}">{{$unVisiteur->prenomVis}} {{$unVisiteur->nomVis}}</option>
            @endforeach
        </select>
    </div>
    <br>
    <div class="form-group">
        <br><br>
        <center> <button type="submit" class="btn btn-default btn-primary">
                <span class="glyphicon glyphicon-ok"></span> Valider
            </button>
            &nbsp;
            <button type="button" class="btn btn-default btn-primary" 
                    onclick="javascript: window.location = '{{url('/acccueil')}}';">
                <span class="glyphicon glyphicon-remove" ></span> Annuler</button> </center>
    </div>
</div>
@stop