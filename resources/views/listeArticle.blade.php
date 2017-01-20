@extends('layouts.master')
@section('content')

<div class="box">
    <center><p>______________________________</p></center>
    @foreach ($lesArticles as $unArticle)
    <a href="{{url('/article/'.$unArticle->idArticle)}}">
        <div class="col-md-10 col-md-offset-2 liste-news">    
            <div class="col-md-3">
                <img class="imgArticle" src="{{ URL::asset('assets/image/article/'.$unArticle->imageArticle) }}" alt="{{$unArticle->titreArticle}}">   
            </div>  
            <h2 class="nomArticle">{{$unArticle->titreArticle}}</h2>
            <p class='descArticle'> {{$unArticle->description}}</p>
            <p class="cliquezArticle">Cliquer pour voir l'article en entier !</p>
        </div>
    </a>
    <center><p>______________________________</p></center>
    @endforeach
    <center>  {{ $lesArticles->render() }} </center>
</div>

@stop