@extends('layouts.masterAdmin')
@section('content')
<div class='box'>
    @if(isset($error))
    <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>{{$error}}</p>
    </div>
    @endif
    {!! Form::open(['url' => 'postAjoutPhotoArticle', 'files' => true]) !!}
    <center> <h2>Ajouter une photo pour un article</h2> </center><br>
    <center><h4>Selectionnez l'article auquel vous voulez lié l'image</h4></center>
    <div class='col-lg-offset-4 col-lg-4'>
        <select class='form-control' name='idArticle'>
            <option value='0' disabled>Selectionnez un article</option>
            @foreach ($mesArticles as $unArticle)
            @if($unArticle->idArticle == $idArticle)
            <option value='{{$unArticle->idArticle}}' selected>{{$unArticle->idArticle}} - {{$unArticle->titreArticle}}</option>
            @endif
            @if($unArticle->idArticle != $idArticle)
            <option value='{{$unArticle->idArticle}}'>{{$unArticle->idArticle}} - {{$unArticle->titreArticle}}</option>
            @endif
            @endforeach
        </select>
    </div><br>
    <br>
    <center> <h4>Ajouter l'image souhaitée</h4></center>
    <center><div class=''>
            <input type='hidden' name="imageArticle" value=""/>
            <input type='hidden' name="MAX_FILE_SIZE" value="15000000"/>
            <input type='file' name="imageArticle" class="btn btn-default" accept="image/*" required/>
        </div></center>
    <br>
    <BR>
    <center><button type='submit' class='btn btn-info'>Envoyer</button></center>
    {{ Form::close() }}
</div>

@stop
