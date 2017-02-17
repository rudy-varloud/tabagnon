@extends('layouts.masterAdmin')
@section('content')
{!! Html::script('assets/pickadate.js/lib/picker.time.js') !!}  
{!! Html::script('assets/pickadate.js/lib/picker.js') !!}    
{!! Html::script('assets/pickadate.js/lib/picker.date.js') !!} 
{!! Html::style('assets/pickadate.js/lib/themes/default.css') !!}
{!! Html::style('assets/pickadate.js/lib/themes/default.date.css') !!}
{!! Html::style('assets/pickadate.js/lib/themes/default.time.css') !!}
{!! Html::script('assets/timepicker/jquery.timepicker.min.js') !!} 
{!! Html::style('assets/timepicker/jquery.timepicker.min.css') !!}
<div class="box">

    {!! Form::open(['url' => 'postReunion']) !!}
    <h1>Ajouter une réunion ou une assemblée générale</h1>
    <h3>Type de rendez-vous</h3>
    <div class="col-lg-6">
        <select class="form-control" name="select_type" required>
            <option class="" value="Réunion"> Réunion </option>
            <option class="" value="Assemblée générale"> Assemblée générale </option>
        </select>
    </div>
    <br><br>
    <h3>Adresse du rendez-vous</h3>
    <div class="col-lg-6">
        <input type="text" class="form-control" name="adresseReunion" placeholder="Adresse du rendez-vous" required>
    </div>
    <br><br>
    <h3>Code Postal réunion</h3>
    <div class="col-lg-6">
        <input type="number" class="form-control" name="cpReunion" placeholder="Code Postal de la réunion" required>
    </div>
    <br><br>
    <h3>Date et heure de la conférence</h3>
    <input name="date" type="text" class="datepicker form-control"  value="{{$dateVisite or ''}}" placeholder="Choisir la date">
    <input name="heure" type="text" class="timepicker form-control"  value="{{$heureVisite or ''}}" placeholder="Choisir l'heure" required>
    <BR>
    <center><button type='submit' class='btn btn-info' value='Envoyer'>Envoyer</button></center>
    {!! Form::close() !!}

</div>

@stop
