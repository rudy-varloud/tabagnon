@extends('layouts.masterAdmin')
@section('content')
{!! Form::open(['url' => 'postModifVisite']) !!}
<input type='hidden' name='idVisite' value='{{$maVisite->idVisite}}'>
<div class="col-lg-12 col-md-12 col-s-12 box">
    <center><h2 class='formVisite'> Modifier une visite </h2></center>
    <div class="form-group">
        <label class="col-md-3 control-label">Nom de la visite: </label>
        <input name="nomVisite" class="visiteform form-control" type="text" value="{{$maVisite->libelleVisite or ''}}" placeholder="Titre de la visite" required autofocus>
    </div>
    <br>
    <div class="form-group">
        <label class="col-md-3 control-label">Lieu de la visite:</label>
        <input name="lieuxVisite" class="visiteform form-control" type="text" value="{{$maVisite->lieuxVisite or ''}}" placeholder="Lieux de la visite" required>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Description de la visite: </label>
        <input name='description' class="visiteform form-control" type="text" value="{{$maVisite->descriptionVisite or ''}}" placeholder="Description de l'article" required autofocus>
    </div>
    <br>
    <div class="form-group">
        <label class='col-md-4 control-label'>Sélectionnez le guide pour cette visite: </label>
        <select name="idGuideVisite" class="visiteform form-control nomGuideVis" required >
            <option value="Selectionnez le guide souhaité" selected disabled>Selectionnez le guide souhaité</option>
            @foreach($mesVisiteurs as $unVisiteur)
            @if($unVisiteur->idVis != $maVisite->idGuide)
            <option value="{{$unVisiteur -> idVis}}">{{$unVisiteur->prenomVis}} {{$unVisiteur->nomVis}} @if(($unVisiteur->ncptVis) == 5)<span class='ct'>(Compte temporaire)</span>@endif</option>
            @endif
            @if($unVisiteur->idVis == $maVisite->idGuide)
            <option value="{{$unVisiteur -> idVis}}" selected>{{$unVisiteur->prenomVis}} {{$unVisiteur->nomVis}} @if(($unVisiteur->ncptVis) == 5)<span class='ct'>(Compte temporaire)</span>@endif</option>
            @endif
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
                    onclick="javascript: window.location = '{{url('/getPageAdmin')}}';">
                <span class="glyphicon glyphicon-remove" ></span> Annuler</button> </center>
    </div>
    {{ Form::close() }}
</div>
@stop