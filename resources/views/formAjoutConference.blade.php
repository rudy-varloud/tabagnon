@extends('layouts.masterAdmin')
@section('content')
{!! Form::open(['url' => 'postFormAjoutConf']) !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class='box'>
    <h3> Remplir le formulaire pour créer une conférence </h3>
    <div class='formulaire_conf'>
        <label> Nom de la conférence: </label>
        <input type='text' class='form-control nomConf' name='nomConf' value='' placeholder='Nom de la conférence'>
        <br>
        <label> Prix de la conférence: </label>
        <input type='text' class='form-control prixConf' name='prixConf' value='' placeholder='Prix de la conférence'>
        <br>
        <label> Places disponibles conférence: </label>
        <input name='placeDispoConf' class="form-control" type="text" ></input>
        <br>
        <label> Contenue de la conférence: </label>
        <textarea name='contenu' class="form-control" type="text" ></textarea>
        <br>
        <label> Adresse de la conférence: </label>
        <input type='text' class='form-control adresseConf' name='adresseConf' value='' placeholder='Adresse de la conférence'>
        <br>
        <label> Code Postale de la conférence: </label>
        <input type='text' class='form-control cpConf' name='cpConf' value='' placeholder='Code Postale de la conférence'>
        <br>
        <div class="input_fields_wrap">
        <label> Date de la conférence: </label>
        <input type="date" class="datepicker form-control dateConf" name="dateConf" value="" placeholder="Date de la conférence">
        </div>
        <br>
        <label> Heure de la conférence: </label>
        <input type='text' class='form-control heureConf' name='heureConf' value='' placeholder='Heure de la conférence'>
        <br>
        <center> <button type='submit' class='btn btn-info' value='Envoyer'>Envoyer</button></center>
    </div>
</div>
{{ Form::close() }}
@stop