@extends('layouts.master')
@section('content')

<div class="box">
    @foreach ($lesArticles as $unArticle)
    <a href="{{url('/article/'.$unArticle->idArticle)}}">
        <div class="col-md-5 col-md-offset-2">    
            <img class="liste-news" src="{{ URL::asset('assets/image/article/'.$unArticle->imageArticle) }}" alt="{{$unArticle->titreArticle}}">
        </div>
        <div class="col-md-4">
            <h4>{{$unArticle->titreArticle}}</h4>
        </div>
        <br>
    </a>

    @endforeach
</div>

@stop