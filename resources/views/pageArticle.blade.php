@extends('layouts.master')
@section('content')
<div class="box">
    <h1 class="headTitle">{{$unArticle->titreArticle}}</h1>
    <hr>
    @php
    $date = date_create($unArticle->dateCreation);
    @endphp
    <p class="dateArticle">Publié le {{$date->format('d/m/Y')}} | Tabagnon.fr</p>
    <br>
    <div class="contenuArticle">
        @php
        echo $unArticle->contenu;
        @endphp
    </div>
</div>
@stop

