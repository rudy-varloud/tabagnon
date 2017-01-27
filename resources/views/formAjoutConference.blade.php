@extends('layouts.masterAdmin')
@section('content')
{!! Form::open(['url' => 'postFormAjoutConf']) !!}
{!! Html::script('assets/pickadate.js/lib/picker.time.js') !!}  
{!! Html::script('assets/pickadate.js/lib/picker.js') !!}    
{!! Html::script('assets/pickadate.js/lib/picker.date.js') !!} 
{!! Html::style('assets/pickadate.js/lib/themes/default.css') !!}
{!! Html::style('assets/pickadate.js/lib/themes/default.date.css') !!}
{!! Html::style('assets/pickadate.js/lib/themes/default.time.css') !!}
{!! Html::script('assets/timepicker/jquery.timepicker.min.js') !!} 
{!! Html::style('assets/timepicker/jquery.timepicker.min.css') !!}

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
            <div class='form-group'>
                <label class="col-md-3 control-label"> Date et heure de la conférence: </label>    
                <br>
                <input name="date" type="text" class="datepicker form-control"  value="{{$dateVisite or ''}}" placeholder="Choisir la date" required>
                <input name="heure" type="text" class="timepicker form-control"  value="{{$heureVisite or ''}}" placeholder="Choisir l'heure" required>
            </div>
            <center> <button type='submit' class='btn btn-info' value='Envoyer'>Envoyer</button></center>
        </div>
    </div>
    {{ Form::close() }}
    @stop