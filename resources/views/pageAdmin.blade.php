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
            <h1 class="titre-admin"><span class='glyphicon glyphicon-user'></span> Gestion visiteurs</h1>
            <a href="{{url('/listerVisiteur')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Lister tous les utilisateurs</a><br><br><br><br>
        </div>       
        <div class='option-admin'>
            <h1 class="titre-admin"><span class='glyphicon glyphicon-calendar'></span> Gestion des visites et des conférences</h1>
            <a href='{{url('/ajoutConference')}}' data-toggle='collapse' data-target='.navbar-collapse.in' class=''>Ajouter une conférence</a><br>
            <a  data-toggle="modal" data-target="#nbModal" class="">Ajouter une visite</a><br>
            <a href="{{url('/getPageVisite')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Liste des visites</a><br><br><br><br>
        </div>       
        <div class='option-admin'>
            <h1 class="titre-admin"><span class='glyphicon glyphicon-th-large'></span> Divers</h1>
            <a href="{{url('/carouselAccueil')}}" data-toggle="collapse" data-target=".navbar-collapse.in" class="">Carousel</a><br><br>
        </div>      
    </div>
</center>
@stop