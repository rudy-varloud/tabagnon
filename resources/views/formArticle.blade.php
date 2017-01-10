@extends('layouts.master')
@section('content')
{!! Form::open(['url' => 'postFormArticle', 'files' => true]) !!}
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

<div class="col-lg-12 col-md-12 col-s-12">
    <center><h2> Poster un article ! </h2></center>
<!--    <div class="form-horizontal">-->
<!--        <div class="form-control">-->
            <div class="form-group">
            <label class="col-md-3 control-label">Titre : </label>
            <input name="titreArticle" class="form-control" type="text" placeholder="Titre de l'aticle" required autofocus>
            </div>
            <br>
            <div class="form-group">
            <label class="col-md-3 control-label">Description de l'article: </label>
            <input name='description' class="form-control" type="text" placeholder="Description de l'article" required autofocus>
            </div>
            <br>
            <div class="form-group">
            <label class='col-md-3 control-label'>Contenue de l'article: </label>
            <textarea name='contenu' class="form-control" type="text" ></textarea>
            </div>
            <br>
            <div class="form-group">
            <label class='col-md-3 control-label'>Image que vous souhaitez lié à l'article</label>
            <div class='col-md-3'>
                <input type='hidden' name="imageArticle" value=""/>
                <input type='hidden' name="MAX_FILE_SIZE" value="204800"/>
                <input type='file' name="imageArticle" class="btn btn-default pull-left"/>
            </div>
            </div>
            <br>
            <div class="form-group">
                <br><br>
                <center> <button type="submit" class="btn btn-default btn-primary">
                    <span class="glyphicon glyphicon-ok"></span> Valider
                </button>
                &nbsp;
                <button type="button" class="btn btn-default btn-primary" 
                        onclick="javascript: window.location = '{{url('/acccueil')}}';">
                    <span class="glyphicon glyphicon-remove" ></span> Annuler</button> </center>
            </div>
        </div>
        @stop