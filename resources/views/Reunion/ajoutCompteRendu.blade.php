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
            plugins: "autoresize",
            plugins: "image",
            image_dimensions: false
    });</script>
<div class="box">
    @php
    $date = date_create($mesReunions->dateReunion);
    @endphp
    {!! Form::open(['url' => 'postAjoutCr', 'files' => true]) !!}
    <input type="hidden" name='idReunion' value="{{$mesReunions->idReunion}}">
    <center><h2>Ajouter un compte rendu à la {{$mesReunions->typeReunion}} numéro {{$mesReunions->idReunion}} le {{$date->format('d-m-Y')}} à {{$date->format('H:i')}}</h2></center>
    <br>
    <center><h4>Veuillez selectionner le fichier du compte rendu</h4></center>
    <div class='col-lg-offset-4 col-lg-5'>
            <input type='hidden' name="dlCompteRendu" value=""/>
            <input type='hidden' name="MAX_FILE_SIZE" value="15000000"/>
            <input type='file' name="dlCompteRendu" class="btn btn-default" accept="file_extension" required/>
        </div>
    <br><br>
    <center><h4>Veuillez écrire le contenu du compte rendu (facultatif)</h4></center>
    <textarea name='contenu' class="form-control" type="text" >{{$mesReunions->contenuReunion}}</textarea>
    <br>
    <center><button typ="submit" class="btn btn-info" value="Envoyer le rapport">Envoyer le Compte rendu</button></center>
    {{ Form::close() }}
</div>

@stop
