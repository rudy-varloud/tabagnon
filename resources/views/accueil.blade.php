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

<div>
    @foreach ($lesArticles as $unArticle)
    {{$unArticle->contenu}}
    @endforeach
</div>
