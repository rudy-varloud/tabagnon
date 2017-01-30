@extends('layouts.masterAdmin')
@section('content')

<script type="text/javascript">
    tinyMCE.init({
        mode: "textareas",
        language: "fr_FR",
        language_url: 'assets/tinymce/langs/fr_FR.js',
        forced_root_block: "",
        force_br_newlines: true,
        force_p_newlines: false,
        height: 300,
        plugins: "autoresize"
    });

</script>

<div class='box'>
    {!! Form::open(['url' => 'postFormArticle', 'files' => true]) !!}

    <div class="col-lg-12 col-md-12 col-s-12">
        <center><h2> Poster un article ! </h2></center>
        <!--    <div class="form-horizontal">-->
        <!--        <div class="form-control">-->
        <div class="form-group">
            <label class="col-md-3 control-label">Titre : </label>
            <input name="titreArticle" class="form-control" type="text" value="{{$titreArticle or ''}}" placeholder="Titre de l'aticle" required autofocus>
        </div>
        <br>
        <div class="form-group">
            <label class="col-md-3 control-label">Description de l'article: </label>
            <input name='description' class="form-control" type="text" value="{{$description or ''}}" placeholder="Description de l'article" required autofocus>
        </div>
        <br>
        <div class="form-group">
            <label class='col-md-3 control-label'>Contenue de l'article: </label>
            <textarea name='contenu'class="form-control" type="text" >{{$contenu or ''}}</textarea>
        </div>
        <br>
        <div class="form-group">
            {{$error or ""}}
            <label class='col-md-3 control-label'>Image que vous souhaitez lier à l'article</label>
            <div class='col-md-3'>
                <input type='hidden' name="imageArticle" value=""/>
                <input type='hidden' name="MAX_FILE_SIZE" value="204800"/>
                <input type='file' name="imageArticle" class="btn btn-default pull-left" accept="image/*"/>
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
                        onclick="javascript:if (confirm('Voulez vous vraiment quitter l éditeur ?'))
                           { window.location ='{{ url('/getPageAdmin') }}'; }">
                    <span class="glyphicon glyphicon-remove" ></span> Annuler</button> </center>
        </div>
    </div>
</div>
@stop