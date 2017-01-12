@extends('layouts.master')
@section('content')
<div class="box">
    <h1 class="text-center">{{$unArticle->titreArticle}}</h1>
    <div class="box">
           {{$unArticle->contenu}}
    </div>
</div>
@stop

