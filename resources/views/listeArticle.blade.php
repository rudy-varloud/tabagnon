@extends('layouts.master')
@section('content')

<div class="box">
    @foreach ($lesArticles as $unArticle)
    <a href="{{url('/article/'.$unArticle->idArticle)}}">
        <div class="col-md-10 col-md-offset-2 liste-news">    
            <div class="col-md-3">
                <img class="" src="{{ URL::asset('assets/image/article/'.$unArticle->imageArticle) }}" alt="{{$unArticle->titreArticle}}">   
            </div>  
            <h4>{{$unArticle->titreArticle}}</h4>
        </div>
    </a>
    @endforeach
</div>

@stop