@extends('layouts.master')
@section('content')
<div class="box">
    <center><img class='article-image' src="{{ URL::asset('assets/image/article/'.$unArticle->imageArticle) }}" alt=""></center>
    <h1 class="headTitle">{{$unArticle->titreArticle}}</h1>
    <hr>
    @php
    $date = date_create($unArticle->dateCreation);
    @endphp
    <p class="dateArticle">Publié le {{$date->format('d/m/Y')}} | Tabagnon.fr</p>
    <br>
    <div class ="col-md-10 col-md-offset-1 contenuArticle">
        @php
        echo $unArticle->contenu;
        @endphp 
    </div>
</div>
@stop

