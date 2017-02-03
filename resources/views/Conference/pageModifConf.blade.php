@extends('layouts.masterAdmin')
@section('content')
{!! Form::open(['url' => 'postModifAjoutConf']) !!}
{!! Html::script('assets/pickadate.js/lib/picker.time.js') !!}  
{!! Html::script('assets/pickadate.js/lib/picker.js') !!}    
{!! Html::script('assets/pickadate.js/lib/picker.date.js') !!} 
{!! Html::style('assets/pickadate.js/lib/themes/default.css') !!}
{!! Html::style('assets/pickadate.js/lib/themes/default.date.css') !!}
{!! Html::style('assets/pickadate.js/lib/themes/default.time.css') !!}
{!! Html::script('assets/timepicker/jquery.timepicker.min.js') !!} 
{!! Html::style('assets/timepicker/jquery.timepicker.min.css') !!}
<script type="text/javascript">
    tinyMCE.init({
        mode: "textareas",
        language: "fr_FR",
        language_url: '../assets/tinymce/langs/fr_FR.js',
        forced_root_block: "",
        force_br_newlines: true,
        force_p_newlines: false,
        height: 300,
        plugins: "autoresize"
    });

</script>

@php
    $placeDispo = (($mesConferences->placeDispoConf) - ($mesConferences->placeReserConf));
@endphp
<div class='box'>
    <h3> Remplir le formulaire pour créer une conférence </h3>
    <div class='formulaire_conf'>
        <input type="hidden" value="{{$mesConferences->placeReserConf}}" name='place' class='place'>
        <input type="hidden" value="{{$mesConferences->idConf}}" name='id'>
        <label> Nom de la conférence: </label>
        <input type='text' class='form-control nomConf' name='nomConf' value='{{$mesConferences->libConf}}' placeholder='Nom de la conférence'>
        <br>
        <p class="msgErrorPlace">{{$erreur or ''}} ({{$mesConferences->placeReserConf}})</p>
        <label> Places disponibles conférence: (Attention le nombre de place disponible ne peut être inférieur à {{ $mesConferences->placeReserConf}}) </label>
        <input name='placeDispoConf' class="form-control placeDispo" type="text" value="{{$mesConferences->placeDispoConf}}"></input>
        <br>
        <label> Contenue de la conférence: </label>
        <textarea name='contenu' class="form-control" type="text" value="{{$mesConferences->contenuConf}}">{{$mesConferences->contenuConf}}</textarea>
        <br>
        <label> Adresse de la conférence: </label>
        <input type='text' class='form-control adresseConf' name='adresseConf' value='{{$mesConferences->adresseConf}}' placeholder='Adresse de la conférence'>
        <br>
        <label> Code Postale de la conférence: </label>
        <input type='text' class='form-control cpConf' name='cpConf' value='{{$mesConferences->cpConf}}' placeholder='Code Postale de la conférence'>
        <br>
        <center><button type='submit' class='btn btn-info' value='Envoyer'>Envoyer</button></center>
    </div>
    {{ Form::close() }}
    @stop
