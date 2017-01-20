@extends('layouts.masterAdmin')
@section('content')
<div class='box'>
    <h3> Remplir le formulaire pour créer une conférence </h3>
    <div class='formulaire_conf'>
        <label> Nom de la conférence: </label>
        <input type='text' class='form-control nomConf' name='nomConf' value='' placeholder='Nom de la conférence'>
        <br>
        <label> Contenue de la conférence: </label>
        <textarea name='contenu'class="form-control" type="text" ></textarea>
        <br>
        <label> Adresse de la conférence: </label>
        <input type='text' class='form-control adresseConf' name='adresseConf' value='' placeholder='Adresse de la conférence'>
        <br>
        <label> Heure de la conférence: </label>
        <input type='text' class='form-control heureConf' name='heureConf' value='' placeholder='Heure de la conférence'>
        <br>
        <label> Code Postale de la conférence </label>
        <input type='text' class='form-control cpConf' name='cpConf' value='' placeholder='Code Postale de la conférence'>
        <br>
        <center> <button type='submit' class='btn btn-info' value='Envoyer'>Envoyer</button></center>
    </div>
</div>
@stop