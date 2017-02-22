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
@if($message != null)
<div class="alert alert-info alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <p>{{$message}}</p>
</div>
@endif
<center>
    <div class='box'>   
        <div class='option-admin'>            
            <h1 class="titre-admin"><span class='glyphicon glyphicon-comment'></span> Gestion des articles</h1>
            <a href="{{url('/ajoutArticle')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Créer un article</a><br>
            <a href='{{url('/listeArticleAdmin')}}' data-toggle="collapse" data-target=".navbar-collapse.in" class=''>Liste des articles</a><br>
            <a href='{{url('/ajouterUneImageArticle')}}' data-toggle="collapse" data-target=".navbar-collapse.in" class=''>Ajouter une image à un article</a><br><br><br><br>

        </div>
        <div class='option-admin'>
            <h1 class="titre-admin"><span class='glyphicon glyphicon-user'></span> Gestion des utilisateurs</h1>
            <a href="{{url('/listerVisiteur')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Liste des utilisateurs</a><br><br><br><br>
        </div>       
        <div class='option-admin'>
            <h1 class="titre-admin"><span class='glyphicon glyphicon-calendar'></span> Gestion des visites, conférences et réunions</h1>
            <h2>I - Visite</h2>
            <a href="{{url('/getPageVisite')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Liste des visites</a><br>
            <a  data-toggle="modal" data-target="#nbModal" class="">Ajouter une visite</a><br>
            <a  data-toggle="modal" data-target="#selectionVisite" class="">Ajouter une date</a><br>
            <h2>II - Conférence</h2>
            <a href="{{url('/getPageConference')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Liste des conférences</a><br>
            <a href='{{url('/ajoutConference')}}' data-toggle='collapse' data-target='.navbar-collapse.in' class=''>Ajouter une conférence</a><br>
            <h2>III - Réunion</h2>
            <a href="{{url('/listeReunion')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Liste des réunions et assemblée générale</a><br>
            <a href="{{url('/ajoutReunion')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Ajouter une réunion ou une assemblée générale</a><br>
            <br><br><br>
        </div>       
        <div class='option-admin'>
            <h1 class="titre-admin"><span class='glyphicon glyphicon-th-large'></span> Divers</h1>
            <a href="{{url('/carouselAccueil')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Gestion du carrousel</a><br>
            <a href='{{url('/getPageValidMosa')}}' data-toggle="collapse" data-target=".narvar-collapse.in" class="">Validation des photos de la mosaïque</a><br>
            <a href='{{url('/getAvis')}}' data-toggle="collapse" data-target=".narvar-collapse.in" class="">Voir les avis</a><br>
            <a href='{{url('/majBdd')}}' data-toggle="collapse" data-target=".narvar-collapse.in" class="">Mettre à jour les visites, conférences et réunions</a><br><br>
        </div>      
    </div>
</center>



<div id="nbModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nombre de dates</h4>
            </div>
            {!! Form::open(['url' => '/ajoutVisite']) !!}
            <div class="modal-body">                   
                <label class="control-label">Nombres de dates pour la visite : </label>
                <input type="number" value="1" min="1" max="5" name="nbDate" class="form-control" required>             
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            {{ Form::close() }}
        </div>

    </div>
</div>

<div id="selectionVisite" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Choix de la visite</h4>
            </div>
            {!! Form::open(['url' => '/ajoutDateVisite']) !!}
            <div class="modal-body">                   
                <select name="idVisite" class="visiteform form-control" required >
                    <option disabled>Selectionnez une visite</option>
                    @foreach($lesVisites as $uneVisite)
                    <option value="{{$uneVisite -> idVisite}}">{{$uneVisite->libelleVisite}}</option>
                    @endforeach
                </select>
                <br>
                <div class='form-group'>
                    <p class="col-md-3 control-label"> Date et heure de la visite: </p>    
                    <br>
                    <input name="date" type="text" class="datepicker1 form-control"  value="{{$dateVisite or ''}}" placeholder="Choisir la date">
                    <input name="heure" type="text" class="timepicker1 form-control"  value="{{$heureVisite or ''}}" placeholder="Choisir l'heure" required>
                </div> 
            </div>        
            <div class="modal-footer">
                <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Valider</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            {{ Form::close() }}
        </div>

    </div>
</div>
@stop
