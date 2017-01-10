@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />

<!--<br><br><br><br>-->
@if (Session::get('id') == 0)
<div class="logo" >
    <center> <H2 > Bienvenue sur le site du Tabagnon <b><a href="{{ url('/getLogin') }}"> veuillez vous connecter </a></b> ou bien <b><a href=""> vous créer un compte </a></b> pour naviguer ! </h2> </center>
</div>
@endif

@if (Session::get('id')> 0)
<div class="logo" style="margin-top: 10%">
    <center> <H2> Bienvenue sur le site du Tabagnon <b>{{ Session::get('prenom') }}</b> ! </h2> </center>
</div>
@endif
<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        
        <div class="carousel-inner">
            @php ($cptItem = 0)
            @foreach($lesArticles as $unArticle)
            @if($cptItem == 0)
            <div class="item active">
                <img src="assets/image/{{$unArticle->imageArticle}}">
                <div class="carousel-caption">
                    <h4><a href="#">{{$unArticle->titreArticle}} </a></h4>
                    {{$unArticle->contenu}} 
                </div>
            </div><!-- End Item -->
            @endif
            @if($cptItem > 0)     
            <div class="item">
                <img src="assets/image/{{ $unArticle->imageArticle or "default.jpg" }}">
                <div class="carousel-caption">
                    <h4><a href="#">{{$unArticle->titreArticle}}</a></h4>
                 {{$unArticle->contenu}}         
                </div>
            </div><!-- End Item -->
            @endif
            @php ($cptItem += 1)
            @endforeach
        </div><!-- End Carousel Inner -->


        <ul class="list-group col-sm-4">
            @php ($cpt = 0)
            @foreach($lesArticles as $unArticle)
            <li data-target="#myCarousel" data-slide-to="{{$cpt}}" class="list-group-item active"><h4>{{$unArticle->titreArticle}}</h4></li>
            @php ($cpt += 1)
            @endforeach
        </ul>

        <!-- Controls -->
        <div class="carousel-controls">
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>

    </div><!-- End Carousel -->
</div>
<div class="form-horizontal">
</div>

