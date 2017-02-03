@extends('layouts.masterAdmin')
@section('content')
<center>
    <div class='box'>   
        <div class='option-admin'>            
            <h1 class="titre-admin"><span class='glyphicon glyphicon-comment'></span> Gestion articles</h1>
            <a href="{{url('/ajoutArticle')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Créer un article</a><br>
            <a href='{{url('/listeArticleAdmin')}}' data-toggle="collapse" data-target=".navbar-collapse.in" class=''>Lister les articles</a><br><br><br><br>

        </div>
        <div class='option-admin'>
            <h1 class="titre-admin"><span class='glyphicon glyphicon-user'></span> Gestion des utilisateurs</h1>
            <a href="{{url('/listerVisiteur')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Lister tous les utilisateurs</a><br><br><br><br>
        </div>       
        <div class='option-admin'>
            <h1 class="titre-admin"><span class='glyphicon glyphicon-calendar'></span> Gestion des visites et des conférences</h1>
            <a href='{{url('/ajoutConference')}}' data-toggle='collapse' data-target='.navbar-collapse.in' class=''>Ajouter une conférence</a><br>
            <a  data-toggle="modal" data-target="#nbModal" class="">Ajouter une visite</a><br>
            <a href="{{url('/getPageVisite')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Liste des visites</a><br>
            <a href="{{url('/getPageConference')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Liste des conférences</a><br><br><br><br>
        </div>       
        <div class='option-admin'>
            <h1 class="titre-admin"><span class='glyphicon glyphicon-th-large'></span> Divers</h1>
            <a href="{{url('/carouselAccueil')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Carousel</a><br>
            <a href='{{url('/getPageValidMosa')}}' data-toggle="collapse" data-target=".narvar-collapse.in" class="">Validation photo Mosaïque</a><br><br>
        </div>      
    </div>
</center>
@stop


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